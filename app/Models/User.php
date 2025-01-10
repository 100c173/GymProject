<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{


    use HasApiTokens, HasFactory, Notifiable, HasRoles, SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['first_name', 'last_name', 'email', 'password'];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    /**
     * A user can have multiple subscriptions associated with them.
     */
    public function subscriptions()
    {
        return $this->hasMany(Subscription::class);
    }

    /**
     * A user can give multiple ratings.
     */
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    /**
     * A user can submit multiple membership applications.
     */
    public function membershipApplications()
    {
        return $this->hasMany(MembershipApplication::class);
    }

    /**
     * A user can be in many sessions 
     */
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    /**
     * Scope for Search By Full Name
     */
    public function scopeSearchFullName($query, $name)
    {
        return $query->whereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ['%' . $name . '%']);
    }

    /**
     * Scope for Search By Email
     */
    public function scopeSearchEmail($query, $email)
    {
        return $query->where('email', 'like', '%' . $email . '%');
    }

    /**
     * Accessor for full name
     */
    public function getFullName()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    /**
     * Accessor To get all ratings related with services that user rate it
     */
    public function getUserRatingServices()
    {
        return $this->ratings()->where('rateable_type', 'App\Models\Service')->get();
    }

    /**
     * Accessor To get all ratings related with Trainer that user rate it
     */
    public function getUserRatingTrainers()
    {
        return $this->ratings()->where('rateable_type', 'App\Models\User')->get();
    }

    /**
     * Accessor To get the subscriptions that are active and not expired
     */
    public function getUserActiveSubscriptions()
    {
        $today = Carbon::today();
        return $this->subscriptions()->where('start', '<=', $today)->where('end', '>=', $today)->get();
    }



    /**
     * Used in the ownership middleware to make sure
     * that the user whp want to update or delete own the resource
     */
    public function isOwnedBy($userId)
    {
        return $this->id == $userId;
    }
}
