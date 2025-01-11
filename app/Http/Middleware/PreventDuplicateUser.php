<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\User;

class PreventDuplicateUser
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
        $existingUser = User::where('first_name', $request->first_name)
        ->where('last_name', $request->last_name)
        ->first();

        if ($existingUser) {
            return redirect()
                ->back()
                ->with('error', 'The user already exists');
        }
        return $next($request);
    }
}
