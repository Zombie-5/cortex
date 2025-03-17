<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;

class BankController extends Controller
{
    public function bank()
    {
        return view('client.bank');
    }

    public function bank_choose()
    {
        $banks = Bank::where('is_Admin', 1)->get();
        return view('client.bank-choose', compact('banks'));
    }
}
