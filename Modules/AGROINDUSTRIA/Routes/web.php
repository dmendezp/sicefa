<?php

use Modules\AGROINDUSTRIA\Http\Controllers\instructor\RequestController;

use Modules\AGROINDUSTRIA\Http\Controllers\instructor\UnitController;

use Modules\AGROINDUSTRIA\Http\Controllers\Intern\InventoryController;

use Modules\AGROINDUSTRIA\Http\Controllers\Instructor\FormulationController;

Route::prefix('agroindustria')->group(function() {
    Route::get('/index', 'AGROINDUSTRIAController@index')->name('agroindustria.index');

    //instructor
    Route::prefix('instructor')->group(function (){
        Route::get('/index', [UnitController::class ,'index'])->name('agroindustria.instructor.index');
        Route::get('/unidd', [UnitController::class, 'unidd'])->name('agroindustria.instructor.unidd');
        Route::get('/solicitud', [RequestController::class, 'solicitud'])->name('agroindustria.instructor.solicitud');
        Route::post('/enviarsolicitud', [RequestController::class, 'enviarsolicitud'])->name('agroindustria.instructor.enviarsolicitud');
    });

    //intern
    Route::prefix('storer')->group(function (){
        Route::get('/index', [InventoryController::class ,'index'])->name('agroindustria.storer.index');
        Route::get('/invb', [InventoryController::class ,'invb'])->name('agroindustria.storer.invb');
    });

    Route::get('/formulations', [FormulationController::class, 'index']);
    Route::get('/formulations/create', [FormulationController::class, 'create']);

});
