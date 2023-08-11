<?php
use Illuminate\Support\Facades\Route;
use Modules\SICA\Http\Controllers\unit\UnitController;

Route::middleware(['lang'])->group(function(){

    Route::prefix('sica')->group(function() {

        // --------------  Rutas de Unidades Productivas ---------------------------------
        Route::get('/admin/units/productive_units', [UnitController::class, 'productive_unit_index'])->name('sica.admin.units.productive_unit.index'); // Listado de unidades productivas disponibles (Administrador)
        Route::get('/admin/units/productive_units/create', [UnitController::class, 'productive_unit_create'])->name('sica.admin.units.productive_unit.create'); // Formulario de registro de unidad productiva (Administrador)
        Route::post('/admin/units/productive_units/store', [UnitController::class, 'productive_unit_store'])->name('sica.admin.units.productive_unit.store'); // Registrar unidad productiva (Administrador)
        Route::get('/admin/units/productive_units/edit/{productive_unit}', [UnitController::class, 'productive_unit_edit'])->name('sica.admin.units.productive_unit.edit'); // Consultar unidad productiva para su actualización (Administrador)
        Route::post('/admin/units/productive_units/update/{productive_unit}', [UnitController::class, 'productive_unit_update'])->name('sica.admin.units.productive_unit.update'); // Actualizar unidad productiva (Administrador)
        Route::get('/admin/units/productive_units/destroy/{productive_unit}', [UnitController::class, 'productive_unit_destroy'])->name('sica.admin.units.productive_unit.destroy'); // Eliminar unidad productiva (Administrador)

        Route::get('/admin/units/areas', [UnitController::class, 'areas'])->name('sica.admin.units.areas');
        Route::get('/admin/units/consumption', [UnitController::class, 'consumption'])->name('sica.admin.units.consumption');
        Route::get('/admin/units/production', [UnitController::class, 'production'])->name('sica.admin.units.production');

    });

});
