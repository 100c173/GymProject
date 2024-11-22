<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlanType extends Model
{
    use HasFactory;

    //Automatically load the related namd model to prevent lazy loading.
    protected $fillable = ['name'] ; 

    /**
     * A plan type can have multiple plans associated with it.
     */
    public function Plan()
    {
        return $this->hasMany(Plan::class);
    }
}
