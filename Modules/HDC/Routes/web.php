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
    Route::prefix('hdc')->group(function() {
        Route::get('/index', 'HDCController@index')->name('cefa.hdc.index');

        /* Ruta del Formulario */
        Route::get('/Formulario', 'FormularioController@formulario')->name('cefa.hdc.formulario');
        Route::post('/get_activities', 'FormularioController@getActivities')->name('hdc.activities');
        Route::post('/get_aspects', 'FormularioController@getAspects')->name('hdc.aspects');
        Route::post('/guardar/valores', 'FormularioController@guardarValores')->name('hdc.guardar.valores');
        /* Ruta del CRUD */
        Route::get('/tabla', 'FormularioController@table')->name('admin.hdc.table');


        /* Ruta Para Administrar Recursos */
        Route::get('/AdminstrarRecursos', 'AdminresourcesController@adminresources')->name('cefa.hdc.adminresources');
        Route::post('/guardar','AdminresourcesController@store')->name('hdc.adminresources.store');

        /* Rutas de Calcula tu Huella */
        Route::get('persona', 'CarbonfootprintController@persona')-> name('carbonfootprint.persona');
        Route::get('/calculos/persona/{documento}', 'CarbonfootprintController@calculosPersona')-> name('carbonfootprint.calculos.persona');

        /* Ruta de Graficas */
        Route::get('/Graficas', 'GraficasController@Graficas')->name('cefa.hdc.Graficas');


    });
});

