<?php

use Illuminate\Support\Facades\Route;



Route::middleware(['lang'])->group(function () {
    Route::prefix('gvff')->group(function () {
        //Rutas para el administrador
        Route::get('/index', 'GVFFController@index')->name('gvff.index');
        Route::get('/viveros', 'GVFFNurseriesController@index')->name('gvff.admin.nurseries.index');
        Route::get('/viveros/create', 'GVFFNurseriesController@create')->name('gvff.admin.nurseries.create');
        Route::post('/viveros/store', 'GVFFNurseriesController@store')->name('gvff.admin.nurseries.store');
        Route::get('/viveros/{nurseries}/edit', 'GVFFNurseriesController@edit')->name('gvff.admin.nurseries.edit');
        Route::put('/viveros/{nurseries}', 'GVFFNurseriesController@update')->name('gvff.admin.nurseries.update');
        Route::delete('/viveros/{nurseriers}', 'GVFFNurseriesController@destroy')->name('gvff.admin.nurseries.destroy');
    });
});






Route::prefix('gvff')->group(function () {
    //Rura para los aprendices
    Route::get('/welcome', 'GVFFController@welcome')->name('gvff.welcome');
});
    



