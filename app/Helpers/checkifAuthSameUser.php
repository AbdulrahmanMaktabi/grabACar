<?php

use Illuminate\Support\Facades\Auth;

function isSameUser($id)
{
    return Auth::guard('admin')->user()->id == $id;
}
