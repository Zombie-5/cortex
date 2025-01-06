<?php

namespace App\Http\Controllers\admin\product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class IndexProductsController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('id', 'desc')
            ->withCount('users')
            ->get();

        return view('admin.products', compact('products'));
    }
}
