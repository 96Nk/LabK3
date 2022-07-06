<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
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
        Route::post('login', 'validation')->name('login');
        Route::get('registration', 'registration')->name('registration');
        Route::post('registration-store', 'registrationStore');
    });
//    Route::get('/', HomeController::class)->name('home');
    Route::controller(HomeController::class)->group(function () {
        Route::get('/', 'index')->name('home');
    });
    Route::controller(GalleryController::class)->group(function () {
        Route::get('gallery/{galleryCategoryId}', 'index');
    });
    Route::controller(ServiceController::class)->group(function () {
        Route::get('layanan-kami/{serviceLandingId}', 'index');
    });
});

Route::middleware('auth')->prefix('auth')->controller(AuthController::class)->group(function () {
    Route::post('logout', 'logout')->name('logout');
});
