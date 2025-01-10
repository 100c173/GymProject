<?php
namespace App\Services;

use App\Http\Controllers\Controller;
use App\Models\Appointment;

class AttendanceService extends Controller
{
    public function update($id)
    {
        $appointment = Appointment::findOrFail($id);
        $attendance = $appointment->attendances->first();
        $attendance->update(['status' => 'present']);
        return $attendance;

    }
}