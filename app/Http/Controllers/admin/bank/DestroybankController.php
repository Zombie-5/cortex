<?php

namespace App\Http\Controllers\admin\bank;

use App\Http\Controllers\Controller;
use App\Models\Bank;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class DestroybankController extends Controller
{
    function destroy($id)
    {
        try
		{
            $id = Crypt::decryptString($id);
            
            $product =  Bank::findOrFail($id);
            $store = $product->delete();
            if($store) return json_encode(["success" => true, "msg" => "Remoção efectuada com sucesso!"]);

            return json_encode(["success" => false, "errors" => ["Ocorreu um erro ao remover!". $store]]);
        }
        catch (\Exception $e)
        {
            return json_encode(["success" => false, "errors" => ["Erro do servidor. Contacte o administrador do sistema!".$e->getMessage()]]);
        }
    }
}
