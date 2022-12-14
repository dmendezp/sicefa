<?php

use Illuminate\Support\Facades\Route;
use Modules\CEFAMAPS\Http\Controllers\environment\EnvironmentController;

Route::middleware(['lang'])->group(function(){

    Route::prefix('cefamaps')->group(function() {
        Route::get('/environment/config', [EnvironmentController::class, 'config'])->name('cefamaps.admin.environment.config');
        //Route::get('/admin/environment/index', [EnvironmentController::class, 'environment'])->name('cefamaps.admin.environment.index');
        //Route::get('/environment/index', 'EnvironmentController@environment')->name('cefamaps.admin.environment.index');
        //Route::get('/admin/people/config', [PeopleController::class, 'config'])->name('sica.admin.people.config');

    });

});
