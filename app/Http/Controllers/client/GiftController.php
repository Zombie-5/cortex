<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Gift;
use App\Models\Record;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GiftController extends Controller
{
    public function gift()
    {
        return view('client.gift');
    }

    public function redeem(Request $request)
    {
        $request->validate([
            'token' => 'required|string',
        ]);

        try {
            // Busca o giftCode com o token informado
            $giftCode = Gift::where('token', $request->token)->first();

            if (!$giftCode) {
                return redirect()->back()->withErrors(['Token inválido']);
            }

            // Verifica se o token já foi utilizado
            if ($giftCode->status === 'used') {
                return redirect()->back()->withErrors(['Token já resgatado']);
            }

            // Simula o depósito na conta do usuário (implementação do seu método depositToUserAccount)
            $userId = Auth::user();
            $user = User::findOrFail($userId->id);
            $user->wallet->money += $giftCode->value;
            $user->wallet->today += $giftCode->value;
            $user->wallet->save();

            Record::create([
                'name' => 'Gift',
                'value' => $giftCode->value,
                'user_id' => $user->id,
            ]);

            // Marca o token como usado no banco de dados
            $giftCode->status = 'used';
            $giftCode->user_id = $user->id;
            $giftCode->save(); //

            return redirect()->back()->with('success', 'presente resgatado com sucesso! ' . $giftCode->value . ' Kz');;
        } catch (\Exception $e) {
            dd($e);
            return redirect()->back()->withErrors(['Token inválido']);
        }
    }
}
