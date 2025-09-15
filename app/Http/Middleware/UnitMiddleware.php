<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UnitMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if ($request->route('unit')) {
            session(['unit' => $request->route('unit')]);
        }

        return $next($request);
    }
}
