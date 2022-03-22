<?php

use Modules\Home\Http\Controllers\HomeController;

Route::middleware(['auth'])->group(function () {
    Route::prefix('admin')->controller(HomeController::class)->group(function () {
        Route::get('home', 'index');
    });
});
