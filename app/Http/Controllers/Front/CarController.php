<?php

namespace App\Http\Controllers\Front;

use App\Http\Requests\Front\StoreCarRequest;
use App\Http\Requests\Front\UpdateCarRequest;
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

            $authUser = Auth::guard('web')->user();

            if (!$authUser) {
                return redirect()->route('login');
            }

            if (checkThePermission('web', 'cars_dashboard') && isSameUser('web', $request->route('car')->user->id)) {
                return $next($request);
            }

            return abort(403);
        })->only(['edit']);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $authUser = Auth::guard('web')->user();

        if (!$authUser) {
            return redirect()->route('login');
        }

        $cars = Car::with('model')->where('owner_id', $authUser->id)->paginate(5);

        return view('front.cars.index', get_defined_vars());
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
        return view('front.cars.create', get_defined_vars());
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

        return redirect()->route('front.car.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Car $car)
    {
        // if (Auth::guard('web')->user()->id === $car->owner_id)
        return view('front.cars.show', get_defined_vars());

        // return redirect()->route('front.car.index'); // Optionally return abort(403) for forbidden access
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        if (Auth::guard('web')->user()->id === $car->owner_id) {
            $models = Models::all();
            $markers = Marker::all();
            $carTypes = car_type::all();
            $fuels = fuel::all();
            $users = User::all();
            return view('front.cars.edit', get_defined_vars());
        }
        return redirect()->route('front.car.index'); // Optionally return abort(403) for forbidden access
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCarRequest $request, Car $car)
    {
        $data = $request->validated();

        $car->update([
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

        if ($request->hasFile('image')) {
            $car->clearMediaCollection('images');
            $car->addMediaFromRequest('image')->toMediaCollection('images');
        }

        return redirect()->route('front.car.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Car $car)
    {
        // dd($car->name);
        if (isSameUser('web', $car->user->id)) {
            $car->delete();
            return redirect()->route('front.car.index');
        }
        return redirect()->route('front.car.index');
    }
}
