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
        $users = User::where('manager_id', Auth::id())
            ->where('is_admin', 0)
            ->orderBy('id', 'asc')
            ->get();

        return view('admin.users', compact('users'));
    }
}
