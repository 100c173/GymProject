<?php

namespace App\Models;

use Spatie\Permission\Models\Role as SpatieRole;

class CustomRole extends SpatieRole
{
    /**
     * Scope for Search By Name
     */
    public function scopeName($query, $name)
    {
        return $query->where('name', 'like', '%' . $name . '%');
    }
}
