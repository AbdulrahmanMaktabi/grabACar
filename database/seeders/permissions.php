<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\Admin;

class permissions extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // define the permissions
        $permissions = [
            // User Management
            'create_user',
            'edit_user',
            'delete_user',
            'view_user',
            'assign_role',

            // Admin Management            
            'edit_admin',
            'delete_admin',
            'view_admin',

            // Roles Management
            'create_role',
            'edit_role',
            'delete_role',
            'view_roles',

            // Permissions Management
            'assign_permissions',
            'edit_permissions',
            'view_permissions',

            // Cars Management
            'create_car',
            'edit_car',
            'delete_car',
            'view_cars',

            // Dashboard Access
            'view_dashboard',
            'users_dashboard',
            'admins_dashboard',
            'roles_dashboard',
            'cars_dashboard',
        ];

        // create permissions
        collect($permissions)->map(function ($permission) {
            Permission::create([
                'name' => $permission,
                'guard_name' => 'admin',
            ]);
        });

        // define the roles
        $roles = [
            'Super Admin',
            'Admin',
        ];

        // create roles and assign permissions
        collect($roles)->map(function ($role) {
            $role = Role::create(['name' => $role, 'guard_name' => 'admin']);

            if ($role->name === 'Super Admin') {
                $role->syncPermissions(Permission::all());
            } else if ($role->name == 'Admin') {
                $role->syncPermissions([
                    'create_car',
                    'edit_car',
                    'delete_car',
                    'view_cars',
                    'cars_dashboard',
                    'view_dashboard',
                ]);
            }
        });

        // create a super admin user
        $admin = Admin::create([
            'name' => 'Super Admin',
            'email' => 'super@admin.com',
            'password' => bcrypt('secret'),
        ]);
        $admin->assignRole('Super Admin');
    }
}
