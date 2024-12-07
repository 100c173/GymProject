<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MaintenanceLog extends Model
{
    use HasFactory;

    protected $fillable = ['maintenance_date' , 'status' , 'sport_equipment_id' , 'created_at' , 'updated_at'];

    public function sportEquipment ( ){
        
        return $this->belongsTo(SportEquipment::class);
    }
}
