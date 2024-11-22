<?php

namespace App\Http\Controllers\Api;

use App\Helplers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\CarsResource;
use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarController extends Controller
{

    /**
     * Get All Available Cars
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 5);

        $cars = Car::withTrashed()->paginate($perPage);

        if (!$cars) return ApiResponse::sendResponse(404, 'No cars found');

        $data = [
            'data' => CarsResource::collection($cars)
        ];

        $links = [
            'first' => $cars->url(1),
            'last' => $cars->url($cars->lastPage()),
            'prev' => $cars->previousPageUrl(),
            'next' => $cars->nextPageUrl(),
        ];

        $meta = [
            'total' => $cars->total(),
            'per_page' => $cars->perPage(),
            'current_page' => $cars->currentPage(),
            'last_page' => $cars->lastPage(),
            'from' => $cars->firstItem(),
            'to' => $cars->lastItem(),
        ];

        return ApiResponse::sendResponse(200, 'Cars retrieved successfully', $data, $links, $meta);
    }

    /**
     * Get Specific Car
     */
    public function show($carID)
    {
        $car = Car::withTrashed()->find($carID);

        if (!$car) {
            return ApiResponse::sendResponse(422, 'Car not found');
        }

        $data = ['data' => new CarsResource($car)];
        return ApiResponse::sendResponse(200, 'Car Found', $data);
    }

    /**
     * Get Cars with Specific User
     */
    public function userCars($userID)
    {
        $cars = Car::withTrashed()
            ->where('owner_id', $userID)
            ->get();

        if (!$cars) {
            return ApiResponse::sendResponse(422, 'No Cars Found for user');
        }

        $data = ['data' => CarsResource::collection($cars)];
        return ApiResponse::sendResponse(200, 'Cars Found', $data);
    }

    /**
     * Create New Car
     */
    public function create(Request $request)
    {
        $validated = $request->validate([
            "name" => ["required", "string"],
            "marker_id" => ["required", "exists:markers,id"],
            "model_id" => ["required", "exists:models,id"],
            "carType_id" => ["required", "exists:car_types,id"],
            "fuel_id" => ["required", "exists:fuels,id"],
            "year" => ["required"],
            'image' => ['required', 'file', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'price' => ['required'],
            'vin' => ['required'],
            'mileage' => ['required'],
            'address' => ['required', 'string'],
            'description' => ['required', 'string'],
            'car_specifications' => ['required', 'string'],
        ]);

        $validated['owner_id'] = $request->user()->id;

        $car = Car::create(collect($validated)->except('image')->toArray());

        $car->addMediaFromRequest('image')->toMediaCollection('images');

        if ($car) return ApiResponse::sendResponse(201, 'Car created successfully', ['data' => new CarsResource($car)]);

        return ApiResponse::sendResponse(422, 'Failed to create car');
    }

    /**
     * Update Specefic Car
     */
    public function update(Request $request, $carID)
    {
        $car = Car::withTrashed()
            ->where('id', $carID)
            ->where('owner_id', $request->user()->id)
            ->first();

        if (!$car) {
            return ApiResponse::sendResponse(422, 'Car not found or you are not allowed to update');
        }

        $validated = $request->validate([
            "name" => ["nullable", "string"],
            "marker_id" => ["nullable", "exists:markers,id"],
            "model_id" => ["nullable", "exists:models,id"],
            "carType_id" => ["nullable", "exists:car_types,id"],
            "fuel_id" => ["nullable", "exists:fuels,id"],
            "year" => ["nullable"],
            'image' => ['nullable', 'file', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'price' => ['nullable'],
            'vin' => ['nullable'],
            'mileage' => ['nullable'],
            'address' => ['nullable', 'string'],
            'description' => ['nullable', 'string'],
            'car_specifications' => ['nullable', 'string'],
        ]);

        $validated['owner_id'] = $request->user()->id;

        $car->update(collect($validated)->except('image')->toArray());

        if ($request->hasFile('image')) {
            $car->clearMediaCollection('images');
            $car->addMediaFromRequest('image')->toMediaCollection('images');
        }

        if ($car) return ApiResponse::sendResponse(200, 'Car updated successfully', ['data' => new CarsResource($car)]);
    }

    /**
     * Delete Specefic Car
     */
    public function destroy(Request $request, $carID)
    {
        $car = Car::withTrashed()
            ->where('id', $carID)
            ->where('owner_id', $request->user()->id)
            ->first();

        if (!$car) {
            return ApiResponse::sendResponse(422, 'Car not found or you are not allowed to delete');
        }

        $car->delete();

        if ($car) return ApiResponse::sendResponse(200, 'Car deleted successfully');
    }
    /**
     * Force Delete Specefic Car
     */
    public function forceDestroy(Request $request, $carID)
    {
        $car = Car::withTrashed()
            ->where('id', $carID)
            ->where('owner_id', $request->user()->id)
            ->first();

        if (!$car) {
            return ApiResponse::sendResponse(422, 'Car not found or you are not allowed to delete');
        }

        $car->forceDelete();

        if ($car) return ApiResponse::sendResponse(200, 'Car deleted successfully');
    }
}
