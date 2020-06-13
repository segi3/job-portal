<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class LoginTrue
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
        if($request->session()->has('login')) {
            Session::flash('error', 'anda sudah memiliki session login, silahkan logout terlebih dahulu');
            return redirect()->back();
        }else{
            return $next($request);
        }
    }
}
