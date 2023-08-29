<?php

use Modules\AGROCEFA\Http\Controllers\AGROCEFAController;
use Modules\AGROCEFA\Http\Controllers\SpecieController;
use Modules\AGROCEFA\Http\Controllers\VarietyController; // Asegúrate de importar el controlador VarietyController si no está importado.
use Modules\AGROCEFA\Http\Controllers\CropController;


Route::middleware(['lang'])->group(function() {
    Route::prefix('/agrocefa')->group(function() {
        Route::get('/index', 'AGROCEFAController@index')->name('agrocefa.index');
        Route::get('/home/{id}', 'AGROCEFAController@home')->name('agrocefa.home');
        Route::get('/inventory', 'AGROCEFAController@inventory')->name('agrocefa.inventory');
        Route::get('/insumos', 'AGROCEFAController@insumos')->name('agrocefa.insumos');
        Route::get('/bodegas', 'AGROCEFAController@bodega')->name('agrocefa.bodegas');
        Route::get('/parameters', 'AGROCEFAController@parameters')->name('agrocefa.parameters');
        Route::get('/user', 'AGROCEFAController@vistauser')->name('agrocefa.user');

        // RUTAS PARA VARIEDADES
        Route::get('/activty/list', 'ParameterController@list')->name('agrocefa.activity.list');
        Route::get('/activty/crear', 'ParameterController@crear')->name('agrocefa.activity.crear');
        Route::get('/activty/editar', 'ParameterController@edit')->name('agrocefa.activity.editar');
        Route::get('/activty/eliminar', 'ParameterController@delete')->name('agrocefa.activity.eliminar');

        // RUTAS PARA VARIEDADES
        Route::get('/varieties', 'VarietyController@index')->name('agrocefa.varieties.crear');
        Route::get('/varieties/editar', 'VarietyController@edit')->name('agrocefa.varieties.editar');
        Route::get('/varieties/eliminar', 'VarietyController@delete')->name('agrocefa.varieties.eliminar');

        // RUTAS PARA ESPECIES
        Route::get('/species', 'SpecieController@index')->name('agrocefa.species.index');
        Route::get('/species/{id}/edit', 'SpecieController@editView')->name('agrocefa.species.edit');
        Route::get('/species/{id}/delete', 'SpecieController@deleteView')->name('agrocefa.species.delete');
        Route::get('/species/create', 'SpecieController@create')->name('agrocefa.species.create');

        // RUTAS PARA CULTIVOS-CROP
        Route::get('/crop', 'CropController@index')->name('agrocefa.crop.index');
        Route::get('/crop/{id}/edit', 'CropController@editView')->name('agrocefa.crop.edit');
        Route::get('/crop/{id}/delete', 'CropController@deleteView')->name('agrocefa.crop.delete');
        Route::get('/crop/create', 'CropController@create')->name('agrocefa.crop.create');



    });
});
