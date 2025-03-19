<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Gift;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;


class GiftController extends Controller
{
    public function index()
    {
        $gifts = Gift::with('user')->orderBy('id', 'desc')->get();
        return view('admin.gift', compact('gifts'));
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'value' => 'required',
        ]);

        // Criptografa os dados
        $shortToken = Str::random(8);

        // Salva no banco de dados
        $giftCode = Gift::create([
            'token' => $shortToken,
            'value' => $request->value,
        ]);

        return redirect()->route('admin.gift.index')->with([
            'token' => $shortToken,
            'value' => $giftCode->value,
        ]);
    }

    function destroy($id)
    {
        try
		{
            $id = Crypt::decryptString($id);
            
            $gift =  Gift::findOrFail($id);
            $store = $gift->delete();
            if($store) return json_encode(["success" => true, "msg" => "Remoção efectuada com sucesso!"]);

            return json_encode(["success" => false, "errors" => ["Ocorreu um erro ao remover!". $store]]);
        }
        catch (\Exception $e)
        {
            return json_encode(["success" => false, "errors" => ["Erro do servidor. Contacte o administrador do sistema!".$e->getMessage()]]);
        }
    }
}
