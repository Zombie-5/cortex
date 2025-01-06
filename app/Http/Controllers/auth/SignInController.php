<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class SignInController extends Controller
{
    public function signIn(Request $request)
    {
        return view('auth.signIn');
    }

    public function authenticate(Request $request)
    {
        // Definir as regras de validação
        $regras = [
            'tel' => 'required|min:9',
            'password' => 'required'
        ];

        // Feedback de validação
        $feedback = [
            'required' => 'O campo :attribute deve ser preenchido',
        ];

        // Validar os dados do formulário
        $request->validate($regras, $feedback);

        // Obter os dados de telefone e senha do request
        $telefone = $request->get('tel');
        $password = $request->get('password');

        // Verificar se o usuário com o telefone informado existe e autenticar
        $user = User::where('tel', $telefone)->first();

        if(!$user) dd('user dont found');
        
        if (Hash::check($password, $user->password)) {
           
            if (!$user->is_active) {
                
                // Se o usuário estiver banido, redirecionar com uma mensagem de erro
                return redirect()->route('auth.signIn')->withErrors(['Sua conta foi banida. Contacte um assistente']);
            }

           
            // Usar o Auth para autenticar o usuário
            Auth::login($user);
            dd(Auth::login($user));
            dd('Logg com sucesso');
            // Redirecionar para a página inicial após o login bem-sucedido
            return redirect()->route('app.home')->with('success', 'logado com sucesso!');
        } else {
            dd('Logg error');
            // Se o usuáo existir ou a senha não corresponder
            return redirect()->route('auth.signIn')->withErrors(['esse número não esta registrado']);
        }
    }
}
