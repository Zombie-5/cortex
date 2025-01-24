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
        return view('auth2.login');
    }

    public function authenticate(Request $request)
    {
        try {
            $validacao = new LoginRequest;

            $erro = Validator::make($request->all(), $validacao->rules(), $validacao->messages());
            if ($erro->fails())
                return json_encode(['errors' => $erro->errors()->all()]);
            else {
                if ((new User())->login($request) === true) {
                    return json_encode(["success" => true, "redirect" => route("admin.dashboard")]);
                }
                return json_encode(["success" => false, "errors" => ["Credenciais incorrectas!"]]);
            }
        } catch (\Exception $e) {
            return json_encode(["success" => false, "errors" => ["Erro do servidor. Contacte o administrador do sistema!" . $e->getMessage()]]);
        }
    }

}
