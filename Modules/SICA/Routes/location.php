<?php
use Illuminate\Support\Facades\Route;
use Modules\SICA\Http\Controllers\location\LocationController;

Route::middleware(['lang'])->group(function(){

    Route::prefix('sica')->group(function() {

        // --------------  Rutas de Paises ---------------------------------
        Route::get('/admin/location/countries', [LocationController::class, 'countries_index'])->name('sica.admin.location.countries.index'); // Vista principal de paises (Administrador)
        Route::get('/admin/location/countries/municipalities/consult', [LocationController::class, 'countries_municipalities_consult'])->name('sica.admin.location.countries.municipalities.consult'); // Consultar municipios de manera asincrónica para departamentos y paises (Administrador)

        // --------------  Rutas de Granjas ---------------------------------
        Route::get('/admin/location/farms', [LocationController::class, 'farms_index'])->name('sica.admin.location.farms.index'); // Vista principal de granjas (Administrdor)

        // --------------  Rutas de Ambientes ---------------------------------
        Route::get('/admin/location/environments', [LocationController::class, 'environments_index'])->name('sica.admin.location.environments.index'); // Vista principal de ambientes de formación (Administrador)

    });

});
