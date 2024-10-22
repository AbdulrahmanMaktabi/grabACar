<?php

use Illuminate\Support\Facades\Auth;

function isSuperAdmin()
{
    if (Auth::guard('admin')->user())
        return Auth::guard('admin')->user()->getRoleNames()[0] == 'Super Admin';
}

function checkThePermission($guard_name, $permission)
{
    if (Auth::guard($guard_name)->user())
        return Auth::guard($guard_name)->user()->can($permission);
}
