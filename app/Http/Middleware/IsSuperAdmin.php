<?php

namespace App\Http\Middleware;

use Closure;

class IsSuperAdmin
{
    public function handle($request, Closure $next)
    {
        if (auth()->user()->rule == 1) {
            return $next($request);
        }
        return redirect(env('CP_PREFIX') . '/' . 'dashboard');
    }
}
