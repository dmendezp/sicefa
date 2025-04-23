<?php
use illuminate\Support\Facades\Route;
use Modules\GDF\Http\Controllers\GDFController;

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
Route::middleware(['lang'])->group(function () {
    Route::prefix('gdf')->group(function () {
        Route::get('/index', 'GDFController@index')->name('cefa.gdf.index');
        Route::get('/funcionario/welcome', 'GDFController@funcionario')->name('cefa.gdf.funcionario.welcome');
        Route::get('/admin/welcome', 'GDFController@admin')->name('cefa.gdf.admin.welcome');

        Route::controller(GDFController::class)->group(function () { //Agrega por única vez el controlador, para que seguidamente sea solo.
            Route::get('/admin/certificate/index', 'GDFController@index_certificate')->name('cefa.gdf.index_certificate'); 
            Route::get('/admin/certificate/create', 'GDFController@create_certificate')->name('cefa.gdf.create_certificate');
            Route::post('/admin/certificate/store', 'GDFController@store_certificate')->name('cefa.gdf.store_certificate'); 
            Route::get('/admin/certificate/edit/{id}', 'GDFController@edit_certificate')->name('cefa.gdf.edit_certificate'); 
            Route::post('/admin/certificate/update/{id}', 'GDFController@update_certificate')->name('cefa.gdf.update_certificate'); 
            Route::get('/admin/certificate/destroy/{id}', 'GDFController@destroy_certificate')->name('cefa.gdf.destroy_certificate'); 
        });

    });

    
});

