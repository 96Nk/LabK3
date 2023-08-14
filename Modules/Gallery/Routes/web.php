<?php


use Modules\Gallery\Http\Controllers\CategoryController;
use Modules\Gallery\Http\Controllers\ItemController;

Route::prefix('admin')->group(function () {
    Route::prefix('gallery')->controller(CategoryController::class)->group(function () {
        Route::get('/', 'index')->name('gallery.category');
        Route::post('/', 'store');
        Route::delete('/{category}', 'destroy');
    });
    Route::prefix('items')->controller(ItemController::class)->group(function () {
        Route::get('/{category}', 'index')->name('gallery.items');
        Route::post('/', 'store');
        Route::delete('/{item}', 'destroy');
    });
});
