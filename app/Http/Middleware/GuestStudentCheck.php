<?php

namespace App\Http\Middleware;

use Closure;

class GuestStudentCheck
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
        if($request->session()->get('role')=='guest' || $request->session()->get('role')=='student'){
            return $next($request);
        }else{
            return redirect('/dashboard');
        }  
    }
}
