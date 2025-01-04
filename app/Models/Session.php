<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $fillable = ['status', 'name', 'description', 'max_members', 'user_id', 'time_id'];


    /**
     * A session can have multiple times associated with it through a many-to-many relationship.
     * This relationship is managed via the 'sessions_times' pivot table.
     */
    public function time()
    {
        return $this->belongsTo(Time::class);
    }



    /**
     * A session can be associated with multiple plans through a many-to-many relationship.
     * This relationship is managed via the 'plans_sessions' pivot table.
     */
    public function plans()
    {
        return $this->belongsToMany(Plan::class, 'plans_sessions')->withTimestamps();
    }

    /**
     * A session belongs to a specific trainer (user).
     * The trainer is identified by the 'user_id' foreign key.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }


    protected static function booted()
    {
        static::deleting(function ($session) {
            // Delete associated appointments
            $session->appointments()->delete();

            // Delete relationships with `plans`
            $session->plans()->detach();
        });
    }
}
