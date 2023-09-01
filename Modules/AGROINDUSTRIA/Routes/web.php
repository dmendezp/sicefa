<?php

//admin
use Modules\AGROINDUSTRIA\Http\Controllers\admin\RequestController;

//instructor
use Modules\AGROINDUSTRIA\Http\Controllers\Instructor\FormulationController;
use Modules\AGROINDUSTRIA\Http\Controllers\instructor\UnitController;
use Modules\AGROINDUSTRIA\Http\Controllers\instructor\LaborController;
use Modules\AGROINDUSTRIA\Http\Controllers\instructor\ActivityController;
use Modules\AGROINDUSTRIA\Http\Controllers\instructor\DeliverController;

//unidades
use Modules\AGROINDUSTRIA\Http\Controllers\unit\PasteleriaController;
use Modules\AGROINDUSTRIA\Http\Controllers\unit\BakeryController;

//almacenista
use Modules\AGROINDUSTRIA\Http\Controllers\Intern\InventoryController;
use Modules\AGROINDUSTRIA\Http\Controllers\Intern\WarehouseController;



Route::prefix('agroindustria')->group(function() {
    Route::get('/index', 'AGROINDUSTRIAController@index')->name('agroindustria.home.index');

    //admin
    Route::prefix('admin')->group(function (){
        Route::get('/dashboard', 'AGROINDUSTRIAController@dashboard')->name('agroindustria.admin.dashboard');
    });
    
    //unidades productivas
    Route::prefix('units')->group(function (){
        Route::get('/pasteleria/{unit}', [PasteleriaController::class, 'index_pasteleria'])->name('agroindustria.units.pasteleria');
        Route::get('/bakery/{unit}', [BakeryController::class, 'bakery'])->name('agroindustria.units.bakery');
    });

    //instructor
    Route::prefix('instructor')->group(function (){
        Route::get('/unidd', [UnitController::class, 'unidd'])->name('agroindustria.instructor.unidd');
        Route::get('/solicitud', [RequestController::class, 'solicitud'])->name('agroindustria.instructor.solicitud');
        Route::post('/enviarsolicitud', [RequestController::class, 'enviarsolicitud'])->name('agroindustria.instructor.enviarsolicitud');
        Route::get('/labor', [LaborController::class, 'labor'])->name('agroindustria.instructor.labor');
        Route::get('/activity', [ActivityController::class, 'activity'])->name('agroindustria.instructor.activity');
        Route::get('/movements', [NewDeliverController::class, 'movements'])->name('agroindustria.instructor.movements');
        Route::get('/formulation', [FormulationController::class, 'create'])->name('agroindustria.instructor.formulations.create');
        Route::get('/units', 'AGROINDUSTRIAController@unidd')->name('agroindustria.instructor.units');
    });

    //intern
    Route::prefix('storer')->group(function (){
        Route::get('/index', [InventoryController::class ,'index'])->name('agroindustria.intern.index');
        Route::get('/invb', [InventoryController::class ,'invb'])->name('agroindustria.intern.invb');
        Route::get('/epp', [WarehouseController::class ,'bodegaepp'])->name('agroindustria.intern.bepp');
        Route::get('/insumos', [WarehouseController::class ,'bodegainsumos'])->name('agroindustria.intern.binsu');
        Route::get('/aseo', [WarehouseController::class ,'bodegaaseo'])->name('agroindustria.intern.baseo');
        Route::get('/envases', [WarehouseController::class ,'bodegaenvases'])->name('agroindustria.intern.benvas');

    });


});

