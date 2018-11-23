<?php

namespace App\Http\Middleware;

use Closure;

class SessionHandler
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
        if (!$request->session()->has(config('custom.session_pre').'jwttoken')) {
            return redirect()->route('login');
        }
        if($request->id !== $request->session()->get(config('custom.session_pre').'hashmake')){

             return redirect()->route('login');
        }

        return $next($request);
    }
}
