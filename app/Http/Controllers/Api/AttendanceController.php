<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function __construct()
    {
        $this->middleware('check.booking.user');
    }
    public function update($id)
    {

        $appointment = Appointment::findOrFail($id);

        $attendance = $appointment->attendances->first();
        
        $attendance->update(['status' => 'present']);

        return $this->errorResponse('Attendance has been successfully registered.');
    }

}
