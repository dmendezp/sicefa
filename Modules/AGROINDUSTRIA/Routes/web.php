<?php

//instructor
use Modules\AGROINDUSTRIA\Http\Controllers\Instructor\FormulationController;
use Modules\AGROINDUSTRIA\Http\Controllers\instructor\UnitController;
use Modules\AGROINDUSTRIA\Http\Controllers\instructor\LaborController;
use Modules\AGROINDUSTRIA\Http\Controllers\instructor\ActivityController;
use Modules\AGROINDUSTRIA\Http\Controllers\intern\RequestController;
use Modules\AGROINDUSTRIA\Http\Controllers\instructor\InputRequestController;
use Modules\AGROINDUSTRIA\Http\Controllers\instructor\ProductionController;
use Modules\AGROINDUSTRIA\Http\Controllers\instructor\DeliverController;
use Modules\AGROINDUSTRIA\Http\Controllers\Unit\BakeryController;
use Modules\AGROINDUSTRIA\Http\Controllers\Unit\ChocolateriaController;
use Modules\AGROINDUSTRIA\Http\Controllers\Intern\WarehouseController;
use Modules\AGROINDUSTRIA\Http\Controllers\Intern\InventoryController;
use Modules\AGROINDUSTRIA\Http\Controllers\ExcelController;

Route::middleware(['lang'])->group(function(){

    Route::prefix('agroindustria')->group(function() {
        Route::get('/index', 'AGROINDUSTRIAController@index')->name('cefa.agroindustria.home.index');
        Route::get('/developments', 'AGROINDUSTRIAController@developments')->name('cefa.agroindustria.home.developments');
        Route::get('/cedula/{coordinatorId}', [RequestController::class, 'document_coordinator'])->name('cefa.agroindustria.cedula');
        Route::get('/formulation/recipes', 'AGROINDUSTRIAController@recipes')->name('cefa.agroindustria.home.formulations.recipes');
        Route::get('/manual', 'AGROINDUSTRIAController@manual')->name('cefa.agroindustria.home.manual');

        //admin
        Route::prefix('admin')->group(function (){
            Route::get('/units', 'AGROINDUSTRIAController@unidd')->name('agroindustria.admin.units');   
            
            //Bajas
            Route::get('/discharge', [WarehouseController::class, 'discharge'])->name('cefa.agroindustria.admin.units.remove');
            Route::post('/discharge/create', [WarehouseController::class, 'createDischarge'])->name('cefa.agroindustria.admin.discharge.create');
            Route::get('/discharge/warehouse/{id}', [WarehouseController::class, 'warehouse'])->name('cefa.agroindustria.admin.discharge.warehouse');
            Route::get('/discharge/element/{productiveUnitId}/{warehouseId}', [WarehouseController::class, 'element'])->name('cefa.agroindustria.admin.discharge.element');
           
           //Labor
            Route::get('/discharge/elementData/{productiveUnitId}/{warehouseId}/{elementId}', [WarehouseController::class, 'dataElement'])->name('cefa.agroindustria.admin.discharge.elementData');
            Route::get('/labor', [LaborController::class, 'index'])->name('agroindustria.admin.units.labor');
            Route::get('/labor/form', [LaborController::class, 'form'])->name('agroindustria.admin.labor.units.form');
            Route::get('/labor/{activityId}', [LaborController::class, 'responsibilites'])->name('agroindustria.admin.labor.responsibilities');
            Route::get('/labor/type/{type}', [LaborController::class, 'activity_type'])->name('agroindustria.admin.labor.type');
            Route::get('/labor/price/{id}', [LaborController::class, 'price_employement'])->name('agroindustria.admin.labor.price');
            Route::get('/labor/tools/price/{id}', [LaborController::class, 'price_tools'])->name('agroindustria.admin.labor.tools.price');
            Route::get('/labor/consumables/{id}', [LaborController::class, 'consumables'])->name('agroindustria.admin.labor.consumables');
            Route::get('/labor/equipments/price/{id}', [LaborController::class, 'price_equipments'])->name('agroindustria.admin.labor.equipments.price');
            Route::get('/labor/consumables/amount/{consumables}', [LaborController::class, 'amount'])->name('agroindustria.admin.labor.consumables.amount');
            Route::get('/labor/equipments/amounteq/{equipments}', [LaborController::class, 'amounteq'])->name('agroindustria.admin.labor.equipments.amounteq');
            Route::get('/labor/elements/{name}', [LaborController::class, 'search_element'])->name('agroindustria.admin.labor.elements');
            Route::get('/labor/executors/{document_number}', [LaborController::class, 'executors'])->name('agroindustria.admin.labor.executors');
            Route::get('/labor/resource/{activity_id}', [LaborController::class, 'environmental_aspect'])->name('agroindustria.admin.labor.resource');
            Route::post('/labor/register', [LaborController::class, 'register_labor'])->name('agroindustria.admin.labor.register');
            Route::post('/labor/cancelar/{id}', [LaborController::class, 'cancelLabor'])->name('agroindustria.admin.labor.cancelar');
            Route::post('/labor/realizar/{id}', [LaborController::class, 'approbedLabor'])->name('agroindustria.admin.labor.realizar');
            Route::put('/labor/realizar/movement/{id}', [LaborController::class, 'movement'])->name('agroindustria.admin.labor.realizar.movement');
            Route::get('/activity/{unit}', [ActivityController::class, 'activity'])->name('agroindustria.admin.units.activity');
            
            //Producción
            Route::get('/production', [ProductionController::class, 'index'])->name('agroindustria.admin.units.production');

            //Movimientos
            Route::get('/movements', [DeliverController::class, 'deliveries'])->name('agroindustria.admin.units.movements');
            Route::get('/movements/pending', [DeliverController::class, 'pending'])->name('cefa.agroindustria.units.instructor.movements.pending');
            Route::put('/movements/pending/{id}', [DeliverController::class, 'stateMovement'])->name('cefa.agroindustria.units.instructor.movements.pending.state');
            Route::put('/movements/cancelled/{id}', [DeliverController::class, 'anularMovimiento'])->name('cefa.agroindustria.units.instructor.movements.cancelled');
            Route::put('/movements/return/{id}', [DeliverController::class, 'devolverMovimiento'])->name('cefa.agroindustria.units.instructor.movements.return');
            Route::get('/movements/{id}', [DeliverController::class, 'priceInventory'])->name('cefa.agroindustria.units.instructor.movements.id');
            Route::get('/movements/warehouse/{id}', [DeliverController::class, 'warehouseReceive'])->name('cefa.agroindustria.units.instructor.movements.warehouse');
            Route::post('/movements/out', [DeliverController::class, 'createMoveOut'])->name('cefa.agroindustria.units.instructor.movements.out');
        });
   
        //unidades productivas
        Route::prefix('units')->group(function (){
            Route::get('/chocolateria/{unit}', [ChocolateriaController::class, 'chocolateria'])->name('cefa.agroindustria.units.chocolateria');
            Route::get('/bakery/{unit}', [BakeryController::class, 'bakery'])->name('cefa.agroindustria.units.bakery');
        });

        //instructor
        Route::prefix('instructor')->group(function (){
            Route::get('/units', 'AGROINDUSTRIAController@unidd')->name('agroindustria.instructor.units');

            //Solicitudes
            Route::get('/requests', [InputRequestController::class, 'table'])->name('cefa.agroindustria.units.instructor.requests');
            Route::get('/solicitud', [InputRequestController::class, 'form'])->name('cefa.agroindustria.units.instructor.solicitud');
            Route::get('/amount/{id}', [InputRequestController::class, 'amount'])->name('cefa.agroindustria.units.instructor.amount');
            Route::post('/enviarsolicitud', [InputRequestController::class, 'create'])->name('cefa.agroindustria.units.instructor.enviarsolicitud');
            Route::put('/request/pending/{id}', [InputRequestController::class, 'stateMovement'])->name('cefa.agroindustria.units.instructor.request.pending.state');
            Route::get('/agroindustria/generar-excel-request/{movementId}', [InputRequestController::class, 'generateExcel'])->name('cefa.agroindustria.units.instructor.request.excel');
            Route::get('/request/element/{name}', [InputRequestController::class, 'element'])->name('cefa.agroindustria.units.instructor.element.name');

            //Labor
            Route::get('/labor', [LaborController::class, 'index'])->name('agroindustria.instructor.units.labor');
            Route::get('/labor/form', [LaborController::class, 'form'])->name('agroindustria.instructor.labor.units.form');
            Route::get('/labor/{activityId}', [LaborController::class, 'responsibilites'])->name('cefa.agroindustria.instructor.labor.responsibilities');
            Route::get('/labor/type/{type}', [LaborController::class, 'activity_type'])->name('cefa.agroindustria.units.instructor.labor.type');
            Route::get('/labor/price/{id}', [LaborController::class, 'price_employement'])->name('cefa.agroindustria.units.instructor.labor.price');
            Route::get('/labor/tools/price/{id}', [LaborController::class, 'price_tools'])->name('cefa.agroindustria.units.instructor.labor.tools.price');
            Route::get('/labor/consumables/{id}', [LaborController::class, 'consumables'])->name('cefa.agroindustria.units.instructor.labor.consumables');
            Route::get('/labor/equipments/price/{id}', [LaborController::class, 'price_equipments'])->name('cefa.agroindustria.units.instructor.labor.equipments.price');
            Route::get('/labor/consumables/amount/{consumables}', [LaborController::class, 'amount'])->name('cefa.agroindustria.units.instructor.labor.consumables.amount');
            Route::get('/labor/equipments/amounteq/{equipments}', [LaborController::class, 'amounteq'])->name('cefa.agroindustria.units.instructor.labor.equipments.amounteq');
            Route::get('/labor/elements/{name}', [LaborController::class, 'search_element'])->name('cefa.agroindustria.units.instructor.labor.elements');
            Route::get('/labor/executors/{document_number}', [LaborController::class, 'executors'])->name('cefa.agroindustria.units.instructor.labor.executors');
            Route::get('/labor/resource/{activity_id}', [LaborController::class, 'environmental_aspect'])->name('cefa.agroindustria.units.instructor.labor.resource');
            Route::post('/labor/register', [LaborController::class, 'register_labor'])->name('cefa.agroindustria.units.instructor.labor.register');
            Route::post('/labor/cancelar/{id}', [LaborController::class, 'cancelLabor'])->name('cefa.agroindustria.units.instructor.labor.cancelar');
            Route::post('/labor/realizar/{id}', [LaborController::class, 'approbedLabor'])->name('cefa.agroindustria.units.instructor.labor.realizar');
            Route::put('/labor/realizar/movement/{id}', [LaborController::class, 'movement'])->name('cefa.agroindustria.units.instructor.labor.realizar.movement');
            Route::get('/activity/{unit}', [ActivityController::class, 'activity'])->name('agroindustria.instructor.units.activity');
            Route::get('/agroindustria/generar-excel-consumables/{laborId}', [ExcelController::class, 'generateExcel'])->name('cefa.agroindustria.units.instructor.labor.excel');

            //Producción
            Route::get('/production', [ProductionController::class, 'index'])->name('cefa.agroindustria.units.instructor.production');

            //Movimientos
            Route::get('/movements', [DeliverController::class, 'deliveries'])->name('agroindustria.instructor.units.movements');
            Route::get('/movements/pending', [DeliverController::class, 'pending'])->name('cefa.agroindustria.units.instructor.movements.pending');
            Route::put('/movements/pending/{id}', [DeliverController::class, 'stateMovement'])->name('cefa.agroindustria.units.instructor.movements.pending.state');
            Route::put('/movements/cancelled/{id}', [DeliverController::class, 'anularMovimiento'])->name('cefa.agroindustria.units.instructor.movements.cancelled');
            Route::put('/movements/return/{id}', [DeliverController::class, 'devolverMovimiento'])->name('cefa.agroindustria.units.instructor.movements.return');
            Route::get('/movements/{id}', [DeliverController::class, 'priceInventory'])->name('cefa.agroindustria.units.instructor.movements.id');
            Route::get('/movements/warehouse/{id}', [DeliverController::class, 'warehouseReceive'])->name('cefa.agroindustria.units.instructor.movements.warehouse');
            Route::post('/movements/out', [DeliverController::class, 'createMoveOut'])->name('cefa.agroindustria.units.instructor.movements.out');

            //Formulacion
            Route::get('/formulation/unit', [FormulationController::class, 'index'])->name('cefa.agroindustria.units.instructor.formulations');
            Route::get('/formulation/details', [FormulationController::class, 'details'])->name('cefa.agroindustria.units.instructor.formulations.details');
            Route::get('/formulation/form', [FormulationController::class, 'form'])->name('cefa.agroindustria.units.instructor.formulario');
            Route::get('/formulation/form/{id}', [FormulationController::class, 'edit'])->name('cefa.agroindustria.units.instructor.form.edit');
            Route::post('/formulation/create', [FormulationController::class, 'create'])->name('cefa.agroindustria.units.instructor.formulations.create');
            Route::post('/formulation/edit', [FormulationController::class, 'update'])->name('cefa.agroindustria.units.instructor.formulations.update');
            Route::delete('/formulation/delete/{id}', [FormulationController::class, 'destroy'])->name('cefa.agroindustria.units.instructor.formulations.delete');
        });

        //storer
        Route::prefix('storer')->group(function (){
            Route::get('/units', 'AGROINDUSTRIAController@unidd')->name('cefa.agroindustria.storer.units'); 
            Route::post('/create', [WarehouseController::class ,'create'])->name('cefa.agroindustria.storer.create'); 
            Route::post('/edit', [WarehouseController::class ,'show'])->name('cefa.agroindustria.storer.show'); 
            Route::get('/inventory/{id}', [WarehouseController::class ,'inventory'])->name('cefa.agroindustria.storer.units.inventory');
            Route::get('/getInventoryByCategory', [WarehouseController::class ,'getInventoryByCategory'])->name('cefa.inventory.category');
            Route::get('/update/{id}', [WarehouseController::class ,'edit'])->name('cefa.agroindustria.storer.update'); 
            Route::get('/list', [WarehouseController::class ,'inventoryAlert'])->name('cefa.agroindustria.storer.inventory.list');   
            Route::get('/request', [RequestController::class, 'index'])->name('cefa.agroindustria.storer.units.view.request');
            Route::get('/inventoryA', [WarehouseController::class ,'inventoryAlert'])->name('cefa.agroindutria.storer.inventoryAlert'); 

        });       
    });
});
