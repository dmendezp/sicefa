<?php
//use Illuminate\Support\Facades\Route;
//use Modules\SICA\Http\Controllers\SICAController;

Route::middleware(['lang'])->group(function(){

    Route::prefix('sica')->group(function() {

        Route::get('/index', 'SICAController@index')->name('cefa.sica.home.index');
        Route::get('/developers', 'SICAController@developers')->name('cefa.sica.home.developers');
        Route::get('/contact', 'SICAController@contact')->name('cefa.sica.home.contact');
        Route::get('/admin', 'SICAController@admin_dashboard')->name('sica.admin.dashboard');
        Route::get('/attendance', 'SICAController@attendance_dashboard')->name('sica.attendance.dashboard');
        
    });  

}); 
