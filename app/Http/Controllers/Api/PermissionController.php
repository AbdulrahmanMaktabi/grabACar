<?php

namespace App\Http\Controllers\Api;

use App\Helplers\ApiResponse;
use App\Http\Controllers\Controller;
use App\Http\Resources\PermissionResource;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends Controller
{
    public function index(Request $request)
    {
        $permissions = Permission::all();

        $data = PermissionResource::collection($permissions);

        return ApiResponse::sendResponse(200, "Success", $data);
    }

    public function permissionsBasedOnRole($roleID)
    {
        $role = Role::findByID($roleID);

        $permissions = $role->permissions;

        $data = PermissionResource::collection($permissions);

        return ApiResponse::sendResponse(200, "Permissions based on role", $data);
    }
}
