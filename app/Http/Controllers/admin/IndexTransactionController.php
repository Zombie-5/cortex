<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class IndexTransactionController extends Controller
{
    public function index()
    {
        $transactionsDeposited = Transaction::orderBy('created_at', 'desc')
            ->with('user')
            ->where('status', '!=', 'concluido')
            ->where('status', '!=', 'rejeitado')
            ->where('type', 'depositar')
            ->get();

        $transactionsWithdrawn = Transaction::orderBy('created_at', 'desc')
            ->where('status', '!=', 'concluido')
            ->where('status', '!=', 'rejeitado')
            ->where('type', 'retirar')
            ->get();

        $transactions = Transaction::orderBy('created_at', 'desc')
            ->where('status', '!=', 'pendente')
            ->where('status', '!=', 'processando')
            ->get();

        return view('admin.transaction', ['transactions' => $transactions, 'transactionsDeposited' => $transactionsDeposited, 'transactionsWithdrawn' => $transactionsWithdrawn]);
    }
}
