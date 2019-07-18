<?php

namespace App\Http\Middleware;

use Closure;

class IsAdmin
{
    public function handle($request, Closure $next)
    {
        if (auth()->user() && auth()->user()->active == 1 && (auth()->user()->rule == 1 || auth()->user()->rule == 2)) {
            if (auth()->user()->rule == 2 && auth()->user()->company->active == 0) {
                return redirect()->route('home');
            }
            return $next($request);
        } else if (auth()->user()->rule == 0 || !auth()->user()) {
            return abort(404);
        }
        return redirect()->route('home');
    }
}
