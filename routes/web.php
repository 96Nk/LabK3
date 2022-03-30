<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware('guest')->group(function () {
    Route::prefix('auth')->controller(AuthController::class)->group(function () {
        Route::get('login', 'login')->name('login');
        Route::post('login', 'validation');
        Route::get('registration', 'registration')->name('registration');
        Route::post('registration', 'send');
    });
    Route::get('/', HomeController::class)->name('home');
});

Route::middleware('auth')->prefix('auth')->controller(AuthController::class)->group(function () {
    Route::post('logout', 'logout')->name('logout');
});
