<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckAppointmentOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Verify that the current user is the appointment holder
        $appointment = $request->route('appointment'); // Get the date from the path
        if ($appointment->user_id !== auth()->id()) {
            return response()->json([
                'message' => 'You are not authorized to delete this appointment.',
            ], 403); 
        }

        return $next($request); 
    }
}
