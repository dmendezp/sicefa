<?php

//admin
use Modules\AGROINDUSTRIA\Http\Controllers\admin\RequestController;

//instructor
use Modules\AGROINDUSTRIA\Http\Controllers\instructor\UnitController;
use Modules\AGROINDUSTRIA\Http\Controllers\instructor\LaborController;
use Modules\AGROINDUSTRIA\Http\Controllers\instructor\ActivityController;
use Modules\AGROINDUSTRIA\Http\Controllers\instructor\NewDeliverController;


use Modules\AGROINDUSTRIA\Http\Controllers\Intern\InventoryController;

use Modules\AGROINDUSTRIA\Http\Controllers\Intern\WarehouseController;



Route::prefix('agroindustria')->group(function() {
    Route::get('/index', 'AGROINDUSTRIAController@index')->name('agroindustria.home.index');
    Route::get('/admin', 'AGROINDUSTRIAController@dashboard')->name('agroindustria.admin.dashboard');

    //admin
    Route::prefix('admin')->group(function (){
        Route::get('/solicitud/centro', [RequestController::class, 'solicitudcentro'])->name('agroindustria.admin.solicitud_centro');
    });

    //instructor
    Route::prefix('instructor')->group(function (){
        Route::get('/index', [UnitController::class ,'index'])->name('agroindustria.instructor.index');
        Route::get('/unidd', [UnitController::class, 'unidd'])->name('agroindustria.instructor.unidd');
        Route::get('/solicitud', [RequestController::class, 'solicitud'])->name('agroindustria.instructor.solicitud');
        Route::post('/enviarsolicitud', [RequestController::class, 'enviarsolicitud'])->name('agroindustria.instructor.enviarsolicitud');
        Route::get('/labor', [LaborController::class, 'labor'])->name('agroindustria.instructor.labor');
        Route::get('/activity', [ActivityController::class, 'activity'])->name('agroindustria.instructor.activity');
        Route::get('/movements', [NewDeliverController::class, 'movements'])->name('agroindustria.instructor.movements');
    });

    //intern
    Route::prefix('intern')->group(function (){
        Route::get('/index', [InventoryController::class ,'index'])->name('agroindustria.intern.index');
        Route::get('/invb', [InventoryController::class ,'invb'])->name('agroindustria.intern.invb');
        Route::get('/epp', [WarehouseController::class ,'bodegaepp'])->name('agroindustria.intern.bepp');
        Route::get('/insumos', [WarehouseController::class ,'bodegainsumos'])->name('agroindustria.intern.binsu');
        Route::get('/aseo', [WarehouseController::class ,'bodegaaseo'])->name('agroindustria.intern.baseo');
        Route::get('/envases', [WarehouseController::class ,'bodegaenvases'])->name('agroindustria.intern.benvas');

    });


});

