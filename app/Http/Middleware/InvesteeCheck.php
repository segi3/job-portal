<?php

namespace App\Http\Middleware;

use Closure;

class InvesteeCheck
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
        if($request->session()->get('investee')==true){
            return $next($request);
        }else{
            return redirect('/dashboard/register-status');
        }
    }
}
