<?php

Route::middleware(['lang'])->group(function(){
    Route::prefix('pqrs')->group(function() {
        Route::get('/index', 'PQRSController@index')->name('cefa.pqrs.home.index');

        Route::get('/tracking/index', 'TrackingController@index')->name('pqrs.tracking.index');
    });
});
