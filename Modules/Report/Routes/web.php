<?php

use Modules\Report\Http\Controllers\LetterAssignmentController;

Route::middleware(['auth', 'check-user'])->group(function () {
    Route::prefix('report/letter-assignment')->controller(LetterAssignmentController::class)->group(function () {
        Route::get('/', 'index')->name('letter-assignment');
        Route::post('/', 'store');
        Route::post('/posting', 'posting');
        Route::get('/print-pdf/{form}', 'printPdf');
        Route::get('input/{form}', 'inputAssignment');
    });
});
