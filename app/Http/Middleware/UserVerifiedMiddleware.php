<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserVerifiedMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
         if(auth()->user() != null && auth()->user()->hasVerifiedEmail()){ // si el usuario, esta verificado en home
            return $next($request); // si estamos verificado, nos vamos al home
        }
        return redirect('email/verify'); // si no vas a home
    }
}
