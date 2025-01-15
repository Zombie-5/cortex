<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Gift;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class GiftController extends Controller
{
    public function index()
    {
        $gifts = 2; //Trns::orderBy('id', 'desc')->withCount('users')->get();

        return view('admin.gift', compact('gifts'));
    }

    public function store(Request $request)
    {
        dd('oioi');
        $request->validate([
            'value' => 'required',
        ]);

        // Dados do token com um identificador único
        $data = ['value' => $request->value];

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
}
