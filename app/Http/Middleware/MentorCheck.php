<?php

namespace App\Http\Middleware;

use Closure;

class MentorCheck
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
        if($request->session()->get('role')=='mentor'){
            return $next($request);
        }else{
            return redirect('/dashboard');
        }
    }
}
