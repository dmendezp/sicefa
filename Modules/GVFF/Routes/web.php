<?php

use Illuminate\Support\Facades\Route;



Route::middleware(['lang'])->group(function () {
    Route::prefix('gvff')->group(function () {
        //Rutas para el administrador
        Route::get('/index', 'GVFFController@index')->name('gvff.index');
        Route::get('/viveros', 'GVFFNurseriesController@index')->name('gvff.admin.nurseries.index');
    });
});






Route::prefix('gvff')->group(function () {
    //Rura para los aprendices
    Route::get('/welcome', 'GVFFController@welcome')->name('gvff.welcome');
});
    



