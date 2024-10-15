<?php

use App\Http\Controllers\Back\BackHomeController;
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

Route::get('/', function () {
    return view('welcome');
});

require __DIR__ . '/auth.php';

Route::prefix('back')
    ->name('back.')
    ->group(function () {
        Route::get('/', BackHomeController::class)->name('index');
        require __DIR__ . '/adminAuth.php';
    });
