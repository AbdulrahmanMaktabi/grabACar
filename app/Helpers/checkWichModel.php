<?php

use App\Models\Admin;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

function checkIfRoleUsed($role, $guard_name)
{
    if ($guard_name == 'web') {
        return count(User::role($role, $guard_name)->get()) > 0;
    } else {
        return count(Admin::role($role, $guard_name)->get()) > 0;
    }
}

function getUsersByRole($role, $guard_name)
{
    if ($guard_name == 'web') {
        return User::role($role, $guard_name)->get();
    } else {
        return Admin::role($role, $guard_name)->get();
    }
}

function inPermissions($role,  $permission)
{
    $permissions = $role->permissions;
    foreach ($permissions as $perm) {
        if ($perm->name == $permission->name) {
            return true;
        }
    }
}
