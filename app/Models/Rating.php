<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = ['rating', 'comment', 'rateable_type', 'rateable_id', 'user_id'];

    /**
     * This defines a polymorphic relationship, allowing the model to belong to multiple rateable entities.
     * For example, a rating can be associated with different models like users, sessions, or plans.
     */
    public function rateable()
    {
        return $this->morphTo();
    }
}
