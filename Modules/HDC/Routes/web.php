<?php

use Illuminate\Support\Facades\Route;

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
Route::middleware(['lang'])->group(function() {
    Route::prefix('/hdc')->group(function() {
        Route::get('/index', 'HDCController@index')->name('cefa.hdc.index');
        /* Ruta del Formulario */
        Route::get('/Formulario', 'FormularioController@formulario')->name('cefa.hdc.formulario');
        /* Ruta Para Administrar Recursos */
        Route::get('/AdminstrarRecursos', 'AdminresourcesController@adminresources')->name('cefa.hdc.adminresources');


    });
});
