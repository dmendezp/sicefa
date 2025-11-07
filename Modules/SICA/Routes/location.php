<?php
use Illuminate\Support\Facades\Route;
use Modules\SICA\Http\Controllers\location\LocationController;

Route::middleware(['lang'])->group(function(){

    Route::prefix('sica')->group(function() {

        // --------------  Rutas de Paises ---------------------------------
        Route::get('/admin/location/countries', [LocationController::class, 'countries_index'])->name('sica.admin.location.countries.index'); // Vista principal de paises (Administrador)
        Route::get('/admin/location/countries/municipalities/consult', [LocationController::class, 'countries_municipalities_consult'])->name('sica.admin.location.countries.municipalities.consult'); // Consultar municipios de manera asincrónica para departamentos y paises (Administrador)

        // --------------  Rutas de Granjas ---------------------------------
        Route::get('/admin/location/farms', [LocationController::class, 'farms_index'])->name('sica.admin.location.farms.index'); // Vista principal de fincas (Administrdor)
        Route::get('/admin/location/farms/create', [LocationController::class, 'farms_create'])->name('sica.admin.location.farms.create'); // Formulario de registro de finca (Administrdor)
        Route::post('/admin/location/farms/store', [LocationController::class, 'farms_store'])->name('sica.admin.location.farms.store'); // Registrar finca (Administrdor)
        Route::get('/admin/location/farms/edit/{farm}', [LocationController::class, 'farms_edit'])->name('sica.admin.location.farms.edit'); // Formulario de actualización de finca (Administrdor)
        Route::post('/admin/location/farms/update/{farm}', [LocationController::class, 'farms_update'])->name('sica.admin.location.farms.update'); // Actualizar finca (Administrdor)
        Route::delete('/admin/location/farms/destroy/{farm}', [LocationController::class, 'farms_destroy'])->name('sica.admin.location.farms.destroy'); // Eliminar finca (Administrdor)

        // --------------  Rutas de Ambientes ---------------------------------
        Route::get('/admin/location/environments', [LocationController::class, 'environments_index'])->name('sica.admin.location.environments.index'); // Vista principal de ambientes de formación (Administrador)
        Route::post('/admin/location/environments/filter', [LocationController::class, 'environments_filter'])->name('sica.admin.location.environments.filter'); // Filtro de ambientes por unidad productiva (Administrador)

    });

});
