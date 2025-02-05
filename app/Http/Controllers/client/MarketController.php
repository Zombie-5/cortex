<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class MarketController extends Controller
{
    public function market()
    {
        $products = Product::orderBy('id', 'desc')->get();
        return view('client.market', compact('products'));
    }
}
