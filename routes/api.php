<?php

use App\Http\Controllers\Api\CarController;
use App\Http\Controllers\Api\RoleController;
use App\Http\Controllers\Api\PermissionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Cars Model
Route::get('cars', CarController::class);
// Roles Model
Route::get('roles',  RoleController::class);
// Permissions Model
Route::get('permissions', [PermissionController::class, 'index']);
Route::get('permissions/{roleID}', [PermissionController::class, 'permissionsBasedOnRole']);
