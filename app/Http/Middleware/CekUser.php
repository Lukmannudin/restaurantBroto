<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CekUser
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
        if (Auth::user()->level != 'member') {
           return 'Anda tidak boleh mengakses halaman ini';
        }
        return $next($request);
    }
}
