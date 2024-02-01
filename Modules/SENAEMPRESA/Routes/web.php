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



//Route::middleware(['lang'])->group(function(){
    Route::prefix('senaempresa')->group(function() {
        Route::get('index/', 'SENAEMPRESAController@index')->name('index');
        Route::get('TurnoRutinario/', 'AsistenciaTurnosController@index')->name('turnosRutinarios');
        Route::get('TurnoRutinario/buscarLista/{id}', 'AsistenciaTurnosController@buscarLista')->name('buscarLista');
        Route::get('TurnoRutinario/Guardar/{id}', 'AsistenciaTurnosController@getAsignarTurno')->name('adicionarTurno');
        Route::get('TurnoRutinario/Guardado/', 'AsistenciaTurnosController@postAsignarTurno')->name('guardarTurno');
        Route::get('ListaTurnos', 'AsistenciaTurnosController@listaTurnos')->name('listaTurnos');
        Route::post('/updateTurno', 'AsistenciaTurnosController@updateTurno')->name('updateTurno');
        //Route::resource('turnos', 'AsistenciaTurnosController');
        //Route::resource('reports', 'ProductController')
        
    });

//});
