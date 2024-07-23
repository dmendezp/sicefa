<?php

use Illuminate\Support\Facades\Route;
use Modules\CEFAMAPS\Http\Controllers\config\EnvironmentController;
use Modules\CEFAMAPS\Http\Controllers\config\UnitController;
use Modules\CEFAMAPS\Http\Controllers\config\ClassController;
use Modules\CEFAMAPS\Http\Controllers\config\SectorController;
use Modules\CEFAMAPS\Http\Controllers\config\CoordinateController;
use Modules\CEFAMAPS\Http\Controllers\config\PageController;

Route::middleware(['lang'])->group(function(){

    Route::prefix('cefamaps')->group(function() {

        // Todas las rutas de los Environments
        Route::get('/environment/index', [EnvironmentController::class, 'index'])->name('cefamaps.admin.config.environment.index');
        Route::get('/environment/view/{id}',[EnvironmentController::class, 'view'])->name('cefa.cefamaps.environment.view');
        Route::get('/environment/viewenvironments/{id}',[EnvironmentController::class, 'viewenvironments'])->name('cefa.cefamaps.environment.viewenvironments');
        // para poder agregar Environments
        Route::get('/environment/add',[EnvironmentController::class, 'add'])->name('cefamaps.admin.config.environment.add');
        Route::post('/environment/add',[EnvironmentController::class, 'addpost'])->name('cefamaps.admin.config.environment.add');
        // para poder editar Environments
        Route::get('/environment/edit/{id}',[EnvironmentController::class, 'edit'])->name('cefamaps.admin.config.environment.edit');
        Route::post('/environment/edit/',[EnvironmentController::class, 'editpost'])->name('cefamaps.admin.environment.edit');
        // para poder eliminar un Environments
        Route::get('/environment/delete/{id}', [EnvironmentController::class, 'destroy'])->name('cefamaps.admin.environment.delete');
        /* para eliminar coordenadas en editar */
        Route::delete('/environment/eliminar/{id}', [EnvironmentController::class, 'eliminar'])->name('cefamaps.admin.environment.eliminar');
        /* para agregar coordenadas en editar */
        Route::post('/environment/addinput',[EnvironmentController::class, 'addinput'])->name('cefamaps.admin.environment.addinput');

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
        // para buscar el usuario por numero de documento
        Route::get('/unit/search/{document}',[UnitController::class, 'search'])->name('cefamaps.admin.unit.search');

        // Todas las rutas de las Sector
        Route::get('/sector/index',[SectorController::class, 'index'])->name('cefamaps.admin.config.sector.index');
        // para poder agregar Sector
        Route::get('/sector/add',[SectorController::class, 'add'])->name('cefamaps.admin.config.sector.add');
        Route::post('/sector/add',[SectorController::class, 'addpost'])->name('cefamaps.admin.config.sector.add');
        // para poder editar Sector
        Route::get('/sector/edit/{id}',[SectorController::class, 'edit'])->name('cefamaps.admin.config.sector.edit');
        Route::post('/sector/edit/',[SectorController::class, 'editpost'])->name('cefamaps.admin.sector.edit');
        // para poder eliminar Sector
        Route::get('/sector/delete/{id}', [SectorController::class, 'destroy'])->name('cefamaps.admin.sector.delete');

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

        // Todas la rutas de las Units
        Route::get('/class/index',[ClassController::class, 'index'])->name('cefamaps.admin.config.class.index');
        Route::get('/class/view/{id}',[ClassController::class, 'view'])->name('cefa.cefamaps.class.view');
        // para poder agregar unidades
        Route::get('/class/add',[ClassController::class, 'add'])->name('cefamaps.admin.config.class.add');
        Route::post('/class/add',[ClassController::class, 'addpost'])->name('cefamaps.admin.config.class.store');
        // para poder editar unidades
        Route::get('admin/class/edit/{id}',[ClassController::class, 'edit'])->name('cefamaps.admin.config.class.edit');
        Route::post('admin/class/edit/',[ClassController::class, 'editpost'])->name('cefamaps.admin.config.class.update');
        // para poder eliminar unidades
        Route::get('admin/class/delete/{id}', [ClassController::class, 'destroy'])->name('cefamaps.admin.class.destroy');

        // Todas la rutas de las Units
        Route::get('/environmentmanager/class/index',[ClassController::class, 'index'])->name('cefamaps.environmentmanager.config.class.index');
        // para poder agregar unidades
        Route::get('/environmentmanager/class/add',[ClassController::class, 'add'])->name('cefamaps.environmentmanager.config.class.add');
        Route::post('/environmentmanager/class/add',[ClassController::class, 'addpost'])->name('cefamaps.environmentmanager.config.class.store');
        // para poder editar unidades
        Route::get('/environmentmanager/class/edit/{id}',[ClassController::class, 'edit'])->name('cefamaps.environmentmanager.config.class.edit');
        Route::post('/environmentmanager/class/edit/',[ClassController::class, 'editpost'])->name('cefamaps.environmentmanager.config.class.update');
        // para poder eliminar unidades
        Route::get('/environmentmanager/class/delete/{id}', [ClassController::class, 'destroy'])->name('cefamaps.environmentmanager.class.destroy');


        // Todas las rutas de los Environments
        Route::get('/environmentmanager/environment/index', [EnvironmentController::class, 'index'])->name('cefamaps.environmentmanager.config.environment.index');
        // para poder agregar Environments
        Route::get('/environmentmanager/environment/add',[EnvironmentController::class, 'add'])->name('cefamaps.environmentmanager.config.environment.add');
        Route::post('/environmentmanager/environment/add',[EnvironmentController::class, 'addpost'])->name('cefamaps.environmentmanager.config.environment.add');
        // para poder editar Environments
        Route::get('/environmentmanager/environment/edit/{id}',[EnvironmentController::class, 'edit'])->name('cefamaps.environmentmanager.config.environment.edit');
        Route::post('/environmentmanager/environment/edit/',[EnvironmentController::class, 'editpost'])->name('cefamaps.environmentmanager.environment.edit');
        // para poder eliminar un Environments
        Route::get('/environmentmanager/environment/delete/{id}', [EnvironmentController::class, 'destroy'])->name('cefamaps.environmentmanager.environment.delete');
        /* para eliminar coordenadas en editar */
        Route::delete('/environmentmanager/environment/eliminar/{id}', [EnvironmentController::class, 'eliminar'])->name('cefamaps.environmentmanager.environment.eliminar');
        /* para agregar coordenadas en editar */
        Route::post('/environmentmanager/environment/addinput',[EnvironmentController::class, 'addinput'])->name('cefamaps.environmentmanager.environment.addinput');


    });

});
