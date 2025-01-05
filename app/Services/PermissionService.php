<?php

namespace App\Services;

use App\Http\Requests\PermissionRequest;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionService
{

    /**
     * To Create a new permission
     * 
     * @param array $data The create data
     */
    public function create(array $data)
    {
        $permission = Permission::create([
            'name' => $data['name'],
        ]);

        return $permission;
    }

    /**
     * To Edit an permission
     * 
     * @param array $data The update data
     * @param Permission $permission The permission to update
     */
    public function update(array $data, Permission $permission)
    {
        $permission->update([
            'name' => $data['name'],
        ]);

        return $permission;
    }

    /**
     *  Delete the specified permission
     * 
     *  @param Permission $permission The permission to delete
     *  @return bool|null True if the permission was deleted, false otherwise
     */
    public function delete(Permission $permission)
    {

        return $permission->delete();
    }

    /**
     * Get all permissions after applying filters
     * 
     * @param array $data The data containing filter data
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator The paginated list of permissions
     */
    public function getAllPermissionsAfterFiltering(array $data)
    {
        $entries_number = $data['entries_number'] ?? 10;

        $permissions = Permission::query()

            ->when($data['name'] ?? null, function ($query, $name) {
                return $query->name($name);
            })->paginate($entries_number);

        return $permissions;
    }
}
