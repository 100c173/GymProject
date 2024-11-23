<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = ['status', 'session_id', 'user_id'];
    
    // Automatically load the related user and session models to prevent lazy loading.
    protected $with =['user' , 'session'];

    /**
     *  An appointment can have multiple attendance records.
     */
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    /**
     *   The appointment belongs to a single session
     */
    public function session(){
        return $this->belongsTo(Session::class);
    }
    
    /**
     * The appointment belongs to a single user (trainee or trainer).
     */
    public function user(){
        return $this->belongsTo(User::class);
    }
    
}
