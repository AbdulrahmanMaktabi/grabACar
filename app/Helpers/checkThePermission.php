<?php

use Illuminate\Support\Facades\Auth;

function checkThePermission($guard_name, $permission)
{
    if (Auth::guard($guard_name)->user())
        return Auth::guard($guard_name)->user()->can($permission);
}
