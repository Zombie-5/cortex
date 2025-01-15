<?php

namespace App\Http\Controllers\admin\bank;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateUpdateBankRequest;
use App\Models\Bank;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Validator;

class StorebankController extends Controller
{
    public function store(Request $request)
    {
        try
        {   
            $validacao = new CreateUpdateBankRequest;

            $erro = Validator::make($request->all(), $validacao->rulesInsert(), $validacao->messages());

            if($erro->fails()) return json_encode(['errors'=>$erro->errors()->all()]);

            //return json_encode(["success" => false, "errors" => ["Ocorreu um erro ao cadastrar"]]);

            $store = Bank::create($request->all());
            if($store) return json_encode(["success" => true, "msg" => "Banco cadastrado com sucesso!"]);

            return json_encode(["success" => false, "errors" => ["Ocorreu um erro ao cadastrar Banco!".$store]]);
        }
        catch (Exception $e)
        {
            return json_encode(["success" => false, "errors" => ["Erro do servidor. Contacte o administrador do sistema!".$e->getMessage()]]);
        }
    }
}
