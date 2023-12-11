<?php

use Modules\AGROCEFA\Http\Controllers\AGROCEFAController;
use Modules\AGROCEFA\Http\Controllers\UsuarioController;
use Modules\AGROCEFA\Http\Controllers\LaborManagementController;
use Modules\AGROCEFA\Http\Controllers\LaborController;

Route::middleware(['lang'])->group(function () {
    Route::prefix('agrocefa')->group(function () {
        //Rutas Principales
        Route::get('index', 'AGROCEFAController@index')->name('cefa.agrocefa.index');
        Route::get('home', 'AGROCEFAController@home')->name('cefa.agrocefa.home');
        Route::get('trainer', 'AGROCEFAController@trainer_passant')->name('agrocefa.trainer.index'); // Vista principal del Administrador (Instructor)
        Route::get('passant', 'AGROCEFAController@trainer_passant')->name('agrocefa.passant.index'); // Vista principal del Pasante (Pasante)
        Route::get('trainer/select-unit/{id}', 'AGROCEFAController@selectUnit')->name('agrocefa.trainer.select-unit');
        Route::get('passant/select-unit/{id}', 'AGROCEFAController@selectUnit')->name('agrocefa.passant.select-unit');
        Route::get('bodegas', 'AGROCEFAController@bodega')->name('agrocefa.bodegas');
        Route::get('user', 'AGROCEFAController@vistauser')->name('agrocefa.user');
        Route::get('developers', 'desarrolladoresController@index')->name('cefa.agrocefa.developers.index');
        Route::get('usuario', 'usuarioController@index')->name('cefa.agrocefa.usuario.index');

        // RUTAS DE PARAMETROS
        Route::get('trainer/parameters', 'Parameters\ParameterAgroController@parametersview')->name('agrocefa.trainer.parameters.index');
        Route::get('passant/parameters', 'Parameters\ParameterAgroController@parametersview')->name('agrocefa.passant.parameters.index');

        // Actividad
        Route::get('trainer/parameters/activity/getactivity', 'Parameters\ActivityController@getActivitiesForSelectedUnit')->name('agrocefa.trainer.parameters.activity.getactivity');
        Route::get('passant/parameters/activity/getactivity', 'Parameters\ActivityController@getActivitiesForSelectedUnit')->name('agrocefa.passant.parameters.activity.getactivity');
        Route::post('trainer/parameters/activity/store', 'Parameters\ActivityController@createActivity')->name('agrocefa.trainer.parameters.activity.store');
        Route::post('passant/parameters/activity/store', 'Parameters\ActivityController@createActivity')->name('agrocefa.passant.parameters.activity.store');
        Route::put('trainer/parameters/activity/update/{id}', 'Parameters\ActivityController@editActivity')->name('agrocefa.trainer.parameters.activity.update');
        Route::put('passant/parameters/activity/update/{id}', 'Parameters\ActivityController@editActivity')->name('agrocefa.passant.parameters.activity.update');
        Route::delete('trainer/parameters/activity/destroy/{id}', 'Parameters\ActivityController@deleteActivity')->name('agrocefa.trainer.parameters.activity.destroy');
        Route::delete('passant/parameters/activity/destroy/{id}', 'Parameters\ActivityController@deleteActivity')->name('agrocefa.passant.parameters.activity.destroy');

        // Variedad
        Route::post('trainer/parameters/variety/store', 'Parameters\VarietyController@store')->name('agrocefa.trainer.parameters.variety.store');
        Route::post('passant/parameters/variety/store', 'Parameters\VarietyController@store')->name('agrocefa.passant.parameters.variety.store');
        Route::put('trainer/parameters/variety/update/{id}', 'Parameters\VarietyController@update')->name('agrocefa.trainer.parameters.variety.update');
        Route::put('passant/parameters/variety/update/{id}', 'Parameters\VarietyController@update')->name('agrocefa.passant.parameters.variety.update');
        Route::delete('trainer/parameters/variety/destroy/{id}', 'Parameters\VarietyController@delete')->name('agrocefa.trainer.parameters.variety.destroy');
        Route::delete('passant/parameters/variety/destroy/{id}', 'Parameters\VarietyController@delete')->name('agrocefa.passant.parameters.variety.destroy');

        // Especie
        Route::get('trainer/parameters/specie/getspecie', 'Parameters\ParameterAgroController@listspecie')->name('agrocefa.trainer.parameters.specie.getspecie');
        Route::get('passant/parameters/specie/getspecie', 'Parameters\ParameterAgroController@listspecie')->name('agrocefa.passant.parameters.specie.getspecie');
        Route::post('trainer/parameters/specie/store', 'Parameters\ParameterAgroController@store')->name('agrocefa.trainer.parameters.specie.store');
        Route::post('passant/parameters/specie/store', 'Parameters\ParameterAgroController@store')->name('agrocefa.passant.parameters.specie.store');
        Route::put('trainer/parameters/specie/update/{id}', 'Parameters\ParameterAgroController@update')->name('agrocefa.trainer.parameters.specie.update');
        Route::put('passant/parameters/specie/update/{id}', 'Parameters\ParameterAgroController@update')->name('agrocefa.passant.parameters.specie.update');
        Route::delete('trainer/parameters/specie/destroy/{id}', 'Parameters\ParameterAgroController@destroy')->name('agrocefa.trainer.parameters.specie.destroy');
        Route::delete('passant/parameters/specie/destroy/{id}', 'Parameters\ParameterAgroController@destroy')->name('agrocefa.passant.parameters.specie.destroy');

        // Crop
        Route::post('trainer/parameters/crop/store', 'Parameters\CropController@createCrop')->name('agrocefa.trainer.parameters.crop.store');
        Route::post('passant/parameters/crop/store', 'Parameters\CropController@createCrop')->name('agrocefa.passant.parameters.crop.store');
        Route::put('trainer/parameters/crop/update/{id}', 'Parameters\CropController@editCrop')->name('agrocefa.trainer.parameters.crop.update');
        Route::put('passant/parameters/crop/update/{id}', 'Parameters\CropController@editCrop')->name('agrocefa.passant.parameters.crop.update');
        Route::delete('trainer/parameters/crop/destroy/{id}', 'Parameters\CropController@deleteCrop')->name('agrocefa.trainer.parameters.crop.destroy');
        Route::delete('passant/parameters/crop/destroy/{id}', 'Parameters\CropController@deleteCrop')->name('agrocefa.passant.parameters.crop.destroy');

        //RUTAS DE INVENTARIO
        Route::get('trainer/inventory', 'InventoryController@inventory')->name('agrocefa.trainer.inventory.index');
        Route::get('passant/inventory', 'InventoryController@inventory')->name('agrocefa.passant.inventory.index');
        Route::post('trainer/inventory/showWarehouseFilter', 'InventoryController@showWarehouseFilter')->name('agrocefa.trainer.inventory.showWarehouseFilter');
        Route::post('passant/inventory/showWarehouseFilter', 'InventoryController@showWarehouseFilter')->name('agrocefa.passant.inventory.showWarehouseFilter');
        Route::post('trainer/inventory/store', 'InventoryController@store')->name('agrocefa.trainer.inventory.store');
        Route::post('passant/inventory/store', 'InventoryController@store')->name('agrocefa.passant.inventory.store');
        Route::post('trainer/inventory/category/store', 'InventoryController@addCategory')->name('agrocefa.trainer.inventory.category.store');
        Route::post('passant/inventory/category/store', 'InventoryController@addCategory')->name('agrocefa.passant.inventory.category.store');
        Route::post('trainer/inventory/element/store', 'InventoryController@addElement')->name('agrocefa.trainer.inventory.element.store');
        Route::post('passant/inventory/element/store', 'InventoryController@addElement')->name('agrocefa.passant.inventory.element.store');
        Route::put('trainer/inventory/{id}', 'InventoryController@update')->name('agrocefa.trainer.inventory.update');
        Route::put('passant/inventory/{id}', 'InventoryController@update')->name('agrocefa.passant.inventory.update');
        Route::delete('trainer/inventory/delete/{id}', 'InventoryController@destroy')->name('agrocefa.trainer.inventory.destroy');
        Route::delete('passant/inventory/delete/{id}', 'InventoryController@destroy')->name('agrocefa.passant.inventory.destroy');

        // RUTAS DE MOVIMIENTOS

        Route::get('trainer/movements', 'MovementController@viewmovements')->name('agrocefa.trainer.movements.index');
        Route::get('passant/movements', 'MovementController@viewmovements')->name('agrocefa.passant.movements.index');
        Route::get('trainer/movements/list', 'MovementController@viewmovementslist')->name('agrocefa.trainer.movements.list');
        Route::get('passant/movements/list', 'MovementController@viewmovementslist')->name('agrocefa.passant.movements.list');
        Route::get('trainer/movements/entry', 'MovementController@formentrance')->name('agrocefa.trainer.movements.entry.index');
        Route::get('passant/movements/entry', 'MovementController@formentrance')->name('agrocefa.passant.movements.entry.index');
        Route::get('trainer/movements/exit', 'MovementController@formexit')->name('agrocefa.trainer.movements.exit.index');
        Route::get('passant/movements/exit', 'MovementController@formexit')->name('agrocefa.passant.movements.exit.index');
        Route::get('trainer/movements/request', 'MovementController@requestentrance')->name('agrocefa.trainer.movements.notification');
        Route::post('/movements/request/confirmation/{id}', 'MovementController@confirmation')->name('agrocefa.movements.confirmation');
        Route::post('/movements/request/returnmovement/{id}', 'MovementController@returnMovement')->name('agrocefa.movements.return');
        Route::post('trainer/movements/entry/store', 'MovementController@registerentrance')->name('agrocefa.trainer.movements.entry.store');
        Route::post('passant/movements/entry/store', 'MovementController@registerentrance')->name('agrocefa.passant.movements.entry.store');
        Route::post('trainer/movements/exit/store', 'MovementController@registerexit')->name('agrocefa.trainer.movements.exit.store');
        Route::post('passant/movements/exit/store', 'MovementController@registerexit')->name('agrocefa.passant.movements.exit.store');
        Route::get('trainer/movements/getwarehouse', 'MovementController@obtenerwarehouse')->name('agrocefa.trainer.movements.getwarehouse');
        Route::get('passant/movements/getwarehouse', 'MovementController@obtenerwarehouse')->name('agrocefa.passant.movements.getwarehouse');
        Route::get('trainer/movements/getelement', 'MovementController@obtenerelement')->name('agrocefa.trainer.movements.getelement');
        Route::get('passant/movements/getelement', 'MovementController@obtenerelement')->name('agrocefa.passant.movements.getelement');
        Route::get('trainer/movements/getprice', 'MovementController@getprice')->name('agrocefa.trainer.movements.getprice');
        Route::get('passant/movements/getprice', 'MovementController@getprice')->name('agrocefa.passant.movements.getprice');
        Route::get('trainer/movements/getinformationelement', 'MovementController@obtenerDatosElemento')->name('agrocefa.trainer.movements.getinformationelement');
        Route::get('passant/movements/getinformationelement', 'MovementController@obtenerDatosElemento')->name('agrocefa.passant.movements.getinformationelement');

        // RUTAS DE GESTION DE LABORES
        Route::get('trainer/labormanagement/culturalwork', 'LaborManagementController@culturalwork')->name('agrocefa.trainer.labormanagement.index');
        Route::get('passant/labormanagement/culturalwork', 'LaborManagementController@culturalwork')->name('agrocefa.passant.labormanagement.index');
        Route::get('trainer/labormanagement/getresponsability', 'LaborManagementController@obteneresponsability')->name('agrocefa.trainer.labormanagement.getresponsability');
        Route::get('passant/labormanagement/getresponsability', 'LaborManagementController@obteneresponsability')->name('agrocefa.passant.labormanagement.getresponsability');
        Route::get('trainer/labormanagement/getinformationelement', 'LaborManagementController@obtenerDatosElemento')->name('agrocefa.trainer.labormanagement.getinformationelement');
        Route::get('passant/labormanagement/getinformationelement', 'LaborManagementController@obtenerDatosElemento')->name('agrocefa.passant.labormanagement.getinformationelement');
        Route::get('trainer/labormanagement/getprice', 'LaborManagementController@getprice')->name('agrocefa.trainer.labormanagement.getprice');
        Route::get('passant/labormanagement/getprice', 'LaborManagementController@getprice')->name('agrocefa.passant.labormanagement.getprice');
        Route::get('trainer/labormanagement/getsupplies', 'LaborManagementController@getsupplies')->name('agrocefa.trainer.labormanagement.getsupplies');
        Route::get('passant/labormanagement/getsupplies', 'LaborManagementController@getsupplies')->name('agrocefa.passant.labormanagement.getsupplies');
        Route::get('trainer/labormanagement/searchperson', 'LaborManagementController@searchperson')->name('agrocefa.trainer.labormanagement.searchperson');
        Route::get('passant/labormanagement/searchperson', 'LaborManagementController@searchperson')->name('agrocefa.passant.labormanagement.searchperson');
        Route::get('trainer/labormanagement/getpriceemploye', 'LaborManagementController@getpriceemploye')->name('agrocefa.trainer.labormanagement.getpriceemploye');
        Route::get('passant/labormanagement/getpriceemploye', 'LaborManagementController@getpriceemploye')->name('agrocefa.passant.labormanagement.getpriceemploye');
        Route::get('trainer/labormanagement/getcropinformation', 'LaborManagementController@getcropinformation')->name('agrocefa.trainer.labormanagement.getcropinformation');
        Route::get('passant/labormanagement/getcropinformation', 'LaborManagementController@getcropinformation')->name('agrocefa.passant.labormanagement.getcropinformation');
        Route::post('trainer/labormanagement/registerlabor', 'LaborManagementController@registerlabor')->name('agrocefa.trainer.labormanagement.registerlabor');
        Route::post('passant/labormanagement/store', 'LaborManagementController@registerlabor')->name('agrocefa.trainer.labormanagement.store');
        Route::get('trainer/labormanagement/obtenerAspectosAmbientales/{activity}', 'LaborManagementController@obtenerAspectosAmbientales')->name('agrocefa.trainer.labormanagement.obtenerAspectosAmbientales');
        Route::get('trainer/labormanagement/mostrarAspectosAmbientales', 'LaborManagementController@mostrarAspectosAmbientales')->name('agrocefa.trainer.labormanagement.mostrarAspectosAmbientales');

        Route::get('/labormanagement/culturalwork', 'LaborManagementController@activityproduct')->name('agrocefa.labormanagement.activityType');
        Route::get('/labormanagement/culturalwork/warehouseUnit', 'LaborManagementController@getWarehouses')->name('agrocefa.labormanagement.warehouseUnits');

        // RUTAS DE REPORTES

        // Consumos
        Route::get('trainer/reports/consumable', 'Reports\ConsumableController@index')->name('agrocefa.trainer.reports.consumable.index');
        Route::get('passant/reports/consumable', 'Reports\ConsumableController@index')->name('agrocefa.passant.reports.consumable.index');
        Route::get('trainer/reports/consumable/getCropsBylot', 'Reports\ConsumableController@getCropsBylot')->name('agrocefa.trainer.reports.consumable.getCropsBylot');
        Route::get('passant/reports/consumable/getCropsBylot', 'Reports\ConsumableController@getCropsBylot')->name('agrocefa.passant.reports.consumable.getCropsBylot');
        Route::get('trainer/reports/consumable/resultreport', 'Reports\ConsumableController@filterByDate')->name('agrocefa.trainer.reports.consumable.resultreport');
        Route::get('passant/reports/consumable/resultreport', 'Reports\ConsumableController@filterByDate')->name('agrocefa.passant.reports.consumable.resultreport');

        // Labor
        Route::get('trainer/reports/labor', 'Reports\laborController@index')->name('agrocefa.trainer.reports.labor.index');
        Route::get('passant/reports/labor', 'Reports\laborController@index')->name('agrocefa.passant.reports.labor.index');
        Route::post('/reports/labor/filter', 'Reports\LaborController@filterlabor')->name('agrocefa.reports.filterlabor');
        Route::get('trainer/reports/labor/laborDetails', 'Reports\LaborController@getLaborDetails')->name('agrocefa.reports.laborDetails');
        Route::get('passant/reports/labor/laborDetails', 'Reports\LaborController@getLaborDetails')->name('agrocefa.reports.laborDetails');
        Route::get('/reports/labor/laborpdf', 'Reports\LaborController@laborpdf')->name('agrocefa.reports.laborpdf');

        //produccion
        Route::get('trainer/reports/production', 'Reports\ProductionController@index')->name('agrocefa.trainer.reports.production.index');
        Route::get('passant/reports/production', 'Reports\ProductionController@index')->name('agrocefa.passant.reports.production.index');
        Route::get('/reports/cropsbylot', 'Reports\ProductionController@getCropsByLot')->name('agrocefa.reports.cropsbylot');
        Route::post('/reports/production/filter', 'Reports\ProductionController@filterProduction')->name('agrocefa.reports.filterproduction');
        Route::get('/reports/production/resultproduction', 'Reports\ProductionController@resultProduction')->name('agrocefa.reports.resultproduction');
        Route::get('/reports/productionpdf', 'Reports\ProductionController@productionPdf')->name('agrocefa.reports.productionpdf');

        //Balance
        Route::get('trainer/reports/balance', 'Reports\BalanceController@index')->name('agrocefa.trainer.reports.balance.index');
        Route::get('passant/reports/balance', 'Reports\BalanceController@index')->name('agrocefa.passant.reports.balance.index');
        Route::post('/reports/balance/filter', 'Reports\BalanceController@filterbalance')->name('agrocefa.reports.filterbalance');
        Route::get('/reports/balance/balancepdf', 'Reports\BalanceController@balancepdf')->name('agrocefa.reports.balancepdf');
    });
});
