<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wallet;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class signUpController extends Controller
{
    public function signUp(Request $request)
    {
        return view('auth.signUp');
    }

    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'tel' => 'required|regex:/^9\d{8}$/|unique:users,tel',
            'password' => 'required',
        ], [
            'tel.required' => 'O número de telefone é obrigatório.',
            'tel.regex'    => 'O número de telefone é inválido',
            'tel.unique'   => 'Este número de telefone já está registrado.',
            'password.required' => 'A senha é obrigatória.',
            'convite.required'  => 'O código de convite é obrigatório.',
        ]);

        $user = User::create([
            'tel' => $validatedData['tel'],
            'password' => Hash::make($validatedData['password'])
        ]);

        Wallet::create(['user_id' =>  $user->id]);

        return redirect()->route('auth.signIn')->with('success', 'Usuário criado com sucesso!');
    }
}
