<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class SignOutController extends Controller
{
    public function signOut()
    {
        Auth::logout();
        return redirect()->route('auth.signIn');
    }
}
