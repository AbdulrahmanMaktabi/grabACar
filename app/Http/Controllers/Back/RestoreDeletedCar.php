<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class RestoreDeletedCar extends Controller
{
    public function restore(Car $car)
    {
        if (!isSuperAdmin())
            return abort(404);

        $car->restore();
        return redirect()->route('back.car.index');
    }
}
