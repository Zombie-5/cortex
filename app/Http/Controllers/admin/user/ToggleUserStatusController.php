<?php

namespace App\Http\Controllers\admin\user;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ToggleUserStatusController extends Controller
{
    public function toggleStatus($id)
    {
        // Descriptografando o ID
        $userId = Crypt::decryptString($id);

        // Encontrando o usuário
        $user = User::findOrFail($userId);

        // Alternando o status
        $user->is_active = !$user->is_active;
        $user->save();

        // Redirecionando de volta com uma mensagem de sucesso
        return redirect()->back()->with('success', 'Status do usuário alterado com sucesso.');
    }
}
