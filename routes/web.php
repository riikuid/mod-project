<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\MovieGenreController;
use App\Http\Controllers\MovieItemController;
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

Route::group(['middleware' => ['auth:sanctum', 'verified']], function () {
    Route::name('dashboard.')->prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');
        Route::resource('genre', MovieGenreController::class);
        Route::resource('movie', MovieController::class);
        Route::resource('movie.detail', MovieItemController::class)->shallow()->only([
            'index', 'create', 'store', 'destroy'
        ]);;
    });
});