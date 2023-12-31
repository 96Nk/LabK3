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
use Modules\Company\Http\Controllers\ComplaintController;
use Modules\Company\Http\Controllers\TestApplicationController;
use Modules\Company\Http\Controllers\TestFormController;

Route::middleware(['auth', 'check-user'])->group(function () {
    Route::prefix('admin/company')->controller(CompanyController::class)->group(function () {
        Route::middleware(['administrator'])->group(function () {
            Route::get('/', 'index')->name('company');
            Route::get('/{id}', 'show');
            Route::post('verification', 'verification')->name('company.verification');
            Route::post('reset', 'reset')->name('company.reset');
            Route::put('/{company}', 'update');
            Route::delete('/{company}', 'destroy');
        });
        Route::put('/{company}', 'update');
    });

    Route::prefix('company/test-form')->controller(TestFormController::class)->group(function () {
        Route::get('/', 'index')->name('test.form');
        Route::get('edit/{form:form_code}', 'edit');
        Route::put('/{form}', 'update');
        Route::post('/', 'store');
        Route::delete('/{form}', 'destroy');
    });

    Route::prefix('company/test-application')->controller(TestApplicationController::class)->group(function () {
        Route::get('/', 'index')->name('test.application');
        Route::get('/detail/{form:form_code}', 'detail');
        Route::put('/{form}', 'updatePosting');
    });

    Route::prefix('company/complaint')->controller(ComplaintController::class)->group(function () {
        Route::get('/', 'index')->name('complaint');
        Route::post('/', 'store');
        Route::get('/{complaint}', 'show')->name('complaint.show');
        Route::put('/posting/{complaint}', 'posting');
        Route::put('/end/{complaint}', 'end');
        Route::delete('/{complaint}', 'destroy');
    });


//    Route::prefix('company')->middleware(['company'])->group(function () {

//        Route::prefix('test-form')->controller(TestFormController::class)->group(function () {
//            Route::get('/', 'index')->name('test.form');
//            Route::get('edit/{form:form_code}', 'edit');
//            Route::put('/{form}', 'update');
//            Route::post('/', 'store');
//            Route::delete('/{form}', 'destroy');
//        });
//
//        Route::prefix('test-application')->controller(TestApplicationController::class)->group(function () {
//            Route::get('/', 'index')->name('test.application');
//            Route::put('/{form}', 'updatePosting');
//        });
//    });

//    Route::prefix('company/test-application')->controller(TestApplicationController::class)->group(function () {
//
//    });


});



