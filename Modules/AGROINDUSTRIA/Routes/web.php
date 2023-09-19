<?php

//instructor
use Modules\AGROINDUSTRIA\Http\Controllers\Instructor\FormulationController;
use Modules\AGROINDUSTRIA\Http\Controllers\instructor\UnitController;
use Modules\AGROINDUSTRIA\Http\Controllers\instructor\LaborController;
use Modules\AGROINDUSTRIA\Http\Controllers\instructor\ActivityController;
use Modules\AGROINDUSTRIA\Http\Controllers\instructor\RequestController;
use Modules\AGROINDUSTRIA\Http\Controllers\instructor\DeliverController;
use Modules\AGROINDUSTRIA\Http\Controllers\Unit\BakeryController;
use Modules\AGROINDUSTRIA\Http\Controllers\Unit\ChocolateriaController;
use Modules\AGROINDUSTRIA\Http\Controllers\Intern\WarehouseController;
use Modules\AGROINDUSTRIA\Http\Controllers\Intern\InventoryController;



Route::middleware(['lang'])->group(function(){

    Route::prefix('agroindustria')->group(function() {
        Route::get('/index', 'AGROINDUSTRIAController@index')->name('cefa.agroindustria.home.index');
        Route::get('/cedula/{coordinatorId}', [RequestController::class, 'document_coordinator'])->name('cefa.agroindustria.cedula');
        Route::get('/formulation/recipes', 'AGROINDUSTRIAController@recipes')->name('cefa.agroindustria.home.formulations.recipes');
        
        //admin
        Route::prefix('admin')->group(function (){
            Route::get('/dashboard', 'AGROINDUSTRIAController@dashboard')->name('cefa.agroindustria.admin.dashboard');
            Route::get('/discharge', [WarehouseController::class, 'discharge'])->name('cefa.agroindustria.admin.discharge');
            Route::post('/discharge/create', [WarehouseController::class, 'createDischarge'])->name('cefa.agroindustria.admin.discharge.create');
            Route::get('/discharge/warehouse/{id}', [WarehouseController::class, 'warehouse'])->name('cefa.agroindustria.admin.discharge.warehouse');
            Route::get('/discharge/element/{id}', [WarehouseController::class, 'element'])->name('cefa.agroindustria.admin.discharge.element');
            Route::get('/discharge/elementData/{id}', [WarehouseController::class, 'dataElement'])->name('cefa.agroindustria.admin.discharge.elementData');
        });
   
        //unidades productivas
        Route::prefix('units')->group(function (){
            Route::get('/chocolateria/{unit}', [ChocolateriaController::class, 'chocolateria'])->name('cefa.agroindustria.units.chocolateria');
            Route::get('/bakery/{unit}', [BakeryController::class, 'bakery'])->name('cefa.agroindustria.units.bakery');
        });

        //instructor
        Route::prefix('instructor')->group(function (){
            Route::get('/unidd', [UnitController::class, 'unidd'])->name('cefa.agroindustria.instructor.unidd');
            //Solicitudes
            Route::get('/solicitud', [RequestController::class, 'solicitud'])->name('cefa.agroindustria.units.instructor.solicitud');
            Route::get('/amount/{id}', [RequestController::class, 'amount'])->name('cefa.agroindustria.units.instructor.amount');
            Route::post('/enviarsolicitud', [RequestController::class, 'create'])->name('cefa.agroindustria.units.instructor.enviarsolicitud');

            Route::get('/labor', [LaborController::class, 'labor'])->name('cefa.agroindustria.units.instructor.labor');
            Route::get('/activity', [ActivityController::class, 'activity'])->name('cefa.agroindustria.units.instructor.activity');
            //Movimientos
            Route::get('/movements', [DeliverController::class, 'deliveries'])->name('cefa.agroindustria.units.instructor.movements');
            Route::get('/movements/pending', [DeliverController::class, 'pending'])->name('cefa.agroindustria.units.instructor.movements.pending');
            Route::put('/movements/pending/{id}', [DeliverController::class, 'stateMovement'])->name('cefa.agroindustria.units.instructor.movements.pending.state');
            Route::put('/movements/cancelled/{id}', [DeliverController::class, 'anularMovimiento'])->name('cefa.agroindustria.units.instructor.movements.cancelled');
            Route::put('/movements/return/{id}', [DeliverController::class, 'devolverMovimiento'])->name('cefa.agroindustria.units.instructor.movements.return');
            Route::get('/movements/{id}', [DeliverController::class, 'priceInventory'])->name('cefa.agroindustria.units.instructor.movements.id');
            Route::get('/movements/warehouse/{id}', [DeliverController::class, 'warehouseReceive'])->name('cefa.agroindustria.units.instructor.movements.warehouse');
            Route::post('/movements/out', [DeliverController::class, 'createMoveOut'])->name('cefa.agroindustria.units.instructor.movements.out');

           
            Route::get('/units', 'AGROINDUSTRIAController@unidd')->name('cefa.agroindustria.instructor.units');

            //Formulacion
            Route::get('/formulation', [FormulationController::class, 'index'])->name('cefa.agroindustria.units.instructor.formulations');
            Route::get('/formulation/form', [FormulationController::class, 'form'])->name('cefa.agroindustria.units.instructor.formulario');
            Route::get('/formulation/form/{id}', [FormulationController::class, 'edit'])->name('cefa.agroindustria.units.instructor.form.edit');
            Route::post('/formulation/create', [FormulationController::class, 'create'])->name('cefa.agroindustria.units.instructor.formulations.create');
            Route::post('/formulation/edit', [FormulationController::class, 'update'])->name('cefa.agroindustria.units.instructor.formulations.update');
            Route::delete('/formulation/delete/{id}', [FormulationController::class, 'destroy'])->name('cefa.agroindustria.units.instructor.formulations.delete');
        });

        //storer
        Route::prefix('storer')->group(function (){
            Route::get('/inventory', [WarehouseController::class ,'inventory'])->name('cefa.agroindustria.storer.inventory');
            Route::post('/create', [WarehouseController::class ,'create'])->name('cefa.agroindustria.storer.create'); 
            Route::get('/update/{id}', [WarehouseController::class ,'edit'])->name('cefa.agroindustria.storer.update'); 
            Route::post('/edit', [WarehouseController::class ,'show'])->name('cefa.agroindustria.storer.show'); 
            Route::delete('/destroy/{id}', [WarehouseController::class ,'destroy'])->name('cefa.agroindustria.storer.inventory.delete');   
            Route::get('/list', [WarehouseController::class ,'inventoryAlert'])->name('cefa.agroindustria.storer.inventory.list');   
        });       
    });
});
