<?php

use App\Models\Favorite;

function isAddedToFavorite($user, $car)
{
    $favoriteExisting = Favorite::where('user_id', $user->id)
        ->where('car_id', $car->id)
        ->first();
    if ($favoriteExisting)
        return true;

    return false;
}
