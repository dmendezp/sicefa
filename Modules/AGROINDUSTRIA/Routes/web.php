<?php

use Modules\AGROINDUSTRIA\Http\Controllers\admin\RequestController;

use Modules\AGROINDUSTRIA\Http\Controllers\instructor\UnitController;
use Modules\AGROINDUSTRIA\Http\Controllers\instructor\LaborController;

use Modules\AGROINDUSTRIA\Http\Controllers\Intern\InventoryController;

Route::prefix('agroindustria')->group(function() {
    Route::get('/index', 'AGROINDUSTRIAController@index')->name('agroindustria.home.index');

    //admin
    Route::prefix('admin')->group(function (){
        Route::get('/solicitud/centro', [RequestController::class, 'solicitudcentro'])->name('agroindustria.admin.solicitud_centro');
    });
    
    //instructor
    Route::prefix('instructor')->group(function (){
        Route::get('/index', [UnitController::class ,'index'])->name('agroindustria.instructor.index');
        Route::get('/unidd', [UnitController::class, 'unidd'])->name('agroindustria.instructor.unidd');
        Route::get('/labor', [LaborController::class, 'labor'])->name('agroindustria.instructor.labor');
    });

    //intern
    Route::prefix('storer')->group(function (){
        Route::get('/index', [InventoryController::class ,'index'])->name('agroindustria.storer.index');
        Route::get('/invb', [InventoryController::class ,'invb'])->name('agroindustria.storer.invb');
    });

});
