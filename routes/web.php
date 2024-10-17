<?php

use App\Http\Controllers\Back\AdminController;
use App\Http\Controllers\Back\BackHomeController;
use App\Http\Controllers\Back\UserController;
use App\Http\Controllers\Front\FrontHomeController;
use App\Http\Controllers\ProfileController;
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

// Route::get('/', function () {
//     return view('front.index');
// })->name('home')->middleware('auth');

// Front Dashboard
Route::prefix('dashboard')
    ->name('front.')
    ->group(function () {
        Route::get('/', FrontHomeController::class)->name('index')->middleware(['auth', 'verified']);
    });
require __DIR__ . '/auth.php';

// Back Dashboard
Route::prefix('back')
    ->name('back.')
    ->group(function () {
        Route::get('/', BackHomeController::class)->name('index')->middleware('admin');
        Route::resource('admin', AdminController::class)->middleware('admin');
        Route::resource('user', UserController::class)->middleware('admin');
        require __DIR__ . '/adminAuth.php';
    });
