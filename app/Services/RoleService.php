<?php

namespace App\Services;

use Illuminate\Http\Request;

/**
 * this custom model because the basic model in the vendor folder can't be tracked
 * by good so i make custom one to track it and put the scope inside it
 */
use App\Models\CustomRole as Role;

class RoleService
{

    /**
     * To Create a new role
     * 
     * @param array $data The create data
     */
    public function create(array $data)
    {
        $role = Role::create([
            'name' => $data['name'],
        ]);

        foreach ($data['permissions'] as $permission) {
            $role->givePermissionTo($permission);
        }

        return $role;
    }

    /**
     * To Edit an role
     * 
     * @param array $data The update data
     * @param Role $role The role to update
     */
    public function update(array $data, Role $role)
    {
        $role->update([
            'name' => $data['name'],
        ]);

        $role->syncPermissions($data['permissions']);

        return $role;
    }

    /**
     *  Delete the specified role
     * 
     *  @param Role $role The role to delete
     *  @return bool|null True if the role was deleted, false otherwise
     */
    public function delete(Role $role)
    {

        return $role->delete();
    }

    /**
     * Get all roles after applying filters
     * 
     * @param array $data The data containing filter data
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator The paginated list of roles
     */
    public function getAllRolesAfterFiltering(array $data)
    {
        $entries_number = $data['entries_number'] ?? 10;

        $roles = Role::query()->when(isset($data['name']), function ($query) use ($data) {

            return $query->Name($data['name']);
        })->paginate($entries_number);

        return $roles;
    }
}
