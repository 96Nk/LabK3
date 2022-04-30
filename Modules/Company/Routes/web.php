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

use Modules\Company\Http\Controllers\CompanyController;

Route::middleware(['auth', 'check-user'])->group(function () {
    Route::prefix('admin/company')->controller(CompanyController::class)->group(function () {
        Route::middleware(['administrator'])->group(function () {
            Route::get('/', 'index')->name('company');
            Route::post('verification', 'verification')->name('company.verification');
            Route::post('resending', 'resending')->name('company.resending');
            Route::put('/{company}', 'update');
            Route::delete('/{company}', 'destroy');
        });
        Route::put('/{company}', 'update');
    });
});


