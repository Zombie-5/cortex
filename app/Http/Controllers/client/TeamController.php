<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    public function team()
    {
        $user = User::findOrFail(Auth::id());
        $level1 = $user->subordinates;
        $level2 = $level1->flatMap(function ($subordinate) {
            return $subordinate->subordinates;
        });
        return view('client.team', compact('level1', 'level2'));
    }
}
