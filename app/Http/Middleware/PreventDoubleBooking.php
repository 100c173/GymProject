<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Appointment;
use App\Models\Session;

class PreventDoubleBooking
{
    /**
     * Handle an incoming request.
     */
    public function handle($request, Closure $next)
    {
        // Check if a record exists with the same session_id and user_id
        $exists = Appointment::where('session_id', $request->session_id)
            ->where('user_id', auth()->id())
            ->exists();

        if ($exists) {
            return response()->json([
                'message' => 'You have already booked this session.',
            ], 400);
        }

        return $next($request); 
    }
}
