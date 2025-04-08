<?php

namespace App\Http\Controllers\admin\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class IndexUsersController extends Controller
{
    public function index()
    {
        $users = User::where('manager_id', Auth::id()) // Filtra pelo usuário logado
            ->where('is_admin', 0) // Exclui os admins
            ->orderBy('id', 'asc')
            ->get();

        return view('admin.users', compact('users'));
    }
}
