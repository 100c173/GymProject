<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\AttendanceService;

class AttendanceController extends Controller
{
    protected $attendanceService;
    public function __construct(AttendanceService $attendanceService)
    {
        $this->attendanceService = $attendanceService;
        $this->middleware('check.booking.user');
    }
    public function update($id)
    {
        $attendance = $this->attendanceService->update($id) ; 
        if($attendance){
            return $this->successResponse('Attendance has been successfully registered.');
        }
        else{
            return $this->errorResponse('Registration was not successful.');
        }

        

    
    }

}
