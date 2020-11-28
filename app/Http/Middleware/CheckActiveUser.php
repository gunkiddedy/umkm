<?php

namespace App\Http\Middleware;

use Closure;

class CheckActiveUser
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
        if (Auth::user()->is_active == 0) {
            return redirect('/member');
        }
        return $next($request);
    }
}
