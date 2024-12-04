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
    public function index()
    {
        $appointments = Appointment::with('session.time', 'user')->get();
        $user = User::whereHas('appointments')->get();
        return view('dashboard.manager.appointment.index', [

            'appointments' => $appointments,
            'user' => $user
        ]);
    }
    public function search(Request $request)
    {
        $search = $request->search;

        // 
        $appointments = Appointment::whereHas('user', function ($query) use ($search) {
            $query->where('name', 'like', "%$search%"); // 
        })
            ->orWhereHas('session', function ($query) use ($search) {
                $query->where('name', 'like', "%$search%"); //
            })
            ->get();

        return view('dashboard.manager.appointment.index', ['appointments' => $appointments]);
    }

 
    public function updateStatus($id, $type) 
    { 
        $appointment = Appointment::findOrFail($id); 
        $appointment->status = ($type) ? 'accepted': 'cancelled'; 
        $appointment->save(); 
        return redirect('/appointments')->with('success'); 
    } 
}
