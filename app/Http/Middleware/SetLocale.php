<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        $locale = $request->route('locale');

        if (!in_array($locale, ['en', 'hi'])) {
            $locale = Config::get('app.fallback_locale');
        }

        App::setLocale($locale);

        return $next($request);
    }
}
