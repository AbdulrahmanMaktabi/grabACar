<?php

namespace App\Http\Controllers\Back;

use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use App\Models\Car;
use App\Http\Controllers\Controller;
use App\Models\car_type;
use App\Models\fuel;
use App\Models\Marker;
use App\Models\Models;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $user = Auth::guard('admin')->user();

            if (isSuperAdmin() || ($user && $user->hasAnyRole(['Admin']))) {
                return $next($request);
            }

            return abort(404); // Optionally return abort(403) for forbidden access
        });
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cars = Car::paginate(5);
        return view('back.cars.index', get_defined_vars());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $models = Models::all();
        $markers = Marker::all();
        $carTypes = car_type::all();
        $fuels = fuel::all();
        $users = User::all();
        return view('back.cars.create', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCarRequest $request)
    {
        $data = $request->validated();

        $car = Car::create([
            "name" => $data['name'],
            "owner_id" => $data['owner_id'],
            "marker_id" => $data['marker_id'],
            "model_id" => $data['model_id'],
            "carType_id" => $data['carType_id'],
            "fuel_id" => $data['fuel_id'],
            "year" => $data['year'],
            'price' => $data['price'],
            'vin' => $data['vin'],
            'mileage' => $data['mileage'],
            'address' => $data['address'],
            'description' => $data['description'],
            'car_specifications' => $data['car_specifications'],

        ]);

        $car->addMediaFromRequest('image')->toMediaCollection('images');

        return redirect()->route('back.car.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarRequest $request, Car $car)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        //
    }
}
