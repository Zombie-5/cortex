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
            'custom-amount' => 'required|numeric|min:10000',
        ], [
            'custom-amount.required' => 'O montante é obrigatório.',
            'custom-amount.numeric' => 'O montante deve ser númerico.',
            'custom-amount.min' => 'O valor mínimo permitido para recarga é 5.000 kz',
        ]);

        $depositAmount = $request->input('custom-amount');

        // Recuperando o usuário logado
        $user = User::findOrFail(Auth::id());
        if (!$user->bank) {
            return redirect()->back()->with('error', 'You need to register a bank account before making a transaction.');
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
