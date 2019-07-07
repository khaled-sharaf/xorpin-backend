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
        if (auth()->user() &&  (auth()->user()->rule === 1 || auth()->user()->rule === 2)) {
            return $next($request);
        }
        return redirect('/');
    }
}
