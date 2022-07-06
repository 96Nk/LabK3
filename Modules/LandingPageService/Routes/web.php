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

Route::prefix('landing-page')->group(function () {
    Route::prefix('services')->group(function () {
        Route::get('/', 'LandingPageServiceController@index');
        Route::get('create', 'LandingPageServiceController@create');
        Route::post('store', 'LandingPageServiceController@store');
        Route::post('upload', 'LandingPageServiceController@upload')->name('landingPage_service_upload');
        Route::get('show/{serviceLandingId}', 'LandingPageServiceController@show');
        Route::get('edit/{serviceLandingId}', 'LandingPageServiceController@edit');
        Route::post('update/{serviceLandingId}', 'LandingPageServiceController@update');
        Route::get('destroy/{serviceLandingId}', 'LandingPageServiceController@destroy');
    });
});
