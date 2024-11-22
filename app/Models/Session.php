<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'max_members', 'user_id'];
    
    //Automatically load the related trainer model to prevent lazy loading.
    protected $with = ['trainer' ];

    /**
     * A session can have multiple times associated with it through a many-to-many relationship.
     * This relationship is managed via the 'sessions_times' pivot table.
     */
    public function times()
    {
        return $this->belongsToMany(Time::class)->as('sessions_times')->withTimestamps();
    }

    /**
     * A session can have multiple appointments associated with it.
     * Each appointment represents a booking for the session.
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
    /**
    * A session can be associated with multiple plans through a many-to-many relationship.
    * This relationship is managed via the 'plans_sessions' pivot table.
     */
    public function plans()
    {
        return $this->belongsToMany(Plan::class)->as('plans_sessions')->withTimestamps();
    }

    /**
    * A session belongs to a specific trainer (user).
    * The trainer is identified by the 'user_id' foreign key.
    */
    public function trainer()
    {
        return $this->belongsTo(User::class);
    }
}
