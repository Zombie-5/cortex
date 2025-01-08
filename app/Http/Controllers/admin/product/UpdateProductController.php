<?php

namespace App\Http\Controllers\admin\product;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUpdateProductRequest;
use Illuminate\Http\Request;

class UpdateProductController extends Controller
{
    public function update(Request $request, $id)
    {
        try
        {   
            $id = Crypt::decryptString($id);
            $validacao = new CreateUpdateProductRequest;

            $erro = Validator::make($request->all(), $validacao->rulesUpdate($id), $validacao->messages());

            if($erro->fails()) return json_encode(['errors'=>$erro->errors()->all()]);

            $store =  Product::create($request->all());
            if($store === true) return json_encode(["success" => true, "msg" => "Extensão Actualizada com sucesso!"]);

            return json_encode(["success" => false, "errors" => ["Ocorreu um erro ao actualizar extensão!".$store]]);
        }
        catch (Exception $e)
        {
            return json_encode(["success" => false, "errors" => ["Erro do servidor. Contacte o administrador do sistema!".$e->getMessage()]]);
        }
    }
}
