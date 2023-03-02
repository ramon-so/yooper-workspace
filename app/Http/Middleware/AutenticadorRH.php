<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AutenticadorRH
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
        if(Auth::check()){
            if (Auth::user()->acesso == 'RH' || Auth::user()->acesso == 'Master' || Auth::user()->acesso == 'Head' || Auth::user()->acesso == 'Master-RH'){
                return $next($request);
            }else{
                return redirect('/acesso-negado');
            }
        }else{
            return redirect('/login');
        }
    }
}
