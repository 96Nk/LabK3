<?php

use Modules\Complaint\Http\Controllers\ComplaintController;

Route::prefix('admin/complaint')->controller(ComplaintController::class)->group(function () {
    Route::get('/', 'index')->name('admin.complaint');
});
