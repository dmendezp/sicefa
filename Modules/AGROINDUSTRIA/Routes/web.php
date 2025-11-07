<?php

//instructor
use Modules\AGROINDUSTRIA\Http\Controllers\Instructor\FormulationController;
use Modules\AGROINDUSTRIA\Http\Controllers\Instructor\UnitController;
use Modules\AGROINDUSTRIA\Http\Controllers\Instructor\LaborController;
use Modules\AGROINDUSTRIA\Http\Controllers\Instructor\ActivityController;
use Modules\AGROINDUSTRIA\Http\Controllers\intern\RequestController;
use Modules\AGROINDUSTRIA\Http\Controllers\Instructor\InputRequestController;
use Modules\AGROINDUSTRIA\Http\Controllers\Instructor\ProductionController;
use Modules\AGROINDUSTRIA\Http\Controllers\Instructor\DeliverController;
use Modules\AGROINDUSTRIA\Http\Controllers\Unit\BakeryController;
use Modules\AGROINDUSTRIA\Http\Controllers\Unit\ChocolateriaController;
use Modules\AGROINDUSTRIA\Http\Controllers\intern\WarehouseController;
use Modules\AGROINDUSTRIA\Http\Controllers\intern\InventoryController;
use Modules\AGROINDUSTRIA\Http\Controllers\ExcelController;

Route::middleware(['lang'])->group(function(){

    Route::prefix('agroindustria')->group(function() {
        Route::get('/index', 'AGROINDUSTRIAController@index')->name('cefa.agroindustria.home.index');
        Route::get('/developments', 'AGROINDUSTRIAController@developments')->name('cefa.agroindustria.home.developments');
        Route::get('/formulation/recipes', 'AGROINDUSTRIAController@recipes')->name('cefa.agroindustria.home.formulations.recipes');
        Route::get('/manual', 'AGROINDUSTRIAController@manual')->name('cefa.agroindustria.home.manual');

        //admin
        Route::prefix('admin')->group(function (){
            Route::get('/units', 'AGROINDUSTRIAController@unidd')->name('agroindustria.admin.units');   
            
            //Bajas
            Route::get('/discharge', [WarehouseController::class, 'discharge'])->name('agroindustria.admin.units.remove.view');
            Route::post('/discharge/create', [WarehouseController::class, 'createDischarge'])->name('agroindustria.admin.units.remove.create');
           
            //Solicitudes
            Route::get('/requests', [InputRequestController::class, 'table'])->name('agroindustria.admin.units.view.request');
            Route::put('/request/pending/{id}', [InputRequestController::class, 'stateMovement'])->name('agroindustria.admin.units.request.pending.state');
            Route::get('/agroindustria/generar-excel-request/{movementId}', [InputRequestController::class, 'generateExcel'])->name('agroindustria.admin.units.request.excel');
            Route::get('/agroindustria/generar-excel-request-unified', [InputRequestController::class, 'generateExcelUnified'])->name('agroindustria.admin.units.request.excel.unified');
            Route::put('/request/pending/cancelled/{id}', [InputRequestController::class, 'cancelRequest'])->name('agroindustria.admin.units.request.pending.cancelled');

           //Labor
            Route::get('/labor', [LaborController::class, 'index'])->name('agroindustria.admin.units.labor');
            Route::get('/labor/form', [LaborController::class, 'form'])->name('agroindustria.admin.units.labor.form');
            Route::get('/labor/form/element', [LaborController::class, 'searchProduct'])->name('agroindustria.admin.units.labor.form.elements');
            Route::get('/labor/edit/{id}', [LaborController::class, 'editLabor'])->name('agroindustria.admin.units.labor.edit');
            Route::get('/labor/{activityId}', [LaborController::class, 'responsibilites'])->name('agroindustria.admin.units.labor.responsibilities');
            Route::get('/labor/type/{type}', [LaborController::class, 'activity_type'])->name('agroindustria.admin.units.labor.type');
            Route::get('/labor/price/{id}', [LaborController::class, 'price_employement'])->name('agroindustria.admin.units.labor.price');
            Route::get('/labor/tools/price/{id}', [LaborController::class, 'price_tools'])->name('agroindustria.admin.units.labor.tools.price');
            Route::get('/labor/consumables/{id}', [LaborController::class, 'consumables'])->name('agroindustria.admin.units.labor.consumables');
            Route::get('/labor/consumables/amount/{consumables}', [LaborController::class, 'amount'])->name('agroindustria.admin.units.labor.consumables.amount');
            Route::get('/labor/equipments/amounteq/{equipments}', [LaborController::class, 'amounteq'])->name('agroindustria.admin.units.labor.equipments.amounteq');
            Route::get('/labor/elements/{name}', [LaborController::class, 'search_element'])->name('agroindustria.admin.units.labor.elements');
            Route::get('/labor/executors/{document_number}', [LaborController::class, 'executors'])->name('agroindustria.admin.units.labor.executors');
            Route::get('/labor/resource/{activity_id}', [LaborController::class, 'environmental_aspect'])->name('agroindustria.admin.units.labor.resource');
            Route::post('/labor/register', [LaborController::class, 'register_labor'])->name('agroindustria.admin.units.labor.register');
            Route::post('/labor/update', [LaborController::class, 'update_labor'])->name('agroindustria.admin.units.labor.update');
            Route::post('/labor/cancelar/{id}', [LaborController::class, 'cancelLabor'])->name('agroindustria.admin.units.labor.cancel');
            Route::post('/labor/realizar/{id}', [LaborController::class, 'approbedLabor'])->name('agroindustria.admin.units.labor.do');
            Route::put('/labor/realizar/movement/{id}', [LaborController::class, 'movement'])->name('agroindustria.admin.units.labor.do.movement');
            Route::get('/activity/{unit}', [ActivityController::class, 'activity'])->name('agroindustria.admin.units.activity');
            Route::get('/agroindustria/generar-excel-consumables/{laborId}', [ExcelController::class, 'generateExcel'])->name('agroindustria.admin.units.labor.excel');

            //Producción
            Route::get('/production', [ProductionController::class, 'index'])->name('agroindustria.admin.units.production');

            //Movimientos
            Route::get('/movements/table', [DeliverController::class, 'table'])->name('agroindustria.admin.units.movements.table');
            Route::get('/movements/form', [DeliverController::class, 'deliveries'])->name('agroindustria.admin.units.movements.form');
            Route::get('/movements/pending', [DeliverController::class, 'pending'])->name('agroindustria.admin.units.movements.pending');
            Route::put('/movements/pending/{id}', [DeliverController::class, 'stateMovement'])->name('agroindustria.admin.units.movements.pending.state');
            Route::put('/movements/cancelled/{id}', [DeliverController::class, 'anularMovimiento'])->name('agroindustria.admin.units.movements.cancelled');
            Route::put('/movements/return/{id}', [DeliverController::class, 'devolverMovimiento'])->name('agroindustria.admin.units.movements.return');
            Route::get('/movements/{id}', [DeliverController::class, 'priceInventory'])->name('agroindustria.admin.units.movements.id');
            Route::get('/movements/warehouse/{id}', [DeliverController::class, 'warehouseReceive'])->name('agroindustria.admin.units.movements.warehouse');
            Route::post('/movements/out', [DeliverController::class, 'createMoveOut'])->name('agroindustria.admin.units.movements.out');
        
            Route::get('/inventory/{id}', [WarehouseController::class ,'inventory'])->name('agroindustria.admin.units.inventory');
            Route::get('/inventory/elements/{warehouseId}', [WarehouseController::class ,'elements'])->name('agroindustria.admin.units.inventory.elements');
            Route::get('/inventoryA/{waId}', [WarehouseController::class ,'inventoryAlert'])->name('agroindustria.admin.units.inventory.spent'); 
            Route::get('/Inventoryexp/{wId}', [WarehouseController::class ,'expirationdate'])->name('agroindustria.admin.units.inventory.expire'); 

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
            Route::get('/requests', [InputRequestController::class, 'table'])->name('agroindustria.instructor.units.view.request');
            Route::get('/solicitud', [InputRequestController::class, 'form'])->name('agroindustria.instructor.units.request.form');
            Route::post('/enviarsolicitud', [InputRequestController::class, 'create'])->name('agroindustria.instructor.units.request.create');
            Route::get('/agroindustria/generar-excel-request/{movementId}', [InputRequestController::class, 'generateExcel'])->name('agroindustria.instructor.units.request.excel');
            Route::get('/request/element', [InputRequestController::class, 'searchProduct'])->name('agroindustria.instructor.units.element.name');
            Route::put('/request/pending/cancelled/{id}', [InputRequestController::class, 'cancelRequest'])->name('agroindustria.instructor.units.request.pending.cancelled');


            //Labor
            Route::get('/labor', [LaborController::class, 'index'])->name('agroindustria.instructor.units.labor');
            Route::get('/labor/form', [LaborController::class, 'form'])->name('agroindustria.instructor.units.labor.form');
            Route::get('/labor/form/element', [LaborController::class, 'searchProduct'])->name('agroindustria.instructor.units.labor.form.elements');
            Route::get('/labor/edit/{id}', [LaborController::class, 'editLabor'])->name('agroindustria.instructor.units.labor.edit');
            Route::get('/labor/{activityId}', [LaborController::class, 'responsibilites'])->name('agroindustria.instructor.units.labor.responsibilities');
            Route::get('/labor/type/{type}', [LaborController::class, 'activity_type'])->name('agroindustria.instructor.units.labor.type');
            Route::get('/labor/price/{id}', [LaborController::class, 'price_employement'])->name('agroindustria.instructor.units.labor.price');
            Route::get('/labor/tools/price/{id}', [LaborController::class, 'price_tools'])->name('agroindustria.instructor.units.labor.tools.price');
            Route::get('/labor/consumables/{id}', [LaborController::class, 'consumables'])->name('agroindustria.instructor.units.labor.consumables');
            Route::get('/labor/consumables/amount/{consumables}', [LaborController::class, 'amount'])->name('agroindustria.instructor.units.labor.consumables.amount');
            Route::get('/labor/equipments/amounteq/{equipments}', [LaborController::class, 'amounteq'])->name('agroindustria.instructor.units.labor.equipments.amounteq');
            Route::get('/labor/elements/{name}', [LaborController::class, 'search_element'])->name('agroindustria.instructor.units.labor.elements');
            Route::get('/labor/executors/{document_number}', [LaborController::class, 'executors'])->name('agroindustria.instructor.units.labor.executors');
            Route::get('/labor/resource/{activity_id}', [LaborController::class, 'environmental_aspect'])->name('agroindustria.instructor.units.labor.resource');
            Route::post('/labor/register', [LaborController::class, 'register_labor'])->name('agroindustria.instructor.units.labor.register');
            Route::post('/labor/update', [LaborController::class, 'update_labor'])->name('agroindustria.instructor.units.labor.update');
            Route::post('/labor/cancelar/{id}', [LaborController::class, 'cancelLabor'])->name('agroindustria.instructor.units.labor.cancel');
            Route::post('/labor/realizar/{id}', [LaborController::class, 'approbedLabor'])->name('agroindustria.instructor.units.labor.do');
            Route::put('/labor/realizar/movement/{id}', [LaborController::class, 'movement'])->name('agroindustria.instructor.units.labor.do.movement');
            Route::get('/activity/{unit}', [ActivityController::class, 'activity'])->name('agroindustria.instructor.units.activity');
            Route::get('/agroindustria/generar-excel-consumables/{laborId}', [ExcelController::class, 'generateExcel'])->name('agroindustria.instructor.units.labor.excel');

            //Producción
            Route::get('/production', [ProductionController::class, 'index'])->name('agroindustria.instructor.units.production');

            //Movimientos
            Route::get('/movements/table', [DeliverController::class, 'table'])->name('agroindustria.instructor.units.movements.table');
            Route::get('/movements/form', [DeliverController::class, 'deliveries'])->name('agroindustria.instructor.units.movements.form');
            Route::get('/movements/pending', [DeliverController::class, 'pending'])->name('agroindustria.instructor.units.movements.pending');
            Route::put('/movements/pending/{id}', [DeliverController::class, 'stateMovement'])->name('agroindustria.instructor.units.movements.pending.state');
            Route::put('/movements/cancelled/{id}', [DeliverController::class, 'anularMovimiento'])->name('agroindustria.instructor.units.movements.cancelled');
            Route::put('/movements/return/{id}', [DeliverController::class, 'devolverMovimiento'])->name('agroindustria.instructor.units.movements.return');
            Route::get('/movements/{id}', [DeliverController::class, 'priceInventory'])->name('agroindustria.instructor.units.movements.id');
            Route::get('/movements/warehouse/{id}', [DeliverController::class, 'warehouseReceive'])->name('agroindustria.instructor.units.movements.warehouse');
            Route::post('/movements/out', [DeliverController::class, 'createMoveOut'])->name('agroindustria.instructor.units.movements.out');

            //Formulacion
            Route::get('/formulation/unit', [FormulationController::class, 'index'])->name('agroindustria.instructor.units.formulations');
            Route::get('/formulation/unit/element', [FormulationController::class, 'searchElement'])->name('agroindustria.instructor.units.formulations.elements');
            Route::get('/formulation/details/{id}', [FormulationController::class, 'details'])->name('agroindustria.instructor.units.formulations.details');
            Route::get('/formulation/form', [FormulationController::class, 'form'])->name('agroindustria.instructor.units.formulario');
            Route::get('/formulation/form/{id}', [FormulationController::class, 'edit'])->name('agroindustria.instructor.units.form.edit');
            Route::post('/formulation/create', [FormulationController::class, 'create'])->name('agroindustria.instructor.units.formulations.create');
            Route::post('/formulation/edit', [FormulationController::class, 'update'])->name('agroindustria.instructor.units.formulations.update');
            Route::delete('/formulation/delete/{id}', [FormulationController::class, 'destroy'])->name('agroindustria.instructor.units.formulations.delete');
            
            //Inventario
            Route::get('/inventory/{id}', [WarehouseController::class ,'inventory'])->name('agroindustria.instructor.units.inventory');
            Route::get('/inventory/elements/{warehouseId}', [WarehouseController::class ,'elements'])->name('agroindustria.instructor.units.inventory.elements');
            Route::get('/inventoryA/{waId}', [WarehouseController::class ,'inventoryAlert'])->name('agroindustria.instructor.units.inventory.spent'); 
            Route::get('/Inventoryexp/{wId}', [WarehouseController::class ,'expirationdate'])->name('agroindustria.instructor.units.inventory.expire'); 
        });

        //storer
        Route::prefix('storer')->group(function (){
            Route::get('/units', 'AGROINDUSTRIAController@unidd')->name('agroindustria.storer.units'); 
            Route::get('/inventory/{id}', [WarehouseController::class ,'inventory'])->name('agroindustria.storer.units.inventory');
            Route::get('/request', [RequestController::class, 'index'])->name('agroindustria.storer.units.view.request');
            Route::get('/inventory/elements/{warehouseId}', [WarehouseController::class ,'elements'])->name('agroindustria.storer.units.inventory.elements');
            Route::get('/inventoryA/{waId}', [WarehouseController::class ,'inventoryAlert'])->name('agroindustria.storer.units.inventory.spent'); 
            Route::get('/Inventoryexp/{wId}', [WarehouseController::class ,'expirationdate'])->name('agroindustria.storer.units.inventory.expire'); 

            Route::put('/request/approve/{id}', [LaborController::class, 'approve'])->name('agroindustria.storer.units.request.approve');
            Route::put('/request/cancelled/{id}', [LaborController::class, 'rechazarSolicitud'])->name('agroindustria.storer.units.request.cancelled');
        });       
    });
});
