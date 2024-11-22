<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'price', 'with_trainer', 'period', 'plan_type_id'];

    //Automatically load the related subscriptions and planType and sessions  models to prevent lazy loading.
    protected $with = ['subscriptions', 'planType', 'sessions'];

    /**
     * A plan can have multiple subscriptions associated with it.
     */
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }
    
    /**
    * A plan can be associated with multiple sessions through a many-to-many relationship.
    */
    public function sessions()
    {
        return $this->belongsToMany(Session::class)->as('plans_sessions')->withTimestamps();
    }

    /**
     * A plan belongs to a specific plan type.
    */
    public function planType( )
    {
        return $this->belongsTo(PlanType::class);
    }

 
}
