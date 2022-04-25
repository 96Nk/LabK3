<?php


use Modules\Gallery\Http\Controllers\GalleryController;

Route::middleware(['auth', 'check-user', 'administrator'])->prefix('gallery')->group(function () {
    Route::prefix('category')->controller(GalleryController::class)->group(function () {
        Route::get('/', 'index')->name('gallery.category');
        Route::post('/', 'store');
        Route::delete('/{category}', 'destroy');
    });
});
