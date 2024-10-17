<?php

use Illuminate\Support\Facades\Auth;

function isSameUser($guard, $id)
{
    return Auth::guard($guard)->user()->id == $id;
}
