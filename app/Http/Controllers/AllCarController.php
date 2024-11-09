<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;

class AllCarController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $cars = Car::with('model')->paginate(5);
        return view('front.cars.all', get_defined_vars());
    }
}
