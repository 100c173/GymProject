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
        // استرجاع معلومات الموعد المطلوب تحديثه
        $appointmentId = $request->route('id');
        $appointment = Appointment::find($appointmentId);

        if (!$appointment) {
            return redirect('/appointments')->with('error', 'Appointment not found.');
        }

        $session = $appointment->session;
        $userId = $appointment->user_id;

        $conflictingAppointment = Appointment::where('user_id', $userId)
            ->whereHas('session', function ($query) use ($session) {
                $query->where('time_id', $session->time_id);
            })
            ->where('id', '!=', $appointmentId) 
            ->exists();

        if ($conflictingAppointment) {
          
           $appointment->update(['status' => 'cancelled']);

            return redirect('/appointments')->with('error', 'User is already booked in another session at the same time.');
             
        }

        return $next($request);
    }
}
