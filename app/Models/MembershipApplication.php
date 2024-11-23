<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MembershipApplication extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'pdf_path',
        'image_path',
        'user_id',
    ];

    //Automatically load the related user model to prevent lazy loading.
    protected $with = ['user'];

    /**
     * The membersihp application s associated with a specific user
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
