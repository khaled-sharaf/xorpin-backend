<?php

namespace App\Http\Middleware;

use Closure;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (auth()->user() && auth()->user()->active === 1 && (auth()->user()->rule === 1 || auth()->user()->rule === 2)) {
            return $next($request);
        } else if (auth()->user()->rule === 0 || !auth()->user()) {
            return abort(404);
        }
        return redirect()->route('home');
    }
}
