<?php
use Illuminate\Support\Facades\Route;
use Modules\GANADERIA\Http\Controllers\location\LocationController;

Route::middleware(['lang'])->group(function(){

    Route::prefix('ganaderia')->group(function() {

        Route::get('/admin/location/countries', [LocationController::class, 'countries'])->name('ganaderia.admin.location.countries');
        Route::get('/admin/location/countries/list', [LocationController::class, 'getCountries'])->name('ganaderia.admin.location.countries.getcountries');

        Route::get('/admin/location/farms', [LocationController::class, 'farms'])->name('ganaderia.admin.location.farms');

        Route::get('/admin/location/environments', [LocationController::class, 'environments'])->name('ganaderia.admin.location.environments');
              
    });  

}); 