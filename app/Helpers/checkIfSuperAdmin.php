<?php

use Illuminate\Support\Facades\Auth;

function isSuperAdmin()
{
    if (Auth::guard('admin')->user())
        return Auth::guard('admin')->user()->getRoleNames()[0] == 'Super Admin';
}
