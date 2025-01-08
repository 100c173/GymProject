<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Prunable;

class Time extends Model
{
    use HasFactory, Prunable;

    public $timestamps = false;

    protected $fillable = ['start_time', 'end_time', 'day'];

    /**
     * Define the query to determine which records should be pruned
     * 
     * This method specifies that records with a 'day' field earlier 30 days
     * than the current date should be pruned
     * The Carbon library is used to get the current date in 'Y-m-d' format
     * 
     * @return Builder
     */
    protected function prunable()
    {
        return $this->whereDate('day', '<', Carbon::now()->subDays(30)->format('Y-m-d'));
    }

    /**
     * A time slot can be associated with multiple sessions through a many-to-many relationship.
     * This relationship is managed via the 'sessions_times' pivot table.
     */
    public function sessions()
    {
        return $this->belongsToMany(Session::class);
    }

    /**
     * Get the formatted start and end time
     *
     * This method returns the start and end time formatted in 12-hour format
     *
     * @return string
     */
    public function getStartAndEndTime12Hours()
    {
        return TimeWith12HoursFormat($this->start_time) . " - " . TimeWith12HoursFormat($this->end_time);
    }

    /**
     * Get the formatted start time
     *
     * This method returns the start time formatted in 12-hour format
     *
     * @return string
     */
    public function getStartTime12Hours()
    {
        return TimeWith12HoursFormat($this->start_time);
    }

    /**
     * Get the formatted End time
     *
     * This method returns the End time formatted in 12-hour format
     *
     * @return string
     */
    public function getEndTime12Hours()
    {
        return TimeWith12HoursFormat($this->end_time);
    }

    /**
     * Scope a query to only include times with a start time greater than or equal to the specified minimum time
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $minTime
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMinTime($query, $minTime)
    {
        return $query->where('start_time', '>=', Carbon::parse($minTime)->format('H:i:s'));
    }

    /**
     * Scope a query to only include times with an end time less than or equal to the specified maximum time
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $maxTime
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMaxTime($query, $maxTime)
    {
        return $query->where('end_time', '<=', Carbon::parse($maxTime)->format('H:i:s'));
    }

    /**
     * Scope a query to only include times with a day greater than or equal to the specified minimum date
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $minDate
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMinDate($query, $minDate)
    {
        return $query->where('day', '>=', $minDate);
    }

    /**
     * Scope a query to only include times with a day less than or equal to the specified maximum date
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $maxDate
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeMaxDate($query, $maxDate)
    {
        return $query->where('day', '<=', $maxDate);
    }
}
