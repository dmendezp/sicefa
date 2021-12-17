<?php
use Illuminate\Support\Facades\Route;
use Modules\SICA\Http\Controllers\SICAController;

Route::middleware(['lang'])->group(function(){

    Route::prefix('sica')->group(function() {

        Route::get('/index', 'SICAController@index')->name('sica.cefa.home');
        Route::get('/app/list', 'SICAController@index')->name('sica.app.list');

    });  

}); 
