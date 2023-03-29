<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['lang'])->group(function(){

    Route::prefix('cefamaps')->group(function() {
        
        Route::get('/index', 'CEFAMAPSController@index')->name('cefa.cefamaps.index');;
        Route::get('/sst', 'CEFAMAPSController@sst')->name('cefa.cefamaps.sst');
        Route::get('/sst/evacuation', 'CEFAMAPSController@evacuation')->name('cefa.cefamaps.sst.evacuation');


    });  

}); 




