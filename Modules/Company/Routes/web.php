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
use Modules\Company\Http\Controllers\TestApplicationController;
use Modules\Company\Http\Controllers\TestFormController;

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

    Route::prefix('company')->middleware(['company'])->group(function () {
        Route::prefix('test-form')->controller(TestFormController::class)->group(function () {
            Route::get('/', 'index')->name('test.form');
            Route::post('/', 'store');
        });
        Route::prefix('test-application')->controller(TestApplicationController::class)->group(function () {
            Route::get('/', 'index')->name('test.application');
            Route::put('/{form}', 'updatePosting');
            Route::get('detail/{form:form_code}', 'detail');
        });
    });


});


