<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

use illuminate\Support\Facades\Auth;

class StaffMiddleware
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
        if(Auth::user() == true && Auth::user()->isadmin === 'staff'){
            return $next($request);
        }
        return redirect()->route('login');
        // return abort(403);
    }
}
