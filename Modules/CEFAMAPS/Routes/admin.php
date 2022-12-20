<?php

use Illuminate\Support\Facades\Route;
use Modules\CEFAMAPS\Http\Controllers\config\EnvironmentController;
use Modules\CEFAMAPS\Http\Controllers\config\UnitController;

Route::middleware(['lang'])->group(function(){

    Route::prefix('cefamaps')->group(function() {
        Route::get('/environment/index', [EnvironmentController::class, 'index'])->name('cefamaps.admin.config.environment.index');
        Route::get('/environment/add',[EnvironmentController::class, 'add'])->name('cefamaps.admin.environment.add');
        Route::get('/environment/add',[EnvironmentController::class, 'addpost'])->name('cefamaps.admin.environment.add');
        // Todas la rutas de las unidades
        Route::get('/unit/index',[UnitController::class, 'index'])->name('cefamaps.admin.config.unit.index');
        Route::get('/unit/add',[UnitController::class, 'add'])->name('cefamaps.admin.unit.add');
        //Route::get('/admin/environment/index', [EnvironmentController::class, 'environment'])->name('cefamaps.admin.environment.index');
        //Route::get('/environment/index', 'EnvironmentController@environment')->name('cefamaps.admin.environment.index');
        //Route::get('/admin/people/config', [PeopleController::class, 'config'])->name('sica.admin.people.config');

    });

});
