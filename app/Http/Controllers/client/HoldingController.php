<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Record;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HoldingController extends Controller
{
    public function holdings()
    {
        $user = User::findOrFail(Auth::id());
        $products = $user->products;
        return view('client.holdings', compact('products'));
    }

    public function claim()
    {
        // Obter o user e o  produto
        $user = User::findOrFail(Auth::id());
        $products = $user->products;

        // Iterar pelas máquinas para calcular o total, atualizar incomeTotal e decrementar remainingTotal
        foreach ($products as $product) {

            // Verificar se a máquina já coletou hoje
            $today = now();
            $lastCollection = Carbon::parse($product->pivot->last_collection);
            if ($lastCollection->isSameDay($today)) continue;

            // Atualizar o saldo do usuário
            $user->wallet->money += $product->income;
            $user->wallet->today += $product->income;
            $user->wallet->save(); // O save deve funcionar agora se o User for um modelo Eloquent

            $superior1 = $user->superior;
            $superior1->wallet->money += $product->income;
            $superior1->wallet->today += $product->income;
            $superior1->wallet->save(); // O save deve funcionar agora se o User for um modelo Eloquent
            Record::create([
                'name' => 'income',
                'value' => $product->income * 0.1,
                'user_id' => $superior1->id,
            ]);

            $user->products()->updateExistingPivot($product->id, [
                'income_total' => $product->pivot->income_total + $product->income,
                'last_collection' => now(),
            ]);

            Record::create([
                'name' => 'income',
                'value' => $product->income,
                'user_id' => $user->id,
            ]);
        }

        return redirect()->back()->with('success', 'Recompensas coletadas com sucesso');
    }
}
