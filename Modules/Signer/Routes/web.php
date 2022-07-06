<?php

use Modules\Signer\Http\Controllers\AgreementController;
use Modules\Signer\Http\Controllers\AssignmentController;

Route::middleware(['auth', 'check-user'])->group(function () {
    Route::prefix('signer/assignment')->controller(AssignmentController::class)->group(function () {
        Route::get('/', 'index')->name('signer-assignment');
        Route::post('/', 'signerAssignment');
        Route::get('/{assignment}', 'verification');
        Route::post('/correct', 'correctAssignment');
    });

    Route::prefix('signer/agreement')->controller(AgreementController::class)->group(function () {
        Route::get('/', 'index')->name('signer-agreement');
        Route::post('/', 'signerAgreement');
        Route::get('/{agreement}', 'verification');
        Route::post('/correct', 'correctAgreement');
    });
});
