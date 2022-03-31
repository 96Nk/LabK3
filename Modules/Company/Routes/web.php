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

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin/company')->controller(CompanyController::class)->group(function () {
        Route::get('/', 'index')->name('company');
    });
});

