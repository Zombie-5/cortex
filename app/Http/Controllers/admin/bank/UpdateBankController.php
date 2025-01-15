<?php

namespace App\Http\Controllers\admin\bank;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUpdateBankRequest;
use App\Models\Bank;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Crypt;

class UpdateBankController extends Controller
{
    public function update(Request $request, $id)
    {

        try
        {   
            $id = Crypt::decryptString($id);
            $validacao = new CreateUpdateBankRequest;

            $erro = Validator::make($request->all(), $validacao->rulesUpdate($id), $validacao->messages());

            if($erro->fails()) return json_encode(['errors'=>$erro->errors()->all()]);

            $banco = Bank::findOrFail($id);

            $update = $banco->update($request->all());

            if ($update) {
                return response()->json(["success" => true, "msg" => "Banco atualizado com sucesso!"], 200);
            }

            return json_encode(["success" => false, "errors" => ["Ocorreu um erro ao actualizar Banco!".$update]]);
        }
        catch (Exception $e)
        {
            return json_encode(["success" => false, "errors" => ["Erro do servidor. Contacte o administrador do sistema!".$e->getMessage()]]);
        }
    }
}
