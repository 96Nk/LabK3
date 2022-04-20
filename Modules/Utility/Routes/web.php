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

use Modules\Utility\Http\Controllers\SignerController;

Route::middleware(['auth', 'check-user', 'administrator'])->prefix('utility')->group(function () {
    Route::prefix('signer')->controller(SignerController::class)->group(function () {
        Route::get('/', 'index')->name('utility.signer');
        Route::post('/', 'store');
        Route::delete('/{letterSigner}', 'destroy');
    });
});
