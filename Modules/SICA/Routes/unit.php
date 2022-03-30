<?php
use Illuminate\Support\Facades\Route;
use Modules\SICA\Http\Controllers\unit\UnitController;

Route::middleware(['lang'])->group(function(){

    Route::prefix('sica')->group(function() {

        Route::get('/admin/unit/areas', [UnitController::class, 'areas'])->name('sica.admin.unit.areas');

        Route::get('/admin/unit/consumption', [UnitController::class, 'consumption'])->name('sica.admin.unit.consumption');

        Route::get('/admin/unit/production', [UnitController::class, 'production'])->name('sica.admin.unit.production');

    });  

}); 