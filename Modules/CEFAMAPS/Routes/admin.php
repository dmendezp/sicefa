<?php

use Illuminate\Support\Facades\Route;
use Modules\CEFAMAPS\Http\Controllers\config\EnvironmentController;
use Modules\CEFAMAPS\Http\Controllers\config\UnitController;
use Modules\CEFAMAPS\Http\Controllers\config\FarmController;
use Modules\CEFAMAPS\Http\Controllers\config\CoordinateController;
use Modules\CEFAMAPS\Http\Controllers\config\PageController;

Route::middleware(['lang'])->group(function(){

    Route::prefix('cefamaps')->group(function() {

        // Todas las rutas de los Environments
        Route::get('/environment/index', [EnvironmentController::class, 'index'])->name('cefamaps.admin.config.environment.index');
        Route::get('/environment/view/{id}',[EnvironmentController::class, 'view'])->name('cefa.cefamaps.environment.view');
        // para poder agregar Environments
        Route::get('/environment/add',[EnvironmentController::class, 'add'])->name('cefamaps.admin.config.environment.add');
        Route::post('/environment/add',[EnvironmentController::class, 'addpost'])->name('cefamaps.admin.config.environment.add');
        // para poder editar Environments
        Route::get('/environment/edit/{id}',[EnvironmentController::class, 'edit'])->name('cefamaps.admin.config.environment.edit');
        Route::post('/environment/edit/',[EnvironmentController::class, 'editpost'])->name('cefamaps.admin.environment.edit');
        /* para eliminar coordenadas en editar */
        Route::delete('/environment/eliminar/{id}', [EnvironmentController::class, 'eliminar'])->name('cefamaps.admin.environment.eliminar');
        /* para agregar coordenadas en editar */
        Route::post('/environment/addinput',[EnvironmentController::class, 'addinput'])->name('cefamaps.admin.environment.addinput');
        // para poder eliminar un Environments
        Route::delete('/environment/delete/{id}', [EnvironmentController::class, 'destroy'])->name('cefamaps.admin.environment.delete');

        // Todas la rutas de las Units
        Route::get('/unit/index',[UnitController::class, 'index'])->name('cefamaps.admin.config.unit.index');
        Route::get('/unit/view/{id}',[UnitController::class, 'view'])->name('cefa.cefamaps.unit.view');
        // para poder agregar unidades
        Route::get('/unit/add',[UnitController::class, 'add'])->name('cefamaps.admin.config.unit.add');
        Route::post('/unit/add',[UnitController::class, 'addpost'])->name('cefamaps.admin.config.unit.add');
        // para poder editar unidades
        Route::get('/unit/edit/{id}',[UnitController::class, 'edit'])->name('cefamaps.admin.config.unit.edit');
        Route::post('/unit/edit/',[UnitController::class, 'editpost'])->name('cefamaps.admin.unit.edit');
        // para poder eliminar unidades
        Route::get('/unit/delete/{id}', [UnitController::class, 'destroy'])->name('cefamaps.admin.unit.delete');

        // Todas las rutas de las Farms
        Route::get('/farm/index',[FarmController::class, 'index'])->name('cefamaps.admin.config.farm.index');
        Route::get('/farm/view/{id}',[FarmController::class, 'view'])->name('cefa.cefamaps.farm.view');
        // para poder agregar Farms
        Route::get('/farm/add',[FarmController::class, 'add'])->name('cefamaps.admin.config.farm.add');
        Route::post('/farm/add',[FarmController::class, 'addpost'])->name('cefamaps.admin.config.farm.add');
        // para poder editar Farms
        Route::get('/farm/edit/{id}',[FarmController::class, 'edit'])->name('cefamaps.admin.config.farm.edit');
        Route::post('/farm/edit/',[FarmController::class, 'editpost'])->name('cefamaps.admin.farm.edit');
        // para poder eliminar Farms
        Route::get('/farm/delete/{id}', [FarmController::class, 'destroy'])->name('cefamaps.admin.farm.delete');

        // Todas las rutas de las Page 
        Route::get('/page/index', [PageController::class, 'index'])->name('cefamaps.admin.config.page.index');
        // para poder aregar una Page
        Route::get('/page/add', [PageController::class, 'add'])->name('cefamaps.admin.config.page.add');
        Route::post('/page/add', [PageController::class, 'addpost'])->name('cefamaps.admin.config.page.add');
        // para poder editar una Page
        Route::get('/page/edit/{id}', [PageController::class, 'edit'])->name('cefamaps.admin.config.page.edit');
        Route::post('/page/edit/',[PageController::class, 'editpost'])->name('cefamaps.admin.config.page.edit');
        // para poder borrar una Page
        Route::get('/page/delete/{id}', [PageController::class, 'destroy'])->name('cefamaps.admin.page.delete');

    });

});
