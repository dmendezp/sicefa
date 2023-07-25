<?php

use Modules\AGROINDUSTRIA\Http\Controllers\instructor\RequestController;

use Modules\AGROINDUSTRIA\Http\Controllers\instructor\UnitController;

use Modules\AGROINDUSTRIA\Http\Controllers\Intern\InventoryController;

Route::prefix('agroindustria')->group(function() {
    Route::get('/index', 'AGROINDUSTRIAController@index')->name('agroindustria.index');

    //instructor
    Route::get('/unidd', [UnitController::class, 'unidd'])->name('agroindustria.unidd');

    Route::get('/solicitud', [RequestController::class, 'solicitud'])->name('agroindustria.solicitud');
    
    Route::post('/enviarsolicitud', [RequestController::class, 'enviarsolicitud'])->name('agroindustria.enviarsolicitud');

    //intern
    Route::get('/intern/index', [InventoryController::class ,'index'])->name('agroindustria.index');
    
    Route::get('/intern/invb', [InventoryController::class ,'invb'])->name('agroindustria.invb');

});
