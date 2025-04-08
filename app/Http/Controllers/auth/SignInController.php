<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


class SignInController extends Controller
{
    public function signIn(Request $request)
    {
        //return view('auth2.login');
        return view('auth.signIn');
    }

    public function authenticate(Request $request)
    {
        try {
            $validacao = new LoginRequest;

            $erro = Validator::make($request->all(), $validacao->rules(), $validacao->messages());
            if ($erro->fails())
                return json_encode(['errors' => $erro->errors()->all()]);
            else {

                // Verifica se é um email válido (ou seja, se é um admin)
                $adminEmails = ['admin@etoro.com', 'lilcrypto@etoro.com', 'youngvisa@etoro.com'];
                if (in_array($request->tel, $adminEmails)) {

                    $user = User::where('tel', $request->tel)->first();

                    if ($user && Hash::check($request->password, $user->password)) {
                        // Usar o Auth para autenticar o usuário
                        Auth::login($user);
                        return redirect()->route('admin.dashboard')->with('success', 'logado com sucesso!');
                    }
                } else {
                    // Se não for um email válido, considera que é um número de telefone
                    $user = User::where('tel', $request->tel)->first();

                    if ($user && Hash::check($request->password, $user->password)) {
                        // Usar o Auth para autenticar o usuário
                        Auth::login($user);
                        return redirect()->route('client.home')->with('success', 'logado com sucesso!');
                    }
                }

                return json_encode(["success" => false, "errors" => ["Credenciais incorrectas!"]]);
            }
        } catch (\Exception $e) {
            return json_encode(["success" => false, "errors" => ["Erro do servidor. Contacte o administrador do sistema!" . $e->getMessage()]]);
        }
    }
}
