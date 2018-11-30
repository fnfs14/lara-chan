<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class CheckLoginAdmin
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
		if (Auth::check() == 'true' and Auth::user()->role=="be604a60-f05b-11e8-a592-1bcc725ac046") {
			return $next($request);
		}else if (Auth::check() == 'true' and Auth::user()->role=="cfd7a2c0-f05b-11e8-8abf-dbf626e8ec69") {			
			return redirect('/home');
		}
		return redirect('/');
    }
}
