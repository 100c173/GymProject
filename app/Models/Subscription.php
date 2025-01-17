<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subscription extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'start',
        'end',
        'status',
        'plan_id',
        'user_id',
    ];

    //Automatically load the related user and plan models with each subscription to prevent lazy loading and improve query efficiency.
    // protected $with = ['user', 'plan'];

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
