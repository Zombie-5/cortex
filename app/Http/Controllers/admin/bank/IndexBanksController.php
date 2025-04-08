<?php

namespace App\Http\Controllers\admin\bank;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bank;


class IndexBanksController extends Controller
{
    public function index()
    {
        $banks = Bank::where('is_admin', 1)->orderBy('id', 'desc')->get();

        return view('admin.bank', compact('banks'));
    }
}
