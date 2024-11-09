<?php

use Illuminate\Support\Facades\Auth;

function isSuperAdmin($authAdmin = null)
{
    $user = $authAdmin ?? Auth::guard('admin')->user();

    if (!$user) {
        return false;
    }

    $roles = $user->getRoleNames();
    return $roles->contains('Super Admin');
}
