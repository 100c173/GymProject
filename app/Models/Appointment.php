<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Attendance;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = ['status', 'session_id', 'user_id'];
    
    /**
     *  An appointment can have multiple attendance records.
     */
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function session()
    {
        return $this->belongsTo(Session::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    protected static function booted()
    {
        static::deleting(function ($appointment) {
            // Delete associated attendances
            $appointment->attendances()->delete();
        });
    }
}