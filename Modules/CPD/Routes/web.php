<?php
use Illuminate\Support\Facades\Route;

Route::middleware(['lang'])->group(function(){
    Route::prefix('cpd')->group(function() {

        Route::get('/home', 'CPDController@home')->name('cefa.cpd.home');

    });
});

