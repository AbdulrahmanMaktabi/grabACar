<?php

namespace App\Http\Controllers\Api;

use App\Helplers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\RoleResource;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function index(Request $request)
    {
        $roles = Role::all();

        $data = RoleResource::collection($roles);

        return ApiResponse::sendResponse(200, 'success', $data);
    }
}
