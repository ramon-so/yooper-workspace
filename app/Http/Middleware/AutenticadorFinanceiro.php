<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AutenticadorFinanceiro
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next){
        if(Auth::check()){
            if (Auth::user()->acesso == 'Financeiro' || Auth::user()->acesso == 'Master'){
                return $next($request);
            }else{
                return redirect('/acesso-negado');
            }
        }else{
            return redirect('/login');
        }
    }
}
