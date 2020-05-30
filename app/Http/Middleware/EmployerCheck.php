<?php

namespace App\Http\Middleware;

use Closure;

class EmployerCheck
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
        if($request->session()->get('role')=='employer'){
            return $next($request);
        }else{
            return redirect('/dashboard');
        }  
    }
}
