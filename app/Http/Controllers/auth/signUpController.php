<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\Record;
use Illuminate\Http\Request;
use App\Models\Wallet;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;



class signUpController extends Controller
{
    public function signUp($invite_code = null)
    {
        //return view('auth2.register');
        return view('auth.signUp', compact('invite_code'));
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
                'user_id' => $request['invite_code'],
            ]);

            if ($createdUser) {
                Wallet::create(['user_id' =>  $createdUser->id]);
                $createdUser->wallet->money += 2;
                $createdUser->wallet->today += 2;
                $createdUser->wallet->total += 2;
                $createdUser->wallet->points = 2000;
                $createdUser->wallet->save();

                $inviter = $createdUser->superior;
                if (!$inviter->manager_id) {
                    $createdUser->manager_id = $inviter->id;
                    $createdUser->update();
                    return redirect()->route('auth.signIn')->with('success', 'Usuário criado com sucesso!');
                }

                $createdUser->manager_id = $inviter->manager_id;
                $createdUser->update();

                $subordinates = $inviter->subordinates->count();

                if ($subordinates <= 10) {
                    $inviter->wallet->points += 1000;
                    $inviter->wallet->save();
                }
                
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
