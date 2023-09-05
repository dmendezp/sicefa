<?php

use Modules\AGROCEFA\Http\Controllers\AGROCEFAController;
use Modules\AGROCEFA\Http\Controllers\SpecieController;
use Modules\AGROCEFA\Http\Controllers\VarietyController; // Asegúrate de importar el controlador VarietyController si no está importado.
use Modules\AGROCEFA\Http\Controllers\CropController;
use Modules\AGROCEFA\Http\Controllers\UsuarioController;


Route::middleware(['lang'])->group(function() {
    Route::prefix('/agrocefa')->group(function() {
        
        Route::get('/index', 'AGROCEFAController@index')->name('agrocefa.index');
        Route::get('/home', 'AGROCEFAController@home')->name('agrocefa.home');
        Route::get('/select-unit/{id}', 'AGROCEFAController@selectUnit')->name('agrocefa.select-unit');
        Route::get('/insumos', 'AGROCEFAController@insumos')->name('agrocefa.insumos');
        Route::get('/bodegas', 'AGROCEFAController@bodega')->name('agrocefa.bodegas');
        Route::get('/parameters', 'Parameters\ParameterAgroController@parametersview')->name('agrocefa.parameters');
        Route::get('/user', 'AGROCEFAController@vistauser')->name('agrocefa.user');

        //RUTAS DE INVENTARIO
        Route::get('/inventory', 'InventoryController@inventory')->name('agrocefa.inventory');
        Route::post('/inventory/showWarehouseFilter', 'InventoryController@showWarehouseFilter')->name('agrocefa.inventory.showWarehouseFilter');


        // RUTAS PARA MOVIMIENTOS
        Route::get('/movements', 'MovementController@viewmovements')->name('agrocefa.movements');
        Route::get('/movements/formentrance', 'MovementController@formentrance')->name('agrocefa.formentrance');
        Route::get('/movements/formexit', 'MovementController@formexit')->name('agrocefa.formexit');
        Route::post('/movements/registerentrance', 'MovementController@registerentrance')->name('agrocefa.registerentrance');
        Route::post('/movements/registerexit', 'MovementController@registerexit')->name('agrocefa.registerexit');
        Route::get('/obtener_unidad_de_medida', 'MovementController@obtenerUnidadDeMedida')->name('agrocefa.obtenerunidadmedida');
        Route::get('/obtener_categoria', 'MovementController@obtenercategotria')->name('agrocefa.obtenercategoria');
        

        // RUTAS PARA ACTIVIDADES
        Route::get('/activities', 'Parameters\ActivityController@getActivitiesForSelectedUnit')
            ->name('agrocefa.activities');
        Route::post('/activity/create', 'Parameters\ActivityController@createActivity')->name('agrocefa.activity.create');
        Route::put('/activity/edit/{id}', 'Parameters\ActivityController@editActivity')->name('agrocefa.activity.edit');
        Route::delete('/activity/delete/{id}', 'Parameters\ActivityController@deleteActivity')->name('agrocefa.activity.delete');

        // RUTAS PARA METODO DE APLICACION
        Route::post('/aplication/create/', 'Parameters\AplicationMethodController@createAgriculturalMethod')->name('agrocefa.aplication.create');
        Route::post('/aplication/edit/{id}', 'Parameters\AplicationMethodController@editAgriculturalMethod')->name('agrocefa.aplication.edit');
        Route::delete('/aplication/delete/{id}', 'Parameters\AplicationMethodController@deleteAplication')->name('agrocefa.aplication.delete');

        // RUTAS PARA VARIEDADES
        Route::post('/varieties', 'Parameters\ParameterAgroController@crear')->name('agrocefa.varieties.crear');

        Route::get('/varieties/{id}/editar', 'VarietyController@edit')->name('agrocefa.varieties.editar');

        Route::get('/varieties/{id}', 'VarietyController@delete')->name('agrocefa.varieties.eliminar');

        Route::delete('/varieties/delete/{id}', 'Parameters\ParameterAgroController@elim')->name('agrocefa.varieties.elim');
        
        Route::get('/varieties/{id}/edit', 'varietyController@edit')->name('agrocefa.varieties.edit');
        
        Route::get('/varieties', 'Parameters\ParameterAgroController@listsvarieties')->name('agrocefa.varieties.index');

        // RUTAS PARA ESPECIES
        Route::get('/species', 'Parameters\ParameterAgroController@listspecie')->name('agrocefa.species.index');

        Route::get('/species/{id}/edit', 'SpecieController@editView')->name('agrocefa.species.edit');
        Route::put('/species/{id}', 'Parameters\ParameterAgroController@update')->name('agrocefa.species.update');
        
        Route::delete('/species/delete/{id}', 'Parameters\ParameterAgroController@destroy')->name('agrocefa.species.destroy');

        Route::get('/species/create', 'SpecieController@create')->name('agrocefa.species.create');
        Route::post('/species', 'Parameters\ParameterAgroController@store')->name('agrocefa.species.store');


        // RUTAS PARA CULTIVOS-CROP
        Route::get('/crop', 'CropController@index')->name('agrocefa.crop.index');
        Route::get('/crop/{id}/edit', 'CropController@editView')->name('agrocefa.crop.edit');
        Route::get('/crop/{id}/delete', 'CropController@deleteView')->name('agrocefa.crop.delete');
        Route::get('/crop/create', 'CropController@create')->name('agrocefa.crop.create');

        //ruta de vista de desarrolladores
        Route::get('/desarrolladores', 'desarrolladoresController@index')->name('agrocefa.desarrolladores.index');

        //ruta para vista de bienvenida al usario
        Route::get('/usuario', 'usuarioController@index')->name('agrocefa.usuario.index');
});


    });

