<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DepositController extends Controller
{
    public function deposit()
    {
        $user = User::findOrFail(Auth::id());
        return view('client.deposit', compact('user'));
    }

    public function store(Request $request)
    {
        // Validação de entrada
        $request->validate([
            'custom-amount' => 'required|numeric|min:10 |max:1000000000',
        ], [
            'custom-amount.required' => 'O montante é obrigatório.',
            'custom-amount.numeric' => 'O montante deve ser númerico.',
            'custom-amount.min' => 'O depósito mínimo permitido é de 10 USDT',
            'custom-amount.max' => 'O depósito máximo permitido é de 1.000.000.000 USDT',
        ]);

        $depositAmount = $request->input('custom-amount');

        // Recuperando o usuário logado
        $user = User::findOrFail(Auth::id());
        if (!$user->bank) {
            return redirect()->back()->with('error', 'Você precisa actualizar suas informações bancária');
        }
    
        

        // Lógica de depósito
        Transaction::create([
            'type' => 'depositar',
            'value' => $depositAmount,
            'user_id' => $user->id,
        ]);

        return redirect()->route('client.bank.choose')->with('success', 'Depósito solicitado com sucesso!');
    }
}
