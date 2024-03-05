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

include __DIR__ . '/admin.php';
include __DIR__ . '/human_talent_leader.php';
include __DIR__ . '/psychologo.php';
include __DIR__ . '/apprentice.php';


Route::middleware(['lang'])->group(function () {
    //Route::middleware(['lang'])->group(function(){
    Route::prefix('senaempresa')->group(function () {
        Route::get('index/', 'SENAEMPRESAController@index')->name('cefa.senaempresa.index');
        Route::get('developers/', 'SENAEMPRESAController@Developers')->name('cefa.senaempresa.developers');

        Route::get('TurnoRutinario/', 'AsistenciaTurnosController@index')->name('turnosRutinarios');
        Route::get('TurnoRutinario/buscarLista/{id}', 'AsistenciaTurnosController@buscarLista')->name('buscarLista');
        Route::get('TurnoRutinario/Guardar/{id}', 'AsistenciaTurnosController@getAsignarTurno')->name('adicionarTurno');
        Route::get('TurnoRutinario/Guardado/', 'AsistenciaTurnosController@postAsignarTurno')->name('guardarTurno');
        Route::get('ListaTurnos', 'AsistenciaTurnosController@listaTurnos')->name('listaTurnos');
        Route::post('/updateTurno', 'AsistenciaTurnosController@updateTurno')->name('updateTurno');
        Route::get('TurnoRutinario/listaTurnos/deleteTurn', 'AsistenciaTurnosController@deleteTurn')->name('attendance.turnDelete');

        //Route::resource('turnos', 'AsistenciaTurnosController');
        //Route::resource('reports', 'ProductController')

        Route::get('/updateAttendance', 'AsistenciaTurnosController@updateAttendance')->name('updateAttendance');
        Route::get('/workAsign', 'AsistenciaTurnosController@workAsign')->name('workAsign');



        /*  Rutas del calendario - Full Calendar */
        Route::get('TurnoRutinario/calendarTurn', 'CalendarTurnController@index')->name('calendarTurno.home');
        Route::get('TurnoRutinario/calendarTurn/show', 'CalendarTurnController@show')->name('calendarTurno.mostrar');
        Route::post('TurnoRutinario/calendarTurn/create', 'CalendarTurnController@store')->name('calendarTurno.asignar');

        /* Ruta para fingerPrint de senaempresa */
        Route::get('FingerPrint/SenaEmpresa', 'FingerAsistenciaController@index')->name('fingerPrint.home');
        Route::post('FingerPrint/SenaEmpresa/import', 'FingerAsistenciaController@import')->name('fingerPrint.import');

        /* Rutas de crud de works */
        Route::resource('Work', 'WorkController')->names('work');

        Route::get('Work/edit/{id}', 'WorkController@workEdit')->name('works.edit');
        Route::post('Work/edit', 'WorkController@workUpdate')->name('works.edit');

        Route::get('Work/delete/{id}', 'WorkController@workDelete')->name('works.destroy');
        Route::post('Work/delete', 'WorkController@workDestroy')->name('works.destroy');


        //Rutas para quality
        Route::get('Nosotros/', 'QualityController@we')->name('cefa.senaempresa.nosotros');
    });
});
