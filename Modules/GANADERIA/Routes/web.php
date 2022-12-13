<?php
use Illuminate\Support\Facades\Route;
use Modules\GANADERIA\Http\Controllers\GANADERIAController;

Route::middleware(['lang'])->group(function(){

    Route::prefix('ganaderia')->group(function() {

        Route::get('/index', 'GANADERIAController@index')->name('cefa.ganaderia.home.index');
        Route::get('/developers', 'GANADERIA@developers')->name('cefa.ganaderia.home.developers');
        Route::get('/contact', 'GANADERIAController@contact')->name('cefa.ganaderia.home.contact');
        Route::get('/admin', 'AdminController@dashboard')->name('ganaderia.admin.dashboard');
        
        Route::get('/unidades', 'UnidadesController@index')->name('cefa.ganaderia.home.unidades');
       
        
        
    });  

}); 
