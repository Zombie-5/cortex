<?php

namespace App\Http\Controllers\admin\user;

use App\Http\Controllers\Controller;
use App\Models\Record;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class specialTransactionController extends Controller
{
    public function updateWallet(Request $request, $userId)
    {
        $validated = $request->validate([
            'type' => 'required|in:deposit,withdraw',
            'value' => 'required|numeric|min:0.01',
        ]);

        $user = User::findOrFail($userId);
        $wallet = $user->wallet;

        if ($validated['type'] === 'deposit') {
            $wallet->money += $validated['value'];
            $wallet->save();
            Transaction::create([
                'type' => 'depositar',
                'value' => $validated['value'],
                'user_id' => $user->id,
                'status' => 'concluido'
            ]);
            return redirect()->back()->with('success', 'Deposito especial realizada com sucesso.');
        } elseif ($validated['type'] === 'withdraw') {
            if ($wallet->money >= $validated['value']) {
                $wallet->money -= $validated['value'];
                $wallet->save();
                Transaction::create([
                    'type' => 'retirar',
                    'value' => $validated['value'],
                    'user_id' => $user->id,
                    'status' => 'concluido'
                ]);
                return redirect()->back()->with('success', 'Retirada especial realizada com sucesso.');
            } else {
                return redirect()->back()->with('error', 'Saldo insuficiente para a retirada Especial.');
            }
        }
    }
}
