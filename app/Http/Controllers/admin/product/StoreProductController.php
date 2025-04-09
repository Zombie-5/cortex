<?php

namespace App\Http\Controllers\admin\product;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUpdateProductRequest;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class StoreProductController extends Controller
{
    public function store(Request $request)
    {
        try
        {   
            $validacao = new CreateUpdateProductRequest;

            $erro = Validator::make($request->all(), $validacao->rulesInsert(), $validacao->messages());

            if ($erro->fails()) {
                // Passando um array de erros para a sessão
                return redirect()->back()->with('error', implode(', ', $erro->errors()->all()));
            }

            $store =  Product::create($request->all());
            if($store) return redirect()->back()->with('success', 'Produto cadastrado com sucesso!');
            
            return redirect()->back()->with('error', "Ocorreu um erro ao cadastrar Produto!".$store);
        }
        catch (Exception $e)
        {
            return redirect()->back()->with('error', "Erro do servidor. Contacte o desenvovedor do sistema! ");
            //return redirect()->back()->with('error', "Erro do servidor. Contacte o desenvovedor do sistema! " . $e->getMessage());
        }
    }
}
