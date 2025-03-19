<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function generateInviteLink()
    {
        $baseURL = 'http://127.0.0.1:8000/sign-up';
        $baseURL = 'http://localhost:8080/cortex/public/sign-up';
        $encodeId = Auth::user()->id;
        return $baseURL . '/' . $encodeId;
    }

    public function home()
    {
        $inviteLink = $this->generateInviteLink();
        return view('client.home', compact('inviteLink'));
    }
}
