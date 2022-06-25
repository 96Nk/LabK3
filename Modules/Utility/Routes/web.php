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

use Modules\Utility\Http\Controllers\AccountController;
use Modules\Utility\Http\Controllers\ActivityController;
use Modules\Utility\Http\Controllers\RegulationController;
use Modules\Utility\Http\Controllers\SignerController;
use Modules\Utility\Http\Controllers\UnitController;

Route::middleware(['auth', 'check-user', 'administrator'])->prefix('utility')->group(function () {
    Route::prefix('signer')->controller(SignerController::class)->group(function () {
        Route::get('/', 'index')->name('utility.signer');
        Route::post('/', 'store');
        Route::delete('/{letterSigner}', 'destroy');
    });
    Route::prefix('activity')->controller(ActivityController::class)->group(function () {
        Route::get('/', 'index')->name('utility.activity');
        Route::post('/', 'store');
        Route::delete('/{activity}', 'destroy');
    });
    Route::prefix('regulation')->controller(RegulationController::class)->group(function () {
        Route::get('/', 'index')->name('utility.regulation');
        Route::put('/', 'update');
    });
    Route::prefix('account')->controller(AccountController::class)->group(function () {
        Route::get('/', 'index')->name('utility.account');
        Route::put('/', 'update');
    });
    Route::prefix('unit')->controller(UnitController::class)->group(function () {
        Route::get('/', 'index')->name('utility.unit');
        Route::put('/', 'update');
    });
});
