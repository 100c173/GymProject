<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Session;
use App\Models\User;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request , $id)
    {
        $appointments = Appointment::with('session.time' , 'user')->where('session_id',$id)->paginate(10);
        $user = User::whereHas('appointments')->get();

        return view('new-dashboard.appointment.list_appointments', [

            'appointments' => $appointments,
            'user' => $user,
        ]);
    }
    public function search(Request $request)
    {
        $entries_number = $request->input('entries_number', 10);

        $search = $request->search;

        // 
        $appointments = Appointment::whereHas('user', function ($query) use ($search) {
            $query->SearchFullName($search);// 
        })
            ->orWhereHas('session', function ($query) use ($search) {
                $query->where('name', 'like', "%$search%"); //
            })
            ->paginate($entries_number);

        return view('new-dashboard.appointment.list_appointments', ['appointments' => $appointments]);
    }

    public function destroy($id){
        $appointment = Appointment::FindOrFail($id) ;
        $session = $appointment->session;
        $session->increment('max_members', 1); //Add 1 from max_members
        $appointment->delete();
        return redirect()->route('appointments.index')->with('success', 'Appointment deleted successfully');
    }
}
