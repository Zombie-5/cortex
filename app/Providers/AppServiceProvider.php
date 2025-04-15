<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Link;
use App\Models\User;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (env('APP_ENV') === 'production') {
            URL::forceScheme('https');
        }

        View::composer('layouts.admin.app', function ($view) {
            if (Auth::check()) {
                $user = User::findOrFail(Auth::id());
                $links = Link::where('manager_id', $user->manager_id)->first();
                $view->with('links', $links);
            }
        });
    }
}
