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
    Route::prefix('pserenacefa')->group(function() {
        Route::get('/index', 'PSERENACEFAController@index')->name('cefa.pserenacefa.index');
        Route::get('/admin/welcome', 'PSERENACEFAController@admin')->name('pserenacefa.admin.welcome');
        Route::get('/pasante/welcome', 'PSERENACEFAController@pasante')->name('pserenacefa.pasante.welcomepasante');
        
    });
});