<?php

namespace App\Http\Middleware;

use App\Models\Session;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSessionCapacity
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        //Get session by session_id coming from request
        $session = Session::find($request->session_id);

        //Checking if the session exists and the max_members value
        if (!$session || $session->max_members <= 0) {
            return response()->json([
                'message' => 'Session is full or does not exist.',
            ], 400);
        }

        return $next($request); 
    }
}
