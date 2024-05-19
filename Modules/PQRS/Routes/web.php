<?php

Route::middleware(['lang'])->group(function(){
    Route::prefix('pqrs')->group(function() {
        Route::get('/index', 'PQRSController@index')->name('cefa.pqrs.home.index');

        Route::get('/tracking/index', 'TrackingController@index')->name('pqrs.tracking.index');
        Route::get('/tracking/searchOfficial', 'TrackingController@searchOfficial')->name('pqrs.tracking.searchOfficial');
        Route::post('/tracking/store', 'TrackingController@store')->name('pqrs.tracking.store');
        Route::post('/tracking/assign/{id}', 'TrackingController@assign')->name('pqrs.tracking.assign');
    });
});
