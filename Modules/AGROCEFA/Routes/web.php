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

use Modules\AGROCEFA\Http\Controllers\AGROCEFAController;

Route::middleware(['lang'])->group(function(){
    Route::prefix('/agrocefa')->group(function() {
        Route::get('/index', 'AGROCEFAController@index')->name('agrocefa.index');
        Route::get('/inventory', 'AGROCEFAController@inventory')->name('agrocefa.inventory');
        Route::get('/insumos', 'AGROCEFAController@insumos')->name('agrocefa.insumos');
        Route::get('/bodegas', 'AGROCEFAController@bodega')->name('agrocefa.bodegas');
        Route::get('/parameters', 'ParameterController@index')->name('agrocefa.parameters');
        Route::get('/user', 'AGROCEFAController@vistauser')->name('agrocefa.user');

<<<<<<< HEAD
        //ruta de varieties//
        Route::get('/varieties','VarietyController@index')->name('agrocefa.varieties.crear');
        Route::get('/varieties/editar','VarietyController@edit')->name('agrocefa.varieties.editar');
        Route::get('/varieties/eliminar','VarietyController@delete')->name('agrocefa.varieties.eliminar');

       
=======
        //RUTAS PARAMETRO DE ESPECIES
        Route::get('/species', 'SpecieController@index')->name('agrocefa.species.index');
        Route::get('/species/{id}/edit', 'SpecieController@editView')->name('agrocefa.species.edit');
        Route::get('/species/{id}/delete', 'SpecieController@deleteView')->name('agrocefa.species.delete');
        Route::get('/species/create', 'SpecieController@create')->name('agrocefa.species.create');


/*      Route::get('/species', 'SpecieController@create')->name('agrocefa.species.create');
        Route::get('/species', 'SpecieController@edit')->name('agrocefa.species.edit');
        Route::get('/species', 'SpecieController@delete')->name('agrocefa.species.delete'); */


>>>>>>> 4e552e566e75df54c8c7734ffe0fad35832a589a
    });
});
