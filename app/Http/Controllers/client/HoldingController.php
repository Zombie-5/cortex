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
        $today = now();

        $products = $user->products()->wherePivot('expired', false)->get();

        foreach ($products as $product) {
            $expiresAt = $product->pivot->expires_at;
            if ($expiresAt && $today->isSameDay($expiresAt)) {
                if ($product->duration >= 15) {
                    $user->wallet->daily -= $product->income;
                    $user->wallet->points += 15000;
                    $user->wallet->save();
                    
                }
                if ($product->duration >= 15) {
                    $user->wallet->daily -= $product->income;
                    $user->wallet->points += 3500;
                    $user->wallet->save();
                    
                }

                $user->products()->updateExistingPivot($product->id, [
                    'expired' => true
                ]);
            }
        }
        $products = $user->products()->wherePivot('expired', false)->get();
        return view('client.holdings', compact('products'));
    }


    public function claim()
    {
        // Obter o user e o  produto
        $user = User::findOrFail(Auth::id());
        $today = now();
        $products = $user->products()->wherePivot('expired', false)->get();

        // Iterar pelas máquinas para calcular o total, atualizar incomeTotal e decrementar remainingTotal
        foreach ($products as $product) {

            // Verificar se a máquina já coletou hoje
            $today = now();
            $lastCollection = Carbon::parse($product->pivot->last_collection);
            if ($lastCollection->isSameDay($today)) continue;

            // Atualizar o saldo do usuário
            $user->wallet->money += $product->income;
            $user->wallet->today += $product->income;
            $user->wallet->total += $product->income;
            $user->wallet->save();

            if ($user->user_id >= 5100) {

                $superior1 = $user->superior;
                $superior1->wallet->money += $product->income * 0.02;
                $superior1->wallet->today += $product->income * 0.02;
                $superior1->wallet->total += $product->income * 0.02;
                $superior1->wallet->save();
                Record::create([
                    'name' => 'Comissão',
                    'value' => $product->income * 0.02,
                    'user_id' => $superior1->id,
                ]);

                $superior2 =  $superior1->superior;
                if ($superior2) {
                    $superior2->wallet->money += $product->income * 0.01;
                    $superior2->wallet->today += $product->income * 0.01;
                    $superior2->wallet->total += $product->income * 0.01;
                    $superior2->wallet->save();
                    Record::create([
                        'name' => 'Comissão',
                        'value' => $product->income * 0.01,
                        'user_id' => $superior2->id,
                    ]);
                }
            }

            $user->products()->updateExistingPivot($product->id, [
                'income_total' => $product->pivot->income_total + $product->income,
                'last_collection' => now(),
            ]);

            Record::create([
                'name' => 'Renda',
                'value' => $product->income,
                'user_id' => $user->id,
            ]);
        }

        return redirect()->back()->with('success', 'Recompensas coletadas com sucesso');
    }
}
