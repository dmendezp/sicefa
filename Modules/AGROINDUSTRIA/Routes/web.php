<?php

//admin
use Modules\AGROINDUSTRIA\Http\Controllers\admin\RequestController;

//instructor
use Modules\AGROINDUSTRIA\Http\Controllers\instructor\UnitController;
use Modules\AGROINDUSTRIA\Http\Controllers\instructor\LaborController;
use Modules\AGROINDUSTRIA\Http\Controllers\instructor\ActivityController;
use Modules\AGROINDUSTRIA\Http\Controllers\instructor\NewDeliverController;
use Modules\AGROINDUSTRIA\Http\Controllers\Intern\WarehouseController;
use Modules\AGROINDUSTRIA\Http\Controllers\Intern\InventoryController;




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
    Route::prefix('storer')->group(function (){
        Route::get('/index', [WarehouseController::class ,'index'])->name('agroindustria.storer.index');
        Route::get('/inventory', [WarehouseController::class ,'Inventory'])->name('agroindustria.storer.inventory');
       
    });


});

