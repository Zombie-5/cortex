<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HoldingController extends Controller
{
    public function holdings()
    {
        $user = User::findOrFail(Auth::id());
        $products = $user->products;
        return view('client.holdings', compact('products'));
    }
}
