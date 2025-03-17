<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class RecordController extends Controller
{
    public function record()
    {
        return view('client.record');
    }

    public function record_deposit()
    {
        // Recuperando o usuário logado
        $user = User::findOrFail(Auth::id());
        $records = Transaction::where('user_id', $user->id)
            ->where('type', 'depositar')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('client.record-deposit', compact('records'));
    }

    public function record_withdraw()
    {
        // Recuperando o usuário logado
        $user = User::findOrFail(Auth::id());
        $records = Transaction::where('user_id', $user->id)
            ->where('type', 'retirar')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('client.record-withdraw', compact('records'));
    }
}
