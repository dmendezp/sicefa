<?php

Route::middleware(['lang'])->group(function(){
    Route::prefix('ptoventa')->group(function() {
        Route::get('/index', 'PTOVENTAController@index')->name('cefa.ptoventa.index');

        Route::get('/developers', 'PTOVENTAController@developers')->name('cefa.ptoventa.developers');
    });
});
