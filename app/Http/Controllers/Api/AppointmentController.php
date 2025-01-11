<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AppointmentRequest;
use App\Http\Resources\AppointmentResource;
use App\Models\Appointment;
use App\Models\Attendance;
use App\Models\Session;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct()
    {

        $this->middleware('check.capacity')->only('store' , 'update');
        $this->middleware('preventDoubleBooking')->only('store' , 'update');
        $this->middleware('check.owner')->only('destroy');
    }

    public function index()
    {
        $appointments = Appointment::where('user_id', auth()->id())->paginate(10); 
        return $this->successResponse(
            'Appointments retrieved successfully.',
            AppointmentResource::collection($appointments)
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AppointmentRequest $request)
    {
        $appointment = Appointment::create([
            'user_id' => auth()->id(),
            'session_id' => $request->session_id,
        ]);

        Attendance::create([
            'appointment_id' => $appointment->id,
        ]);

        $session = Session::find($request->session_id);
        $session->decrement('max_members', 1); //Subtracts 1 from max_members

        return $this->successResponse(
            'Appointment created successfully.',
            $appointment,
            201
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointment $appointment)
    {
        return $this->successResponse(
            'Appointment retrieved successfully.',
            new AppointmentResource($appointment)
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update( AppointmentRequest $request , Appointment $appointment)
    {
        $session = $appointment->session;
        $session->increment('max_members', 1); //Add 1 from max_members
        
        $appointment->update($request->validated());

        $session = Session::find($request->session_id);
        $session->decrement('max_members', 1); //Subtracts 1 from max_members
        
        return $this->successResponse(
            'Appointment updated successfully.',
            new AppointmentResource($appointment)
        );
        return response()->json([
                'message' => 'Session is full or does not exist.',
            ], 400);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointment $appointment)
    {
        $session = $appointment->session;
        $session->increment('max_members', 1); //Add 1 from max_members
        $appointment->delete();
        return $this->successResponse('Appointment deleted successfully.');
    }
}
