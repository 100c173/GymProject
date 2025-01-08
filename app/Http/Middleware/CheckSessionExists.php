<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Session;

class CheckSessionExists
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
            $sessionExists = Session::where('name', $request->name)
                                    ->where('time_id', $request->time_id)
                                           ->exists();
        
            if ($sessionExists) {
                return redirect()->back()->withErrors(['name' => 'The session is already registered with the same time and name. ']);
            }
        
            return $next($request);
        }
    }


