<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class IndexTransactionController extends Controller
{
    public function index()
    {
        $transactionsDeposited = Transaction::orderBy('created_at', 'desc')
            ->with('user')
            ->whereHas('user', function ($query) {
                $query->where('manager_id', Auth::id());
            })
            ->where('status', '!=', 'concluido')
            ->where('status', '!=', 'rejeitado')
            ->where('type', 'depositar')
            ->get();
        return view('admin.transactions.deposits', compact('transactionsDeposited'));
    }

    public function deposits()
    {
        $transactionsDeposited = Transaction::orderBy('created_at', 'desc')
            ->with('user')
            ->whereHas('user', function ($query) {
                $query->where('manager_id', Auth::id());
            })
            ->where('status', '!=', 'concluido')
            ->where('status', '!=', 'rejeitado')
            ->where('type', 'depositar')
            ->get();
        return view('admin.transactions.deposits', compact('transactionsDeposited'));
    }

    public function withdrawals()
    {
        $transactionsWithdrawn = Transaction::orderBy('created_at', 'desc')
            ->with('user')
            ->whereHas('user', function ($query) {
                $query->where('manager_id', Auth::id());
            })
            ->where('status', '!=', 'concluido')
            ->where('status', '!=', 'rejeitado')
            ->where('type', 'retirar')
            ->get();
        return view('admin.transactions.withdrawals', compact('transactionsWithdrawn'));
    }

    public function history()
    {
        $transactions = Transaction::orderBy('created_at', 'desc')
        ->with('user')
        ->whereHas('user', function ($query) {
            $query->where('manager_id', Auth::id());
        })
        ->where('status', '!=', 'pendente')
        ->where('status', '!=', 'processando')
        ->get();

        return view('admin.transactions.history', compact('transactions'));
    }
}
