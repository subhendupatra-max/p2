<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckAnyPermission
{
    public function handle($request, Closure $next, ...$permissions)
    {
        foreach ($permissions as $permission) {
            if (Auth::user()?->can($permission)) {
                return $next($request); // allow if any matches
            }
        }

        abort(403, 'Unauthorized.');
    }
}

