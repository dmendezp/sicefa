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



Route::middleware(['lang'])->group(function () {
    //Route::middleware(['lang'])->group(function(){
    Route::prefix('senaempresa')->group(function () {
        Route::get('index/', 'SENAEMPRESAController@index')->name('senamepresa.index');
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
        Route::get('Nosotros/', 'QualityController@we')->name('cefa.Nosotros');

        //Rutas para company
        Route::get('Contactos/', 'CompanyController@contact')->name('cefa.Contactos');
        Route::get('Postulados/', 'CompanyController@vacant')->name('cefa.Postulados');
        Route::get('Postulados/Seleccionados/', 'CompanyController@seleccionados')->name('cefa.seleccionados');

        //Prestamos
        Route::get('Prestamos/', 'LoanController@register')->name('cefa.prestamos');
        Route::get('Prestamos/Nuevo/', 'LoanController@new')->name('cefa.Nuevo');
        Route::post('Prestamos/Prestamo_Nuevo/', 'LoanController@prestamo_nuevo')->name('cefa.prestamo_nuevo');
        Route::get('Prestamos/devolver_prestamo/{id}', 'LoanController@devolver_prestamo')->name('cefa.devolver_prestamo');


        //Inscripciones a vacantes
        Route::get('Vacantes/Inscripción/', 'InscriptionController@inscription')->name('inscription');

        //Rutas de vacantes
        Route::get('Vacantes/', 'VacantController@vacantes')->name('cefa.vacantes');
        Route::get('Vacantes/Agregar_Vacante/', 'VacantController@agregar_vacante')->name('cefa.agregar_vacante');
        Route::post('Vacantes/Nueva_Vacante/', 'VacantController@store')->name('cefa.nueva_vacante');
        Route::get('Vacantes/{id}/Editar_Vacante/', 'VacantController@edit')->name('cefa.editar_vacante');
        Route::post('Vacantes/Vacante_Editado/{id}/', 'VacantController@update')->name('cefa.vacante_editado');
        Route::delete('Vacantes/eliminar_vacante/{id}', 'VacantController@destroy')->name('cefa.eliminar_vacante');

        //Asociar curso a vacante
        Route::get('Vacantes/Asociar_Curso/', 'VacantController@asociar_curso')->name('cefa.asociar_curso');
        Route::post('Vacantes/Curso_Asociado/', 'VacantController@curso_asociado')->name('cefa.curso_asociado');
        Route::get('Vacantes/Mostrar_Curso/', 'VacantController@mostrar_asociados')->name('cefa.mostrar_asociados');
        Route::delete('/eliminar_asociacion', 'VacantController@eliminarAsociacion')->name('cefa.eliminar_asociacion');


    //Rutas para senaempresa 
    Route::get('Estrategias/', 'SENAEMPRESAController@senaempresa')->name('cefa.senaempresa');
    Route::get('Estrategias/Nueva', 'SENAEMPRESAController@agregar')->name('cefa.agrega');
    Route::post('Estrategias/Nueva', 'SENAEMPRESAController@store')->name('cefa.nuevos');
    Route::get('Estrategias/{id}/editar', 'SENAEMPRESAController@edit')->name('cefa.editarlo');
    Route::post('Estrategias{id}/actualizar', 'SENAEMPRESAController@update')->name('cefa.guardar_senaempresa');
    Route::delete('Estrategias/delete/{id}', 'SENAEMPRESAController@destroy')->name('cefa.eliminar_senaempresa');



        //Rutas para asociar cursos a senaempresa estrategias
        Route::get('Estrategias/Asociar_Curso/', 'SENAEMPRESAController@cursos_senamepresa')->name('cefa.cursos_senaempresa');
        Route::post('Estrategias/Curso_Asociado/', 'SENAEMPRESAController@curso_asociado_senaempresa')->name('cefa.curso_asociado_senaempresa');
        Route::get('Estrategias/Mostrar_Curso/', 'SENAEMPRESAController@mostrar_asociado')->name('cefa.mostrar_asociados_senaempresa');
        Route::delete('Estrategias/eliminar_asociacion', 'SENAEMPRESAController@eliminar_asociacion_empresa')->name('cefa.eliminar_asociacion_empresa');



        //rutas para cargo;
        Route::get('Cargos/', 'PositionCompanyController@cargar')->name('cefa.cargos');
        Route::get('Cargos/Nueva', 'PositionCompanyController@registro')->name('cefa.nuevo_cargo');
        Route::post('Cargos/Nueva', 'PositionCompanyController@store')->name('cefa.cargo_nuevo');
        Route::get('Cargos/{id}/editar', 'PositionCompanyController@edit')->name('cefa.editar_cargo');
        Route::post('Cargos/{id}/actualizar', 'PositionCompanyController@update')->name('cefa.cargo_editado');
        Route::delete('cargos/delete/{id}', 'PositionCompanyController@destroy')->name('cefa.eliminar_cargo');


        //rutas de personal de senaempresa
        Route::get('Personal/', 'StaffSenaempresaController@mostrar_personal')->name('cefa.personal');
        Route::get('Personal/Nueva', 'StaffSenaempresaController@nuevo_personal')->name('cefa.nuevo_personal');
        Route::post('Personal/Nueva', 'StaffSenaempresaController@personal_nuevo')->name('cefa.personal_nuevo');
        Route::get('Personal/{id}/editar', 'StaffSenaempresaController@editar_personal')->name('cefa.editar_personal');
        Route::post('Personal/{id}/actualizar', 'StaffSenaempresaController@personal_editado')->name('cefa.personal_editado');
        Route::delete('Personal/delete/{id}', 'StaffSenaempresaController@destroy')->name('cefa.eliminar_personal');
    });
});
