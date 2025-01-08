<?php

namespace App\Services;

use App\Http\Requests\EquipmentRequest;
use App\Models\SportEquipment;
use Illuminate\Http\Request;

class EquipmentService
{

    /**
     * To Create a new equipment
     * 
     * @param array $data The create data
     */
    public function create(array $data)
    {
        $imagePath = null;

        if (isset($data['image_path'])) {
            $file = $data['image_path'];
            $imagePath = uploadFile($file, "images/Equipments");
        }

        $equipment = SportEquipment::create([
            'name' => $data['name'],
            'brand' => $data['brand'],
            'description' => $data['description'],
            'equipment_status' => $data['equipment_status'],
            'image_path' => $imagePath,
        ]);

        return $equipment;
    }

    /**
     * To Edit an equipment
     * 
     * @param array $data The update data
     * @param SportEquipment $equipment The equipment to update
     */
    public function update(array $data, SportEquipment $equipment)
    {
        $imagePath = $equipment->image_path;

        if (isset($data['image_path'])) {
            $file = $data['image_path'];
            $imagePath = uploadFile($file, "images/Equipments");
        }

        $equipment->update([
            'name' => $data['name'],
            'brand' => $data['brand'],
            'description' => $data['description'],
            'equipment_status' => $data['equipment_status'],
            'image_path' => $imagePath,
        ]);

        return $equipment;
    }

    /**
     *  Delete the specified equipment
     * 
     *  @param SportEquipment $equipment The equipment to delete
     *  @return bool|null True if the equipment was deleted, false otherwise
     */
    public function delete(SportEquipment $equipment)
    {
        return $equipment->delete();
    }

    /** 
     * Get all equipments after applying filters
     *
     *  @param array $data The filter data
     *  @return \Illuminate\Contracts\Pagination\LengthAwarePaginator The paginated list of equipments
     */
    public function getAllEquipmentsAfterFiltering(array $data)
    {
        $entries_number = $data['entries_number'] ?? 10;

        $equipments = SportEquipment::query()

            ->when($data['name'] ?? null, function ($query, $name) {

                return $query->name($name);
            })->when($data['brand'] ?? null, function ($query, $brand) {

                return $query->brand($brand);
            })->when($data['equipment_status'] ?? null, function ($query, $status) {

                return $query->equipmentStatus($status);
            })->paginate($entries_number);

        return $equipments;
    }
}
