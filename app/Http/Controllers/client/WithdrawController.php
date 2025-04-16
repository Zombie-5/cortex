<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class WithdrawController extends Controller
{
    public function withdraw()
    {
        $user = User::findOrFail(Auth::id());
        return view('client.withdraw', compact('user'));
    }

    public function store(Request $request)
    {
        // Validação de entrada
        $request->validate([
            'amount' => 'required|numeric|min:8000 |max:400000',
        ], [
            'amount.required' => 'O montante é obrigatório.',
            'amount.numeric' => 'O montante deve ser númerico.',
            'amount.min' => 'O saque mínimo permitido é de 8.000 kz',
            'custom-amount.max' => 'O saque máximo permitido é de 400.000 kz',
        ]);

        $withdrawAmount = $request->input('amount');

        // Recuperando o usuário logado
        $user = User::findOrFail(Auth::id());
        if (!$user->bank) {
            return redirect()->back()->with('error', 'Você precisa actualizar suas informações bancária');
        }    
        
        // Lógica de depósito
        Transaction::create([
            'type' => 'retirar',
            'value' => ($withdrawAmount - ($withdrawAmount*0.15)),
            'user_id' => $user->id,
        ]);

        $user->wallet->money -= $withdrawAmount;
        $user->wallet->points -= 500;
        $user->wallet->save();

        return redirect()->route('client.record.withdraw')->with('success', 'Retirada solicitada com sucesso!');
    }
}
