<?php
use Illuminate\Support\Facades\Route;
use Modules\SICA\Http\Controllers\unit\UnitController;

Route::middleware(['lang'])->group(function(){

    Route::prefix('sica')->group(function() {

        Route::get('/admin/units/areas', [UnitController::class, 'areas'])->name('sica.admin.units.areas');

        Route::get('/admin/units/consumption', [UnitController::class, 'consumption'])->name('sica.admin.units.consumption');

        Route::get('/admin/units/production', [UnitController::class, 'production'])->name('sica.admin.units.production');

    });  

}); 