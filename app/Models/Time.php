<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Time extends Model
{
    use HasFactory;
    public $timestamps = false;

    protected $fillable = ['start_time', 'end_time', 'day'];

    /**
    * A time slot can be associated with multiple sessions through a many-to-many relationship.
    * This relationship is managed via the 'sessions_times' pivot table.
    */
    public function sessions()
    {
        return $this->belongsToMany(Session::class);
    }

    public function getStartAndEndtime()
    {
        return "{$this->start_time}  -  {$this->start_time}";
    }
}
