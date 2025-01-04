<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsAdmin
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
       
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'You must log in first.');
        }
        
        if (!Auth::user()->hasRole('admin')) {
            return redirect('/home')->with('error', 'You do not have access to this resource.');
        }

        return $next($request);
    }
}

