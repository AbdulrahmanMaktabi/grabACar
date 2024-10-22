<?php

use Illuminate\Support\Facades\Auth;

function isSuperAdmin()
{
    return Auth::guard('admin')->user()->getRoleNames()[0] == 'Super Admin';
}

function checkThePermission($guard_name, $permission)
{
    return Auth::guard($guard_name)->user()->can($permission);
}
