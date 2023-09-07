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
        Route::get('/activities', 'Parameters\ActivityController@getActivitiesForSelectedUnit')->name('agrocefa.activities');
        Route::post('/activity/create', 'Parameters\ActivityController@createActivity')->name('agrocefa.activity.create');
        Route::put('/activity/edit/{id}', 'Parameters\ActivityController@editActivity')->name('agrocefa.activity.edit');
        Route::delete('/activity/delete/{id}', 'Parameters\ActivityController@deleteActivity')->name('agrocefa.activity.delete');

        // RUTAS PARA METODO DE APLICACION
        Route::post('/aplication/create/', 'Parameters\AplicationMethodController@createAgriculturalMethod')->name('agrocefa.aplication.create');
        Route::post('/aplication/edit/{id}', 'Parameters\AplicationMethodController@editAgriculturalMethod')->name('agrocefa.aplication.edit');
        Route::delete('/aplication/delete/{id}', 'Parameters\AplicationMethodController@deleteAplication')->name('agrocefa.aplication.delete');

        // RUTAS PARA VARIEDADES

        Route::get('/varieties', 'VarietyController@create')->name('agrocefa.varieties.store');
        Route::put('/varieties/{id}/update', 'VarietyController@update')->name('agrocefa.varieties.update');
        Route::delete('/varieties/delete/{id}', 'VarietyController@delete')->name('agrocefa.varieties.delete');


        // Ruta que acepta tanto GET como POST para la creación de variedades
        Route::match(['get', 'post'], '/varieties/create', 'VarietyController@create')->name('agrocefa.varieties.create');

        // Ruta POST para el almacenamiento de variedades
        Route::post('/varieties', 'VarietyController@store')->name('agrocefa.varieties.store');



        // RUTAS PARA ESPECIES
        Route::get('/species', 'Parameters\ParameterAgroController@listspecie')->name('agrocefa.species.index');
        Route::get('/species/{id}/edit', 'SpecieController@editView')->name('agrocefa.species.edit');
        Route::put('/species/{id}', 'Parameters\ParameterAgroController@update')->name('agrocefa.species.update');
        Route::delete('/species/delete/{id}', 'Param eters\ParameterAgroController@destroy')->name('agrocefa.species.destroy');
        Route::get('/species/create', 'SpecieController@create')->name('agrocefa.species.create');
        Route::post('/species', 'Parameters\ParameterAgroController@store')->name('agrocefa.species.store');
        


        // RUTAS PARA CULTIVOS-CROP
        Route::get('/crop', 'CropController@index')->name('agrocefa.crop.index');
        Route::put('/crop/edit/{id}', 'CropController@editCrop')->name('agrocefa.crop.edit');
        Route::put('/crop/{id}/update', 'CropController@update')->name('agrocefa.crop.update');
        Route::delete('/crop/delete/{id}', 'CropController@deleteCrop')->name('agrocefa.crop.delete');
        Route::post('/crop/create', 'CropController@createCrop')->name('agrocefa.crop.create');
        
        





        
        //ruta de vista de desarrolladores
        Route::get('/desarrolladores', 'desarrolladoresController@index')->name('agrocefa.desarrolladores.index');

        //ruta para vista de bienvenida al usario
        Route::get('/usuario', 'usuarioController@index')->name('agrocefa.usuario.index');
});


    });

