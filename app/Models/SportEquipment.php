<?php

namespace App\Models;

use App\Http\Controllers\MaintenanceLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SportEquipment extends Model
{
    use HasFactory;

    protected $table = 'sport_equipments';
    protected $fillable = ['name', 'brand', 'description', 'equipment_status', 'image_path',];

    public function maintenanceLog()
    {
        return $this->hasMany(MaintenanceLog::class);
    }

    public function scopeName($query, $name)
    {
        return $query->where('name', 'like', '%' . $name . '%');
    }
    public function scopeBrand($query, $brand)
    {
        return $query->where('brand', 'like', '%' . $brand . '%');
    }
    public function scopeEquipmentStatus($query, $status)
    {
        return $query->where('equipment_status', $status);
    }
}
