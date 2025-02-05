<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\Wallet;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;



class signUpController extends Controller
{
    public function signUp(Request $request)
    {
        //return view('auth2.register');
        return view('auth.signUp');

    }

    public function store(Request $request)
    {
        $validacao = new RegisterRequest;
        $erro = Validator::make($request->all(), $validacao->rules(), $validacao->messages());

        if ($erro->fails()) {

            return redirect()
                ->back()
                ->withErrors($erro->errors())
                ->withInput();
        } else {

            $createdUser = User::create([
                'tel' => $request['tel'],
                'password' => Hash::make($request['password']),
            ]);

            if ($createdUser) {
                Wallet::create(['user_id' =>  $createdUser->id]);
                return redirect()->route('auth.signIn')->with('success', 'Usuário criado com sucesso!');
            } else {
                return redirect()
                    ->back()
                    ->with('error', 'Erro ao criar o usuário. Tente novamente.')
                    ->withInput();
            }
        }
    }
}
