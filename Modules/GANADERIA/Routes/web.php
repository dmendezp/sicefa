<?php
use Illuminate\Support\Facades\Route;
use Modules\GANADERIA\Http\Controllers\GANADERIAControll;
use Modules\GANADERIA\Http\Controllers\reproduction\ReproductionController;
use Modules\GANADERIA\Http\Controllers\activity\ActivityController;
use Modules\GANADERIA\Http\Controllers\appintments\AppointmentController;



Route::middleware(['lang'])->group(function(){

    Route::prefix('ganaderia')->group(function() {

        Route::get('/index', 'GANADERIAController@index')->name('cefa.ganaderia.home.index');
        Route::get('/developers', 'GANADERIA@developers')->name('cefa.ganaderia.home.developers');
        Route::get('/property', 'GANADERIAController@property')->name('cefa.ganaderia.home.property');
        
        //rutas vistas y rol//
        Route::get('/admin', 'AdminController@dashboard')->name('ganaderia.admin.dashboard');
        Route::get('/admin/veterinary', 'AdminController@home')->name('ganaderia.admin.veterinary.home');
        Route::get('/admin/apprentice_leader', 'AdminController@home2')->name('ganaderia.admin.apprentice_leader.home2');

        //RUTAS DE REPRODUCTION// 
        
        Route::get('/admin/reproduction/animalrecord', [ReproductionController::class, 'animalrecord'])->name('ganaderia.admin.reproduction.animalrecord');
        Route::get('/admin/reproduction/reproductivebehavior', [ReproductionController::class, 'reproductivebehavior'])->name('ganaderia.admin.reproduction.reproductivebehavior');

        Route::get('/page/add', [ReproductionController::class, 'add'])->name('ganaderia.admin.config.page.add');
        Route::post('/page/add', [ReproductionController::class, 'addpost'])->name('ganaderia.admin.config.page.add');
        //Para poder Eliminar
        Route::get('/page/delete/{id}', [ReproductionController::class, 'destroy'])->name('ganaderia.admin.page.delete');
        //Para poder Editar
        Route::get('/page/edit/{id}', [ReproductionController::class, 'edit'])->name('ganaderia.admin.config.page.edit');
        Route::post('/page/edit/', [ReproductionController::class, 'editpost'])->name('ganaderia.admin.config.page.edit');
        
        //RUTAS DE REGISTRO DE ACTIVIDAD// 

        Route::get('/admin/activity/productive_unit', [ActivityController::class, 'productive_unit'])->name('ganaderia.admin.activity.productive_unit');
        Route::get('/admin/activity/movement', [ActivityController::class, 'movement'])->name('ganaderia.admin.activity.movement');

        

        


        
   
       




        


        
        
        
       
        
        
    });  

}); 
