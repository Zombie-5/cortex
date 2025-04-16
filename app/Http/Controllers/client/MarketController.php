<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Record;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MarketController extends Controller
{

    public function market()
    {
        $user = User::findOrFail(Auth::id());
        $products = Product::where('is_displayed', 1)
            ->orderBy('id', 'desc')
            ->get();

        // Adiciona o número de compras de cada produto pelo usuário atual
        foreach ($products as $product) {
            $purchaseCount = DB::table('product_users')
                ->where('user_id', $user->id)
                ->where('product_id', $product->id)
                ->count();

            $product->purchase_count = $purchaseCount;
        }
        return view('client.market', compact('products'));
    }

    public function invest($productId)
    {
        // Obter o user e o  produto
        $user = User::findOrFail(Auth::id());
        $product = Product::findOrFail($productId);

        if ($user->wallet->money < $product->price) {
            return back()->withErrors(['Saldo Insuficiente.']);
        }

        if ($user->hasProduct($productId)) {
            return back()->withErrors(['Você já está investindo']);
        }

        if (!$product->is_active) {
            return back()->withErrors(['Disponível em breve']);
        }

        // Verifica se o usuário já comprou o mesmo produto 4 vezes
        $count = DB::table('product_users')
            ->where('user_id', $user->id)
            ->where('product_id', $product->id)
            ->count();

        if ($count >= 4) {
            return back()->withErrors(['Você já comprou este produto 4 vezes.']);
        }

        // Anexar a produto ao usuário na tabela pivot
        $user->products()->attach($product->id, [
            'created_at' => now(),
            'last_collection' => now()->subDay(),
            'expires_at' => now()->addDays($product->duration),
        ]);

        // Subtrair o preço do produto do saldo do usuário
        $user->wallet->money -= $product->price;
        $user->wallet->daily += $product->income;
        $user->wallet->save();

        Record::create([
            'name' => 'invest',
            'value' => $product->price,
            'user_id' => $user->id,
        ]);

        if (!$user->is_vip) {
            $user->is_vip = true;
            $user->save();
        }

        return redirect()->back()->with('success', 'Máquina alugada com sucesso!');
    }
}
