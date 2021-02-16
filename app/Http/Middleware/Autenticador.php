<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Autenticador
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {   
        /**
         * Usamos o $request->is, caso nosso middleware fosse global, para toda a aplicação. Assim, ele bloqueia tudo (colocando no arquivo kernel.php), menos as excessões;
         */
        if(!$request->is('entrar', 'registrar') && 
            !Auth::check()){
            return redirect('/entrar');
        }
        return $next($request);
    }
}
