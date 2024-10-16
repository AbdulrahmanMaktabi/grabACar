<?php

use Illuminate\Support\Facades\Auth;

function isSuperAdmin()
{
    return Auth::guard('admin')->user()->getRoleNames()[0] == 'Super Admin';
}
