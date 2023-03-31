<?php
use Illuminate\Support\Facades\Route;
use Modules\GANADERIA\Http\Controllers\unit\UnitController;

Route::middleware(['lang'])->group(function(){

    Route::prefix('ganaderia')->group(function() {

        Route::get('/admin/units/areas', [UnitController::class, 'areas'])->name('ganaderia.admin.units.areas');

        Route::get('/admin/units/consumption', [UnitController::class, 'consumption'])->name('ganaderia.admin.units.consumption');

        Route::get('/admin/units/production', [UnitController::class, 'production'])->name('ganaderia.admin.units.production');
       

    });  

}); 