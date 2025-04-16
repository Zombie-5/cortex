<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\Link;
use App\Models\Notice;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
    public function home()
    {
        $user = User::findOrFail(Auth::id());
        $wallet = $user->wallet;

        if ($wallet && $wallet->last_reset->isBefore(Carbon::today())) {
            $wallet->today = 0;
            $wallet->last_reset = now();
            $wallet->save();
        }
        $links = Link::where('manager_id', $user->manager_id)->first();
        $notices = Notice::where('status', 1)
                ->orderBy('id', 'desc')
                ->get();
        return view('client.home', compact('links', 'notices'));
    }
}
