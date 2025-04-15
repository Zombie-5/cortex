<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    public function generateInviteLink()
    {
        /* $baseURL = 'http://127.0.0.1:8000/sign-up';
        $baseURL = 'http://localhost:8080/cortex/public/sign-up'; */
        $baseURL = 'https://etoro.onrender.com/sign-up';
        $encodeId = Auth::user()->id;
        return $baseURL . '/' . $encodeId;
    }

    public function team()
    {
        $inviteLink = $this->generateInviteLink();
        $user = User::findOrFail(Auth::id());
        $level1 = $user->subordinates;
        $level2 = $level1->flatMap(function ($subordinate) {
            return $subordinate->subordinates;
        });
        return view('client.team', compact('level1', 'level2', 'inviteLink'));
    }
}
