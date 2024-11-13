<?php

use App\Http\Controllers\Back\AdminController;
use App\Http\Controllers\Back\BackHomeController;
use App\Http\Controllers\Back\CarController;
use App\Http\Controllers\Back\ForceDeleteCar;
use App\Http\Controllers\Back\RestoreDeletedCar;
use App\Http\Controllers\Back\RoleController;
use App\Http\Controllers\Back\UserController;
use App\Http\Controllers\Front\CarController as FrontCarController;
use App\Http\Controllers\Front\FrontHomeController;
use App\Http\Controllers\Front\UserController as FrontUserController;
use App\Http\Controllers\Front\AllCarController;
use App\Http\Controllers\Front\FavoriteCarsController;
use App\Http\Controllers\ProfileController;
use App\Models\Car;
use App\Models\Models;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::redirect('/', '/login');
// Front Dashboard
Route::prefix('dashboard')
    ->name('front.')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('/', FrontHomeController::class)->name('index');
        Route::resource('car', FrontCarController::class);
        Route::get('/cars', AllCarController::class)->name('allCar');
        Route::post('/cars/favorite', [FavoriteCarsController::class, 'store'])->name('favoriteStore');
        Route::delete('/cars/favorite/delete', [FavoriteCarsController::class, 'destroy'])->name('favoriteDelete');
        Route::resource('user', FrontUserController::class)->only(['show', 'edit', 'update', 'destroy']);
    });
require __DIR__ . '/auth.php';

// Back Dashboard
Route::prefix('back')
    ->name('back.')
    ->group(function () {
        Route::get('/', BackHomeController::class)->name('index')->middleware('admin');
        Route::resource('admin', AdminController::class)->middleware('admin');
        Route::resource('user', UserController::class)->middleware('admin');
        Route::resource('role', RoleController::class)->middleware('admin');
        Route::resource('car', CarController::class)->middleware('admin');
        Route::post('/car/restore/{car}', [RestoreDeletedCar::class, 'restore'])->name('restoreCar');
        Route::delete('/car/force/delete/{car}', [ForceDeleteCar::class, 'force'])->name('forceDeleteCar');
        require __DIR__ . '/adminAuth.php';
    });

// api
Route::get('/get-models/{marker_id}/{model_id?}', function ($marker_id) {
    $models = Models::where('marker_id', $marker_id)->get();
    return response()->json($models);
});
