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



//Route::middleware(['lang'])->group(function(){
Route::prefix('senaempresa')->group(function () {
    Route::get('index/', 'SENAEMPRESAController@index')->name('index');
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
    Route::get('Nosotros/', 'QualityController@we')->name('Nosotros');

    //Rutas para company
    Route::get('Contactos/', 'CompanyController@contact')->name('Contactos');
    Route::get('Postulados/', 'CompanyController@vacant')->name('Postulados');
    Route::get('Postulados/Seleccionados/', 'CompanyController@seleccionados')->name('seleccionados');

    //Prestamos
    Route::get('Prestamos/Nuevo/', 'LoanController@new')->name('Nuevo');
    Route::get('Prestamos/Registrados/', 'LoanController@register')->name('Registrados');

    //Inscripciones a vacantes
    Route::get('Vacantes/Inscripción/', 'InscriptionController@inscription')->name('inscription');

    //Rutas de vacantes
    Route::get('Vacantes/', 'VacantController@vacantes')->name('vacantes');
    Route::get('Vacantes/Agregar_Vacante/', 'VacantController@registration')->name('agregar_vacante');
    Route::post('Vacantes/Nueva_Vacante/', 'VacantController@store')->name('nueva_vacante');


    Route::get('Vacantes/{id}/Editar_Vacante/', 'VacantController@edit')->name('editar_vacante');
    Route::post('Vacantes/Vacante_Editado/{id}/', 'VacantController@update')->name('vacante_editado');
    Route::delete('Vacantes/delete/{id}', 'VacantController@destroy')->name('eliminar_vacante');

    //Asociar curso a vacante
    Route::get('Vacantes/Asociar_Curso/', 'VacantController@asociar_curso')->name('asociar_curso');
    Route::post('Vacantes/Curso_Asociado/', 'VacantController@curso_asociado')->name('curso_asociado');

    //Rutas para senaempresa estrategias
    Route::get('Estrategias/', 'SENAEMPRESAController@senaempresa')->name('senaempresa');

    //rutas para cargo;
    Route::get('Cargos/', 'PositionCompanyController@cargar')->name('carga');
    Route::get('Cargos/Nueva', 'PositionCompanyController@registro')->name('registro');
    Route::post('Cargos/Nueva', 'PositionCompanyController@store')->name('Nueva');
    Route::get('Cargos/{id}/editar', 'PositionCompanyController@edit')->name('editar_cargo');
    Route::post('Cargos/{id}/actualizar', 'PositionCompanyController@update')->name('guardar_actualizacion');
    Route::delete('cargos/delete/{id}', 'PositionCompanyController@destroy')->name('eliminar_cargo');


    //rutas de personal de senaempresa
    Route::get('Personal/', 'StaffSenaempresaController@Per')->name('personal');
    Route::get('Personal/Nueva', 'StaffSenaempresaController@registro')->name('registro');
    Route::post('Personal/Nueva', 'StaffSenaempresaController@store')->name('Nuevo');

});
