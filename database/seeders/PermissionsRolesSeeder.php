<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionsRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        $permissions = [
            'create-user',
            'edit-user',
            'delete-user',
            'show-user',
            'create-time',
            'edit-time',
            'delete-time',
            'show-time',
            'create-session',
            'edit-session',
            'delete-session',
            'show-session',
            'accept&decline-appointment',
            'show-appointment',
            'log-attendance',
            'show-attendance',
            'show-membershipApplication',
            'create-equipment',
            'edit-equipment',
            'delete-equipment',
            'show-equipment',
            'create-plan',
            'edit-plan',
            'delete-plan',
            'show-plan',
            'create-planType',
            'edit-planType',
            'delete-planType',
            'show-planType',
            'create-service',
            'edit-service',
            'delete-service',
            'show-service',
            'delete-rating',
            'show-rating',
            'create-permission',
            'edit-permission',
            'delete-permission',
            'create-role',
            'edit-role',
            'delete-role',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        $roles = [
            'admin' =>
            [
                'create-user',
                'edit-user',
                'delete-user',
                'show-user',
                'create-time',
                'edit-time',
                'delete-time',
                'show-time',
                'create-session',
                'edit-session',
                'delete-session',
                'show-session',
                'accept&decline-appointment',
                'show-appointment',
                'log-attendance',
                'show-attendance',
                'show-membershipApplication',
                'create-equipment',
                'edit-equipment',
                'delete-equipment',
                'show-equipment',
                'create-plan',
                'edit-plan',
                'delete-plan',
                'show-plan',
                'create-planType',
                'edit-planType',
                'delete-planType',
                'show-planType',
                'create-service',
                'edit-service',
                'delete-service',
                'show-service',
                'delete-rating',
                'show-rating',
                'create-permission',
                'edit-permission',
                'delete-permission',
                'create-role',
                'edit-role',
                'delete-role',
            ],
            'trainer' =>
            [
                'create-session',
                'edit-session',
                'delete-session',
                'show-session',
                'log-attendance',
                'show-attendance',
                'show-equipment',
                'edit-equipment',
                'show-plan',
                'show-service',
                'show-rating',
            ],
            'user' =>
            [
                'show-session',
                'show-plan',
                'show-service',
                'show-rating',
            ],
        ];


        foreach ($roles as $roleName => $rolePermissions) {
            $role = Role::create(['name' => $roleName]);
            $role->givePermissionTo($rolePermissions);
        }
    }
}
