<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function change()
    {
        return view('client.change-password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = User::findOrFail(Auth::id());

        // Verifica se a senha atual está correta
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error', 'A senha atual está incorreta.');
        }

        // Atualiza a senha do usuário
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return redirect()->back()->with('success', 'Senha alterada com sucesso.');
    }
}
