<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = [
        'start',
        'end',
        'plan_id',
        'user_id',
    ];

<<<<<<< HEAD
=======
    //Automatically load the related user and plan models with each subscription to prevent lazy loading and improve query efficiency.
    // protected $with = ['user', 'plan'];
>>>>>>> feature/users

    /**
     * The subscription belongs to a specific user.
     * is associated with a single user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * The subscription is linked to a specific plan.
     * belongs to a single plan.
     */
    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }
}
