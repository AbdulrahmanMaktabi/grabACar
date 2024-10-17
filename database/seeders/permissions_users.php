<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class permissions_users extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // define the permissions
        $permissions = [
            // Cars Management
            'create_car',
            'edit_car',
            'delete_car',
            'view_cars',

            // Dashboard Access
            'view_dashboard',
            'cars_dashboard',
        ];

        // create permissions
        collect($permissions)->map(function ($permission) {
            Permission::create([
                'name' => $permission,
                'guard_name' => 'web',
            ]);
        });

        // define the roles
        $roles = [
            'Editor',
        ];

        // create roles and assign permissions
        collect($roles)->map(function ($role) {
            $role = Role::create(['name' => $role, 'guard_name' => 'web']);

            if ($role->name === 'Editor') {
                $role->syncPermissions(Permission::all());
            }
        });
    }
}
