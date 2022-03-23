<?php

use Modules\Home\Http\Controllers\HomeController;

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('home', HomeController::class);
    });
});
