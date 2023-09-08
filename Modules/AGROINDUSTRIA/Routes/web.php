<?php

//instructor
use Modules\AGROINDUSTRIA\Http\Controllers\Instructor\FormulationController;
use Modules\AGROINDUSTRIA\Http\Controllers\instructor\UnitController;
use Modules\AGROINDUSTRIA\Http\Controllers\instructor\LaborController;
use Modules\AGROINDUSTRIA\Http\Controllers\instructor\ActivityController;
use Modules\AGROINDUSTRIA\Http\Controllers\instructor\RequestController;
use Modules\AGROINDUSTRIA\Http\Controllers\instructor\DeliverController;
use Modules\AGROINDUSTRIA\Http\Controllers\Unit\BakeryController;
use Modules\AGROINDUSTRIA\Http\Controllers\Intern\WarehouseController;
use Modules\AGROINDUSTRIA\Http\Controllers\Intern\InventoryController;



Route::middleware(['lang'])->group(function(){

    Route::prefix('agroindustria')->group(function() {
        Route::get('/index', 'AGROINDUSTRIAController@index')->name('cefa.agroindustria.home.index');
        Route::get('/cedula/{coordinatorId}', [RequestController::class, 'document_coordinator'])->name('cefa.agroindustria.cedula');

         //intern
         Route::prefix('storer')->group(function (){
            Route::get('/index', [WarehouseController::class ,'index'])->name('agroindustria.storer.index');
            Route::get('/inventory', [WarehouseController::class ,'Inventory'])->name('agroindustria.storer.inventory');
        
        });

        //admin
        Route::prefix('admin')->group(function (){
            Route::get('/dashboard', 'AGROINDUSTRIAController@dashboard')->name('cefa.agroindustria.admin.dashboard');
        });
        
        //unidades productivas
        Route::prefix('units')->group(function (){
            Route::get('/pasteleria/{unit}', [PasteleriaController::class, 'index_pasteleria'])->name('cefa.agroindustria.units.pasteleria');
            Route::get('/bakery/{unit}', [BakeryController::class, 'bakery'])->name('cefa.agroindustria.units.bakery');
        });

        //instructor
        Route::prefix('instructor')->group(function (){
            Route::get('/unidd', [UnitController::class, 'unidd'])->name('cefa.agroindustria.instructor.unidd');
            //Solicitudes
            Route::get('/solicitud', [RequestController::class, 'solicitud'])->name('cefa.agroindustria.instructor.solicitud');
            Route::post('/enviarsolicitud', [RequestController::class, 'create'])->name('cefa.agroindustria.instructor.enviarsolicitud');

            Route::get('/labor', [LaborController::class, 'labor'])->name('cefa.agroindustria.instructor.labor');
            Route::get('/activity', [ActivityController::class, 'activity'])->name('cefa.agroindustria.instructor.activity');
            //Movimientos
            Route::get('/movements', [DeliverController::class, 'deliveries'])->name('cefa.agroindustria.instructor.movements');
            Route::get('/movements/{id}', [DeliverController::class, 'priceInventory'])->name('cefa.agroindustria.instructor.movements.id');
            Route::post('/movements/out', [DeliverController::class, 'createMoveOut'])->name('cefa.agroindustria.instructor.movements.out');

            Route::get('/formulation', [FormulationController::class, 'create'])->name('cefa.agroindustria.instructor.formulations.create');
            Route::get('/units', 'AGROINDUSTRIAController@unidd')->name('cefa.agroindustria.instructor.units');
        });
        //intern
        Route::prefix('storer')->group(function (){
            Route::get('/index', [WarehouseController::class ,'index'])->name('cefa.agroindustria.storer.index');
            Route::get('/inventory', [WarehouseController::class ,'Inventory'])->name('cefa.agroindustria.storer.inventory');

        });

           
       
    });


   

});
