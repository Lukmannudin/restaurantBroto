<?php

namespace resbroto\Http\Middleware;

use Closure;
use Auth;
class CekAdmin
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
        if (Auth::user()->level != 'admin') {
            return redirect('home/user');
        }
        return $next($request);
    }
}
