<?php

namespace App\Http\Middleware;

use Closure;

class IYTCheck
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
        if($request->session()->get('iyt')==true){
            return $next($request);
        }else{
            return redirect('/dashboard/register-status');
        }
    }
}
