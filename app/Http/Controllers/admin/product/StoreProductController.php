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

            if($erro->fails()) return json_encode(['errors'=>$erro->errors()->all()]);

            //return json_encode(["success" => false, "errors" => ["Ocorreu um erro ao cadastrar"]]);

            $store =  Product::create($request->all());
            if($store) return json_encode(["success" => true, "msg" => "Produto cadastrado com sucesso!"]);

            return json_encode(["success" => false, "errors" => ["Ocorreu um erro ao cadastrar Produto!".$store]]);
        }
        catch (Exception $e)
        {
            return json_encode(["success" => false, "errors" => ["Erro do servidor. Contacte o administrador do sistema!".$e->getMessage()]]);
        }
    }
}
