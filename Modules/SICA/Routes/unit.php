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
        /* Rutas de asociación de ambientes y unidad productivas */
        Route::get('/admin/units/productive_units/environment_pus', [UnitController::class, 'environment_pus_index'])->name('sica.admin.units.productive_units.environment_pus.index'); /* Listado de ambientes y unidades productivas asociadas (Administrador) */
        Route::post('/admin/units/productive_units/environment_pus/store', [UnitController::class, 'environment_pus_store'])->name('sica.admin.units.productive_units.environment_pus.store'); /* Registrar asociación de ambiente y unidad productiva (Administrador) */
        Route::delete('/admin/units/productive_units/environment_pus/destroy/{epu}', [UnitController::class, 'environment_pus_destroy'])->name('sica.admin.units.productive_units.environment_pus.destroy'); /* Eliminar asociación de ambiente y unidad productiva (Administrador) */

        // --------------  Rutas de asociación de Unidades Productivas y Bodegas ---------------------------------
        Route::get('/admin/units/pu_warehouses', [UnitController::class, 'pu_warehouses_index'])->name('sica.admin.units.pu_warehouses.index'); // Listado de unidades productivas y bodegas asociadas (Administrador)
        Route::post('/admin/units/pu_warhouses/store', [UnitController::class, 'pu_warehouses_store'])->name('sica.admin.units.pu_warehouses.store'); // Registrar asociación de unidad productiva y bodega (Administrador)
        Route::get('/admin/units/pu_warehouses/destroy/{puw}', [UnitController::class, 'pu_warehouses_destroy'])->name('sica.admin.units.pu_warehouses.destroy'); // Eliminar asociación de unidad productiva y bodega (Administrador)

        // --------------  Rutas de Actividades ---------------------------------
        Route::get('/admin/units/activities', [UnitController::class, 'activities_index'])->name('sica.admin.units.activities.index'); // Listado de actividades disponibles (Administrador)
        Route::get('/admin/units/activities/create', [UnitController::class, 'activities_create'])->name('sica.admin.units.activities.create'); // Formulario de registro de actividad (Administrador)
        Route::post('/admin/units/activities/store', [UnitController::class, 'activities_store'])->name('sica.admin.units.activities.store'); // activitiesRegistrar actividad (Administrador)
        Route::get('/admin/units/activities/edit/{activity}', [UnitController::class, 'activities_edit'])->name('sica.admin.units.activities.edit'); // Consultar actividad para su actualización (Administrador)
        Route::post('/admin/units/activities/update/{activity}', [UnitController::class, 'activities_update'])->name('sica.admin.units.activities.update'); // Actualizar actividad (Administrador)
        Route::delete('/admin/units/activities/destroy/{activity}', [UnitController::class, 'activities_destroy'])->name('sica.admin.units.activities.destroy'); // Eliminar actividad (Administrador)


        Route::get('/admin/units/areas', [UnitController::class, 'areas_index'])->name('sica.admin.units.areas.index');// Listado de Areas disponibles (Administrador)
        Route::get('/admin/units/areas/create', [UnitController::class, 'areas_create'])->name('sica.admin.units.areas.create'); // Formulario de registro de Area (Administrador)
        Route::post('/admin/units/areas/store', [UnitController::class, 'areas_store'])->name('sica.admin.units.areas.store'); // Registrar Area (Administrador)
        Route::get('/admin/units/areas/edit/{id}', [UnitController::class, 'areas_edit'])->name('sica.admin.units.areas.edit'); // Consultar Area para su actualización (Administrador)
        Route::post('/admin/units/areas/update/', [UnitController::class, 'areas_update'])->name('sica.admin.units.areas.update'); // Actualizar Area (Administrador)
        Route::get('/admin/units/areas/delete/{id}', [UnitController::class, 'areas_delete'])->name('sica.admin.units.areas.delete'); // Formulario de eliminacion del area (Administrador)
        Route::post('/admin/units/areas/destroy/', [UnitController::class, 'areas_destroy'])->name('sica.admin.units.areas.destroy'); // Eliminar Area (Administrador)

        Route::get('/admin/units/consumption', [UnitController::class, 'consumption'])->name('sica.admin.units.consumption');
        Route::get('/admin/units/production', [UnitController::class, 'production'])->name('sica.admin.units.production');

    });

});
