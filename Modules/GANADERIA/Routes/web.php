<?php
use Illuminate\Support\Facades\Route;
use Modules\GANADERIA\Http\Controllers\GANADERIAController;
use Modules\GANADERIA\Http\Controllers\reproduction\ReproductionController;
use Modules\GANADERIA\Http\Controllers\activity\ActivityController;
use Modules\GANADERIA\Http\Controllers\cattle\CattleController;
use Modules\GANADERIA\Http\Controllers\animal\AnimalController;


  Route::prefix('ganaderia')->group(function() {

    Route::get('/index', 'GANADERIAController@index')->name('cefa.ganaderia.home.index');
    Route::get('/property', 'GANADERIAController@property')->name('cefa.ganaderia.home.property');
        
    //rutas vistas y rol
    Route::get('/admin', 'AdminController@dashboard')->name('ganaderia.admin.dashboard');

    //RUTAS DE REPRODUCTION
    Route::get('/admin/reproduction/animalrecord', [ReproductionController::class, 'animalrecord'])->name('ganaderia.admin.reproduction.animalrecord');
    Route::get('/admin/reproduction/reproductivebehavior', [ReproductionController::class, 'reproductivebehavior'])->name('ganaderia.admin.reproduction.reproductivebehavior');

    Route::get('/page/add', [ReproductionController::class, 'add'])->name('ganaderia.admin.config.page.add');
    Route::post('/page/add', [ReproductionController::class, 'addpost'])->name('ganaderia.admin.config.page.add');
    //Para poder Eliminar
    Route::get('/page/delete/{id}', [ReproductionController::class, 'destroy'])->name('ganaderia.admin.page.delete');
    //Para poder Editar
    Route::get('/page/edit/{id}', [ReproductionController::class, 'edit'])->name('ganaderia.admin.config.page.edit');
    Route::post('/page/edit/', [ReproductionController::class, 'editpost'])->name('ganaderia.admin.config.page.edit');
        
    //RUTAS DE REGISTRO DE ACTIVIDAD
    Route::get('/admin/activity/productive_unit', [ActivityController::class, 'productive_unit'])->name('ganaderia.admin.activity.productive_unit');
    Route::get('/admin/activity/movement', [ActivityController::class, 'movement'])->name('ganaderia.admin.activity.movement');

    // RUTAS PARA EL REGISTRO DE GANADO
    Route::get('/admin/cattle/register_cattle', [CattleController::class, 'register_cattle'])->name('ganaderia.admin.cattle.register_cattle');
    Route::get('/admin/cattle/reproduction', [CattleController::class, 'reproduction'])->name('ganaderia.admin.cattle.reproduction');

    // RUTAS PARA LOS FILTROS 
    Route::get('/admin/filter/animals', 'AdminController@animals')->name('ganaderia.admin.filter.animals');
  });

/*
  ganaderia.admin.vet
  ganaderia.admin.leader
  ganaderia.admin.production
  ganaderia.admin.apprentice
  */