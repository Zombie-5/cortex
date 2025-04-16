<?php

namespace App\Http\Controllers\admin\notice;

use App\Http\Controllers\Controller;
use App\Models\Notice;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class DestroyNoticesController extends Controller
{
    function destroy($id)
    {
        try
		{
            $id = Crypt::decryptString($id);
            
            $notice = Notice::findOrFail($id);
            $store = $notice->delete();
            if($store) return json_encode(["success" => true, "msg" => "Remoção efectuada com sucesso!"]);

            return json_encode(["success" => false, "errors" => ["Ocorreu um erro ao remover!". $store]]);
        }
        catch (\Exception $e)
        {
            return json_encode(["success" => false, "errors" => ["Erro do servidor. Contacte o administrador do sistema!".$e->getMessage()]]);
        }
    }
}
