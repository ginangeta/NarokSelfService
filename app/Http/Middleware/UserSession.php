<?php

namespace App\Http\Middleware;

use Closure;

class UserSession
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function handle($request, Closure $next)
    {
        if (Session('token')) {
            return $next($request);
        }
        return redirect()->route('home');

    
    }
}
