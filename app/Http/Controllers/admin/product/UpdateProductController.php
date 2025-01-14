<?php

namespace App\Http\Controllers\admin\product;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUpdateProductRequest;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;


class UpdateProductController extends Controller
{
    public function update(Request $request, $id)
    {
        dd('oi 1');

        try
        {   
            dd('oi');
            $id = Crypt::decryptString($id);
            $validacao = new CreateUpdateProductRequest;

            $erro = Validator::make($request->all(), $validacao->rulesUpdate($id), $validacao->messages());

            if($erro->fails()) return json_encode(['errors'=>$erro->errors()->all()]);

            $product = Product::findOrFail($id);

            $update = $product->update($request->all());

            if ($update) {
                return response()->json(["success" => true, "msg" => "Produto atualizado com sucesso!"], 200);
            }

            return json_encode(["success" => false, "errors" => ["Ocorreu um erro ao actualizar Produto!".$update]]);
        }
        catch (Exception $e)
        {
            return json_encode(["success" => false, "errors" => ["Erro do servidor. Contacte o administrador do sistema!".$e->getMessage()]]);
        }
    }
}
