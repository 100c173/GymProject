<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    // protected $guarded=[];
    protected $fillable = ['name', 'description', 'price', 'with_trainer', 'period', 'plan_type_id'];

    //Automatically load the related subscriptions and planType and sessions  models to prevent lazy loading.
    // protected $with = ['subscriptions', 'planType', 'sessions'];

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
        return $this->belongsToMany(Session::class, 'plans_sessions'); //->as('plans_sessions')->withTimestamps();
    }

    /**
     * A plan belongs to a specific plan type.
     */
    public function planType()
    {
        return $this->belongsTo(PlanType::class);
    }


    /**
     * Scope to search by name
     */
    public function scopeSearchByName($query, $name)
    {
        return $query->where('name', 'like', '%' . $name . '%');
    }

    /**
     * Scope to filter by minimum price
     */
    public function scopeMinPrice($query, $min_price)
    {
        return $query->where('price', '>=', $min_price);
    }

    /**
     * Scope to filter by maximum price
     */
    public function scopeMaxPrice($query, $max_price)
    {
        return $query->where('price', '<=', $max_price);
    }

    /**
     * Scope to filter by with_trainer
     */
    public function scopeWithTrainer($query, $with_trainer)
    {
        return $query->where('with_trainer', $with_trainer);
    }

    /**
     * Scope to filter by plan_type_id
     */
    public function scopePlanType($query, $plan_type_id)
    {
        return $query->where('plan_type_id', $plan_type_id);
    }
}
