<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function generateInviteLink()
    {
        /* $baseURL = 'http://127.0.0.1:8000/sign-up';
        $baseURL = 'http://localhost:8080/cortex/public/sign-up'; */
        $baseURL = 'https://etoro.onrender.com/sign-up';
        $encodeId = Auth::user()->id;
        return $baseURL . '/' . $encodeId;
    }

    public function home()
    {
        $user = User::findOrFail(Auth::id());
        $wallet = $user->wallet;

        if ($wallet && $wallet->last_reset->isBefore(Carbon::today())) {
            $wallet->today = 0;
            $wallet->last_reset = now();
            $wallet->save();
        }
        $inviteLink = $this->generateInviteLink();
        return view('client.home', compact('inviteLink'));
    }
}
