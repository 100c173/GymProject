<?php

namespace App\Models;

use App\Http\Controllers\MaintenanceLog;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SportEquipment extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'brand', 'description', 'equipment_status', 'image_path',];

    public function maintenanceLog(){
        return $this->hasMany(MaintenanceLog::class);
    }
}
