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

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Scope a query to search for rateable by name
     *
     * This scope applies a filter to the query to search for rateable (either User or Service)
     * based on the provided name
     * It handles the polymorphic relationship and applies the appropriate
     * search logic depending on the type of the rateable
     *
     * @param Builder $query The query builder instance
     * @param string $name The name to search for in the rateable
     * @return Builder The modified query builder instance
     */
    public function scopeSearchRateableName($query, $name)
    {
        return  $query->whereHasMorph('rateable', ['App\Models\User', 'App\Models\Service'], function ($q, $type) use ($name) {
            if ($type === 'App\Models\User') {
                $q->SearchFullName($name);
            } elseif ($type === 'App\Models\Service') {
                $q->SearchName($name);
            }
        });
    }

    public function scopeOfRating($query, $rating)
    {
        return $query->where('rating', $rating);
    }

    public function scopeOfType($query, $type)
    {
        return $query->where('rateable_type', $type);
    }

    public function scopeOfRaterName($query, $name)
    {
        return $query->whereHas('user', function ($query) use ($name) {
            $query->SearchFullName($name);
        });
    }

    public function scopeOfRateableName($query, $name)
    {
        return $query->SearchRateableName($name);
    }
}
