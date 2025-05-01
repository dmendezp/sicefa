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

use Illuminate\Routing\RouteGroup;

Route::middleware(['lang'])->group(function(){
    Route::prefix('pserenacefa')->group(function() {
        Route::get('/index', 'PSERENACEFAController@index')->name('cefa.pserenacefa.index');
        Route::get('/admin/welcome', 'PSERENACEFAController@admin')->name('pserenacefa.admin.welcome');
        Route::get('/pasante/welcomepasante', 'PSERENACEFAController@pasante')->name('pserenacefa.pasante.welcomepasante');
        
    });
});

Route::controller(Environment1Controller::class)->group(function(){
    Route::get('/admin/admin/index', 'index')->name('psernacefa.admin.admin.index');
    Route::get('/admin/admin/create', 'create')->name('psernacefa.admin.admin.create');
    Route::post('/admin/admin/store', 'store')->name('pserenacefa.admin.admin.store');
    Route::get('/admin/admin/edit/{id}', 'edit')->name('pserenacefa.admin.admin.edit');
    Route::put('/admin/admin/update/{id}', 'update')->name('pserenacefa.admin.admin.update');
    Route::delete('/admin/admin/destroy/{id}', 'destroy')->name('pserenacefa.admin.admin.destroy');
});

