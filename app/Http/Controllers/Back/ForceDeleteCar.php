<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\Car;
use Illuminate\Http\Request;

class ForceDeleteCar extends Controller
{
    public function force(Car $car)
    {
        if (!isSuperAdmin())
            return abort(404);

        $car->forceDelete();

        return redirect()->route('back.car.index');
    }
}
