<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Record;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MarketController extends Controller
{

    public function market()
    {
        $products = Product::orderBy('id', 'desc')->get();
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
            return back()->withErrors(['Allready Investing.']);
        }

        // Anexar a produto ao usuário na tabela pivot
        $user->products()->attach($product->id, [
            'income_total' => $product->income,
            'last_collection' => now(),
            'created_at' => now(),
            'expires_at' => now()->addDays($product->duration),
        ]);

        Record::create([
            'name' => 'income',
            'value' => $product->income,
            'user_id' => $user->id,
        ]);

        // Subtrair o preço do produto do saldo do usuário
        $user->wallet->money -= $product->price;
        $user->wallet->money += $product->income;
        $user->wallet->today += $product->income;
        $user->wallet->daily += $product->income;
        $user->wallet->save(); // O save deve funcionar agora se o User for um modelo Eloquent

        Record::create([
            'name' => 'invest',
            'value' => $product->price,
            'user_id' => $user->id,
        ]);

        if (!$user->is_vip) {

            // Comissão de 10% para o superior de nível 1 (direto)
            $superiorNivel1 = $user->superior;
            if ($superiorNivel1) {
                $comissaoNivel1 = $product->price * 0.1;
                $superiorNivel1->wallet->money += $comissaoNivel1;
                $superiorNivel1->wallet->today += $comissaoNivel1;
                $superiorNivel1->wallet->total += $comissaoNivel1;
                $superiorNivel1->wallet->save();

                Record::create([
                    'name' => 'reward',
                    'value' => $comissaoNivel1,
                    'user_id' => $superiorNivel1->id,
                ]);
            }

            // Comissão de 5% para o superior de nível 2 (indiretamente)
            $superiorNivel2 = $superiorNivel1->superior;
            if ($superiorNivel2) {
                $comissaoNivel2 = $product->price * 0.05;
                $superiorNivel2->wallet->money += $comissaoNivel2;
                $superiorNivel2->wallet->today += $comissaoNivel2;
                $superiorNivel2->wallet->total += $comissaoNivel2;
                $superiorNivel2->wallet->save();

                Record::create([
                    'name' => 'reward',
                    'value' => $comissaoNivel2,
                    'user_id' => $superiorNivel2->id,
                ]);
            }

            $user->is_vip = true;
            $user->save();
        }

        return redirect()->back()->with('success', 'Máquina alugada com sucesso!');
    }
}
