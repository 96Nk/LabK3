<?php

use Modules\Report\Http\Controllers\LetterAgreementController;
use Modules\Report\Http\Controllers\LetterAssignmentController;

Route::middleware(['auth', 'check-user'])->group(function () {
    Route::prefix('report/letter-assignment')->controller(LetterAssignmentController::class)->group(function () {
        Route::get('/', 'index')->name('letter-assignment');
        Route::post('/', 'store');
        Route::post('/posting', 'posting');
        Route::get('/print-pdf/{form}', 'printPdf');
        Route::get('input/{form}', 'inputAssignment');
    });
    Route::prefix('report/letter-agreement')->controller(LetterAgreementController::class)->group(function () {
        Route::get('/', 'index')->name('letter-agreement');
        Route::post('/', 'store');
        Route::post('/posting', 'posting');
        Route::get('/print-pdf/{form}', 'printPdf');
        Route::get('input/{form}', 'inputAgreement');
    });
});
