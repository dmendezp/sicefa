<?php

//instructor
use Modules\AGROINDUSTRIA\Http\Controllers\Instructor\FormulationController;
use Modules\AGROINDUSTRIA\Http\Controllers\instructor\UnitController;
use Modules\AGROINDUSTRIA\Http\Controllers\instructor\LaborController;
use Modules\AGROINDUSTRIA\Http\Controllers\instructor\ActivityController;
use Modules\AGROINDUSTRIA\Http\Controllers\instructor\DeliverController;
use Modules\AGROINDUSTRIA\Http\Controllers\instructor\RequestController;

//unidades
use Modules\AGROINDUSTRIA\Http\Controllers\unit\PasteleriaController;
use Modules\AGROINDUSTRIA\Http\Controllers\unit\BakeryController;

//almacenista
use Modules\AGROINDUSTRIA\Http\Controllers\Intern\InventoryController;
use Modules\AGROINDUSTRIA\Http\Controllers\Intern\WarehouseController;


Route::middleware(['lang'])->group(function(){

    Route::prefix('agroindustria')->group(function() {
        Route::get('/index', 'AGROINDUSTRIAController@index')->name('cefa.agroindustria.home.index');
        Route::get('/cedula/{coordinatorId}', [RequestController::class, 'document_coordinator'])->name('cefa.agroindustria.cedula');

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
            Route::get('/solicitud', [RequestController::class, 'solicitud'])->name('cefa.agroindustria.instructor.solicitud');
            Route::post('/enviarsolicitud', [RequestController::class, 'create'])->name('cefa.agroindustria.instructor.enviarsolicitud');
            Route::get('/labor', [LaborController::class, 'labor'])->name('cefa.agroindustria.instructor.labor');
            Route::get('/activity', [ActivityController::class, 'activity'])->name('cefa.agroindustria.instructor.activity');
            Route::get('/movements', [DeliverController::class, 'deliveries'])->name('cefa.agroindustria.instructor.movements');
            Route::get('/movements/{id}', [DeliverController::class, 'priceInventory'])->name('cefa.agroindustria.instructor.movements.id');
            Route::get('/formulation', [FormulationController::class, 'create'])->name('cefa.agroindustria.instructor.formulations.create');
            Route::get('/units', 'AGROINDUSTRIAController@unidd')->name('cefa.agroindustria.instructor.units');
        });

        //intern
        Route::prefix('storer')->group(function (){
            Route::get('/invb', [InventoryController::class ,'invb'])->name('cefa.agroindustria.intern.invb');
            Route::get('/epp', [WarehouseController::class ,'bodegaepp'])->name('cefa.agroindustria.intern.bepp');
            Route::get('/insumos', [WarehouseController::class ,'bodegainsumos'])->name('cefa.agroindustria.intern.binsu');
            Route::get('/aseo', [WarehouseController::class ,'bodegaaseo'])->name('cefa.agroindustria.intern.baseo');
            Route::get('/envases', [WarehouseController::class ,'bodegaenvases'])->name('cefa.agroindustria.intern.benvas');

        });
    });
});
