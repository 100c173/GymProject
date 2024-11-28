<?php

namespace App\Models;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Attendance extends Model
{
    use HasFactory;

    protected $fillable = ['status', 'created_at', 'updated_at', 'appointment_id'];

    /**
     * The attendance record is associated with a specific appointment.
     */
    public function appointment(){
        return $this->belongsTo(Appointment::class);
    }
}
