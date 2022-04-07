<?php

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

use Modules\Referensi\Http\Controllers\EmployeeController;
use Modules\Referensi\Http\Controllers\PositionController;
use Modules\Referensi\Http\Controllers\RefCityController;
use Modules\Referensi\Http\Controllers\RefDistrictController;
use Modules\Referensi\Http\Controllers\RefVillageController;

Route::prefix('referensi/city')->group(function () {
    Route::controller(RefCityController::class)->group(function () {
        Route::get('load-city/{prov_id}', 'loadCities');
    });
});

Route::prefix('referensi/district')->group(function () {
    Route::controller(RefDistrictController::class)->group(function () {
        Route::get('load-district/{city_id}', 'loadDistricts');
    });
});


Route::prefix('referensi/village')->group(function () {
    Route::controller(RefVillageController::class)->group(function () {
        Route::get('load-village/{refVillage:district_id}', 'loadVillage');
    });
});


Route::middleware(['auth'])->prefix('referensi')->group(function () {
    Route::prefix('employee')->controller(EmployeeController::class)->group(function () {
        Route::get('/', 'index')->name('referensi.employee');
        Route::post('/', 'store');
        Route::delete('/{refEmployee}', 'destroy');
    });

    Route::prefix('position')->controller(PositionController::class)->group(function () {
        Route::get('/', 'index')->name('referensi.position');
        Route::post('/', 'store');
        Route::delete('/{refPosition}', 'destroy');
    });
});

