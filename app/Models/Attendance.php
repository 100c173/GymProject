<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = ['status', 'created_at', 'updated_at', 'appointment_id'];

    //Automatically load the related uappointment model to prevent lazy loading.
    protected $with =['appointment'];

    /**
     * The attendance record is associated with a specific appointment.
     */
    public function appointment(){
        return $this->belongsTo(Appointment::class);
    }
}
