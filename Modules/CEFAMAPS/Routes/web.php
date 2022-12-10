<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['lang'])->group(function(){

    Route::prefix('cefamaps')->group(function() {

        Route::get('/index', 'CEFAMAPSController@index')->name('cefa.cefamaps.index');

        Route::get('/admin', 'AdminController@dashboard')->name('cefamaps.admin.dashboard');

        Route::get('/environment/index', 'AdminController@environment')->name('cefamaps.admin.environment.index');
    });

});
