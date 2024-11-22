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
Route::prefix('cars')
    ->controller(CarController::class)
    ->group(function () {
        Route::get('/', 'index'); // Get all cars
        Route::get('/show/{carID}',  'show'); // Get specific car
        Route::get('/user/{userID}',  'userCars'); // Get cars based on specific user  
        // Must Auth Routes
        Route::middleware('auth:sanctum')->group(function () {
            Route::post('/create', 'create'); // Create a new car
            Route::post('/edit/{carID}',  'update'); // Edit a specefic car
            Route::delete('/delete/{carID}',  'destroy'); // Delete a specefic car
            Route::delete('/delete/force/{carID}',  'forceDestroy'); // Force Delete a specefic car
        });
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
