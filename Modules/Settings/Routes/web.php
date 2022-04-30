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

use Modules\Settings\Http\Controllers\UserController;

Route::middleware(['auth', 'check-user'])->group(function () {
    Route::prefix('setting')->group(function () {
        Route::prefix('user')->controller(UserController::class)->group(function () {
            Route::middleware(['administrator'])->group(function () {
                Route::get('/', 'index')->name('setting.user');
                Route::post('/', 'store');
                Route::put('/{user}', 'updateActive');
                Route::delete('/{user}', 'destroy');
            });
            Route::get('edit', 'edit')->name('setting.profile-user');
            Route::post('edit-password', 'updatePassword');
        });
    });
});
