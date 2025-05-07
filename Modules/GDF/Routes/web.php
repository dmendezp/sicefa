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
        Route::get('/superadmin/welcome', 'GDFController@superadmin')->name('cefa.gdf.superadmin.welcome');
        Route::get('/admin/welcome', 'GDFController@admin')->name('cefa.gdf.admin.welcome');

        Route::controller(GDFController::class)->group(function () { //Agrega por única vez el controlador, para que seguidamente sea solo.

            //Atividades
            Route::get('/admin/activities/index', 'GDFController@index_activities')->name('cefa.gdf.index_activities'); 
            Route::get('/funcionario/activities/index', 'GDFController@index_activities')->name('cefa.gdf.index_activities'); 
            Route::get('/admin/activities/create', 'GDFController@create_activities')->name('cefa.gdf.create_activities');
            Route::post('/admin/activities/store', 'GDFController@store_activities')->name('cefa.gdf.store_activities'); 
            Route::put('/admin/activities/aprobar/{id}', 'GDFController@aprobar_activities')->name('cefa.gdf.aprobar_activities'); 
            Route::put('/admin/activities/rechazar/{id}', 'GDFController@rechazar_activities')->name('cefa.gdf.rechazar_activities'); 

            //Precios
            Route::get('/admin/budget/index', 'GDFController@index_budget')->name('cefa.gdf.index_budget');
            Route::get('/admin/budget/create', 'GDFController@create_budget')->name('cefa.gdf.create_budget');
            Route::post('/admin/budget/store', 'GDFController@store_budget')->name('cefa.gdf.store_budget');
        });

    });

    
});

