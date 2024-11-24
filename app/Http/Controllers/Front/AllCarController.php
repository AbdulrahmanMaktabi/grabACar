<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Models\Car;
use App\Http\Controllers\Controller;

class AllCarController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $cars = Car::with(['user', 'marker', 'model', 'carType', 'fuel', 'media'])->paginate(5);
        return view('front.cars.all', get_defined_vars());
    }
}
