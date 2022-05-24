<?php

use Modules\Reviews\Http\Controllers\TestApplicationController;

Route::middleware(['auth', 'check-user'])->group(function () {
    Route::prefix('reviews/test-application')->controller(TestApplicationController::class)->group(function () {
        Route::get('/', 'index')->name('reviews.test-application');
        Route::put('/verification/{form}', 'reviewForm');
        Route::get('/{form}', 'formVerification');
        Route::post('/officer-temp', 'storeOfficerTemp');
        Route::delete('/officer-temp/{temp}', 'deleteOfficerTemp');
    });
});

