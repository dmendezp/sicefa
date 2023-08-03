<?php
use Illuminate\Support\Facades\Route;
use Modules\SICA\Http\Controllers\location\LocationController;

Route::middleware(['lang'])->group(function(){

    Route::prefix('sica')->group(function() {

        Route::get('/admin/location/countries', [LocationController::class, 'countries'])->name('sica.admin.location.countries');
        Route::get('/admin/location/countries/list', [LocationController::class, 'getCountries'])->name('sica.admin.location.countries.getcountries');

        Route::get('/admin/location/farms', [LocationController::class, 'farms'])->name('sica.admin.location.farms');

        Route::get('/admin/location/environments', [LocationController::class, 'environments'])->name('sica.admin.location.environments');
              
    });  

}); 