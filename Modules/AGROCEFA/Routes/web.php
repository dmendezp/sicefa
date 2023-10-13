<?php

use Modules\AGROCEFA\Http\Controllers\AGROCEFAController;
use Modules\AGROCEFA\Http\Controllers\SpecieController;
use Modules\AGROCEFA\Http\Controllers\VarietyController; // Asegúrate de importar el controlador VarietyController si no está importado.
use Modules\AGROCEFA\Http\Controllers\CropController;
use Modules\AGROCEFA\Http\Controllers\UsuarioController;
use Modules\AGROCEFA\Http\Controllers\LaborManagementController;


Route::middleware(['lang'])->group(function() {
    Route::prefix('/agrocefa')->group(function() {
        
        //Rutas Principales
        Route::get('/index', 'AGROCEFAController@index')->name('agrocefa.index');
        Route::get('/home', 'AGROCEFAController@home')->name('agrocefa.home');
        Route::get('/select-unit/{id}', 'AGROCEFAController@selectUnit')->name('agrocefa.select-unit');
        Route::get('/bodegas', 'AGROCEFAController@bodega')->name('agrocefa.bodegas');
        Route::get('/parameters', 'Parameters\ParameterAgroController@parametersview')->name('agrocefa.parameters.index');
        Route::get('/user', 'AGROCEFAControll er@vistauser')->name('agrocefa.user');


        //RUTAS DE INVENTARIO
        Route::get('/inventory', 'InventoryController@inventory')->name('agrocefa.inventory');
        Route::post('/inventory/showWarehouseFilter', 'InventoryController@showWarehouseFilter')->name('agrocefa.inventory.showWarehouseFilter');
        Route::post('/inventory', 'InventoryController@store')->name('agrocefa.inventory.store');
        Route::post('/inventory/addCategory', 'InventoryController@addCategory')->name('agrocefa.inventory.addCategory');
        Route::post('/inventory/addElement', 'InventoryController@addElement')->name('agrocefa.inventory.addElement');
        Route::put('/inventory/{id}', 'InventoryController@update')->name('agrocefa.inventory.update');
        Route::delete('/inventory/delete/{id}', 'InventoryController@destroy')->name('agrocefa.inventory.destroy');


        // RUTAS PARA MOVIMIENTOS

        Route::get('/movements', 'MovementController@viewmovements')->name('agrocefa.movements');
        Route::get('/movements/formentrance', 'MovementController@formentrance')->name('agrocefa.formentrance');
        Route::get('/movements/formexit', 'MovementController@formexit')->name('agrocefa.formexit');
        Route::get('/movements/request', 'MovementController@requestentrance')->name('agrocefa.movements.notification');
        Route::post('/movements/request/confirmation/{id}', 'MovementController@confirmation')->name('agrocefa.movements.confirmation');
        Route::post('/movements/request/returnmovement/{id}', 'MovementController@returnMovement')->name('agrocefa.movements.return');
        Route::post('/movements/registerentrance', 'MovementController@registerentrance')->name('agrocefa.registerentrance');
        Route::post('/movements/registerexit', 'MovementController@registerexit')->name('agrocefa.registerexit');
        Route::get('/obtener_warehouse', 'MovementController@obtenerwarehouse')->name('agrocefa.warehouse');
        Route::get('/obtener_element', 'MovementController@obtenerelement')->name('agrocefa.obtenerelement');
        Route::get('/obtener_price', 'MovementController@getprice')->name('agrocefa.getprice');
        Route::get('/obtener_datoselementoseleccionado', 'MovementController@obtenerDatosElemento')->name('agrocefa.obtenerdatos');

        
        // RUTAS PARA GESTION DE LABORES

        Route::get('/labormanagement', 'labormanagementController@index')->name('agrocefa.labormanagement.index');
        Route::get('/labormanagement/culturalwork', 'LaborManagementController@culturalwork')->name('agrocefa.culturalwork');
        Route::get('/labormanagement/obtener_responsability', 'LaborManagementController@obteneresponsability')->name('agrocefa.obteneresponsability');
        Route::get('/labormanagement/obtener_crop', 'LaborManagementController@obtenerecrop')->name('agrocefa.obtenerecrop');
        Route::get('/labormanagement/obtener_datoselementoseleccionado', 'LaborManagementController@obtenerDatosElemento')->name('agrocefa.labormanagement.obtenerdatos');
        Route::get('/labormanagement/obtener_price', 'LaborManagementController@getprice')->name('agrocefa.labormanagement.getprice');
        Route::get('/labormanagement/getsupplies', 'LaborManagementController@getsupplies')->name('agrocefa.labormanagement.getsupplies');
        Route::get('/labormanagement/searchperson', 'LaborManagementController@searchperson')->name('agrocefa.labormanagement.searchperson');
        Route::get('/labormanagement/getpriceemploye', 'LaborManagementController@getpriceemploye')->name('agrocefa.labormanagement.getpriceemploye');

        // RUTAS PARA REPORTES

        // Consumos
        Route::get('/reports/consumable', 'Reports\ConsumableController@index')->name('agrocefa.reports.consumable');
        Route::get('/reports/consumption/filter', 'Reports\ConsumableController@filterByDate')->name('agrocefa.reports.filterByDate');

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
        Route::put('/species/{id}', 'Parameters\ParameterAgroController@update')->name('agrocefa.species.update');
        Route::delete('/species/delete/{id}', 'Parameters\ParameterAgroController@destroy')->name('agrocefa.species.destroy');
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

