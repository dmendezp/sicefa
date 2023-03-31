<?php
use Illuminate\Support\Facades\Route;
<<<<<<< HEAD
use Modules\GANADERIA\Http\Controllers\GANADERIAController;
use Modules\GANADERIA\Http\Controllers\activity\ActivityController;
use Modules\GANADERIA\Http\Controllers\cattle\CattleController;
use Modules\GANADERIA\Http\Controllers\reproduction\ReproductionController;

=======
use Modules\GANADERIA\Http\Controllers\GANADERIAControll;
<<<<<<< HEAD
use Modules\GANADERIA\Http\Controllers\reproduction\ReproductionController;
use Modules\GANADERIA\Http\Controllers\activity\ActivityController;
use Modules\GANADERIA\Http\Controllers\appintments\AppointmentController;
=======
use Modules\GANADERIA\Http\Controllers\inventory\InventoryController;
use Modules\GANADERIA\Http\Controllers\reproduction\ReproductionController;
use Modules\GANADERIA\Http\Controllers\medicalhistory\MedicalhistoryController;
>>>>>>> 9e522343459ee925d0b5f3facbe07726bbe7eda3
>>>>>>> 38c7f0aef500bd787694266d92d1596b42416e45

Route::middleware(['lang'])->group(function(){


Route::middleware(['lang'])->group(function(){

    Route::prefix('ganaderia')->group(function() {
<<<<<<< HEAD

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

        // RUTAS PARA EL REGISTRO DE GANADO//

        Route::get('/admin/cattle/register_cattle', [CattleController::class, 'register_cattle'])->name('ganaderia.admin.cattle.register_cattle');
        
        


    
        

        


        
   
       




        


        
        
        
       
        
        
    });  

=======
>>>>>>> 38c7f0aef500bd787694266d92d1596b42416e45

        Route::get('/index', 'GANADERIAController@index')->name('cefa.ganaderia.home.index');
        Route::get('/developers', 'GANADERIA@developers')->name('cefa.ganaderia.home.developers');
<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 9e522343459ee925d0b5f3facbe07726bbe7eda3
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
        
<<<<<<< HEAD
        //RUTAS DE REGISTRO DE ACTIVIDAD// 

        Route::get('/admin/activity/productive_unit', [ActivityController::class, 'productive_unit'])->name('ganaderia.admin.activity.productive_unit');
        Route::get('/admin/activity/movement', [ActivityController::class, 'movement'])->name('ganaderia.admin.activity.movement');

        

=======

    
        //RUTAS DE INVENTORY//
        Route::get('/admin/inventory/supplies', [InventoryController::class, 'supplies'])->name('ganaderia.admin.inventory.supplies');
        Route::get('/admin/inventory/medicine', [InventoryController::class, 'medicine'])->name('ganaderia.admin.inventory.medicine');
        Route::get('/admin/inventory/animals', [InventoryController::class, 'animals'])->name('ganaderia.admin.inventory.animals');
        

        //RUTAS DE HISTORIAL CLINICO//

        Route::get('/admin/medicalhistory/generaldata', [MedicalhistoryController::class, 'generaldata'])->name('ganaderia.admin.medicalhistory.generaldata');
        Route::get('/admin/medicalhistory/reproductivebehavior', [MedicalhistoryController::class, 'reproductivebehavior'])->name('ganaderia.admin.medicalhistory.reproductivebehavior');
>>>>>>> 9e522343459ee925d0b5f3facbe07726bbe7eda3
        


        
   
       




        


        
        
        
<<<<<<< HEAD
=======
=======
        Route::get('/contact', 'GANADERIAController@contact')->name('cefa.ganaderia.home.contact');
        Route::get('/admin', 'AdminController@dashboard')->name('ganaderia.admin.dashboard');
        
        Route::get('/unidades', 'UnidadesController@index')->name('cefa.ganaderia.home.unidades');
>>>>>>> ecf44174427f6326b1453a36d931e98cfb747e27
>>>>>>> 9e522343459ee925d0b5f3facbe07726bbe7eda3
       
        
        
    });  

}); 
