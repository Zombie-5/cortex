<?php

namespace App\Http\Controllers\admin\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;


class IndexUsersController extends Controller
{
    public function index()
    {
        $users = User::whereNotIn('tel', ['admin@cortex.com', '921621790'])
            ->orderBy('id', 'asc')
            ->get();

        return view('admin.users', compact('users'));
    }
}
