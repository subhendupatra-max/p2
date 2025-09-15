<?php

namespace App\Providers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ServiceProvider;
use App\Models\Section;
use Illuminate\Support\Facades\View;

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
        \Illuminate\Support\Facades\DB::listen(function ($query) {
            // for debug if needed
        });

        // When session is created, bind user_id into it
        Event::listen('Illuminate\Session\Events\SessionCreated', function ($event) {
            if (Auth::check()) {
                Session::put('user_id', Auth::id());
            }
        });

    }
}
