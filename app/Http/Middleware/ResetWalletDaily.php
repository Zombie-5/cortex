<?php

namespace App\Http\Middleware;

use App\Models\User;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ResetWalletDaily
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {

        $user = User::findOrFail(Auth::id());
        $wallet = $user->wallet;

        if ($wallet && $wallet->last_reset->isBefore(Carbon::today())) {
            $wallet->today = 0;
            $wallet->last_reset = now();
            $wallet->save();
        }


        return $next($request);
    }
}
