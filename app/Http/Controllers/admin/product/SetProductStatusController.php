<?php

namespace App\Http\Controllers\admin\product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class SetProductStatusController extends Controller
{
    public function updateIsActive($id)
    {
        try {
            $product = Product::findOrFail(Crypt::decryptString($id));
            $product->is_active = !$product->is_active;
            $product->save();

            if ($product->is_active) {
                return redirect()->back()->with('success', 'Produto disponivel para investimento!');
            }
            return redirect()->back()->with('success', 'Produto indisponivel para investimento!');
        } catch (Exception $e) {         
            return redirect()->back()->with('error', "Ocorreu um erro ao disponibilizar Produto!" . $e->getMessage());
        }
    }

    public function updateIsDisplayed($id)
    {
        try {
            $product = Product::findOrFail(Crypt::decryptString($id));
            $product->is_displayed = !$product->is_displayed;
            $product->save();

            if ($product->is_displayed) {
                return redirect()->back()->with('success', 'Produto visivel para o cliente!');
            }
            return redirect()->back()->with('success', 'Produto invisivel para o cliente!');
        } catch (Exception $e) {         
            return redirect()->back()->with('error', "Ocorreu um erro ao editar visibilidade do Produto!" . $e->getMessage());
        }
    }
}
