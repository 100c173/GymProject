<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\Attendance;

class AttendanceController extends Controller
{

    public function index(Request $request)
    {
        $appointments = $this->filterAppointment($request)->get();

        return view('dashboard/manager/attendance/Record', compact('appointments'));
    }


    private function filterAppointment(Request $request)
    {
        $query = Appointment::with(['user', 'session', 'attendances']);
        if ($request->filled('member_name')) {
            $query->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->input('member_name') . '%');
            });
        }
        if ($request->filled('session_name')) {
            $query->whereHas('session', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->input('session_name') . '%');
            });
        }

        return $query;
    }
    public function store(Request $request)
    {
        $request->validate([
            'attendance_status' => 'required|array',
            'attendance_status.*' => 'in:present,absent,late',
        ]);

        $message = '';

        foreach ($request->attendance_status as $appointmentId => $status) {
            $appointment = Appointment::find($appointmentId);

            if ($appointment) {
                $attendance = $appointment->attendances->first();

                if (!$attendance) {
                    Attendance::create([
                        'status' => $status,
                        'appointment_id' => $appointmentId,
                    ]);
                    $message = 'Attendance recorded successfully.';
                } else {
                    $message = 'Attendance already recorded.';
                }
            }
        }

        return redirect()->route('attendance.index')->with('success', $message);
    }

    public function update($id , $type)
    {
        $appointment = Appointment::findOrFail($id);

        $attendance = $appointment->attendances->first();

        if ($attendance) {
            if($type){
                if($type==1)
                   $attendance->update(['status' => 'present']);
                else
                    $attendance->update(['status' => 'nnconfirmed']);
            }
            else
              $attendance->update(['status' => 'absent']);

            return redirect()->route('attendance.index')->with('success', 'Attendance updated successfully.');
        }

        return redirect()->route('attendance.index')->with('error', 'No attendance record found to update.');
    }


    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $attendance = $appointment->attendances->first();
       
        if ($attendance) {
            $attendance->delete();
            return redirect()->route('attendance.index')->with('success', 'Attendance record deleted successfully.');
        }

        return redirect()->route('attendance.index')->with('error', 'No attendance record found to delete.');
    }
}
