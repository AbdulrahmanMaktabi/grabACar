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
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        // $cars = DB::table('cars')->get();
        $perPage = $request->get('per_page', 5);

        $cars = Car::paginate($perPage);

        if (!$cars) return ApiResponse::sendResponse(404, 'No cars found');

        $data = CarsResource::collection($cars);

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
}
