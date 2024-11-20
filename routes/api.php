<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\AdminAuthController;
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
| Define your API routes here. These routes are loaded by the
| RouteServiceProvider and are assigned to the "api" middleware group.
|
*/

// ======================================== Car Routes
Route::prefix('cars')->group(function () {
    Route::get('/', [CarController::class, 'index']); // Get all cars
    Route::get('/show/{carID}', [CarController::class, 'show']); // Get specific car
    Route::post('/create', [CarController::class, 'create']); // Create a new car
    Route::post('/edit/{carID}', [CarController::class, 'update']); // Edit a specefic car
    // Add more car-related routes if needed, e.g., show, create, update, delete
});

// ======================================== Role Routes
Route::prefix('roles')->group(function () {
    Route::get('/', [RoleController::class, 'index']); // List all roles
    // Add more role-related routes if needed
});

// ======================================== Permission Routes
Route::prefix('permissions')->group(function () {
    Route::get('/', [PermissionController::class, 'index']); // List all permissions
    Route::get('/{roleID}', [PermissionController::class, 'permissionsBasedOnRole']); // Permissions based on role
});

// ======================================== User Authentication Routes
Route::prefix('auth')->controller(AuthController::class)->group(function () {
    Route::post('register', 'register'); // User registration
    Route::post('login', 'login'); // User login
    Route::post('logout', 'logout')->middleware('auth:sanctum'); // User logout
});

// ======================================== Admin Authentication Routes
Route::prefix('admin/auth')->controller(AdminAuthController::class)->group(function () {
    Route::post('register', 'register'); // Admin registration
    Route::post('login', 'login'); // Admin login
    Route::post('logout', 'logout')->middleware('auth:sanctum'); // Admin logout
});
