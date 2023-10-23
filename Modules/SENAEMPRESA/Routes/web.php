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
        Route::get('Contactos/', 'CompanyController@contact')->name('company.contact');
        Route::get('Postulados/Seleccionados/', 'CompanyController@seleccionados')->name('cefa.seleccionados');

        //Rutas para senaempresa
        Route::get('Estrategias/', 'SENAEMPRESAController@senaempresa')->name('company.senaempresa');
        Route::get('Estrategias/Nueva', 'SENAEMPRESAController@agregar')->name('company.senaempresa.agrega');
        Route::post('Estrategias/Nueva', 'SENAEMPRESAController@store')->name('company.senaempresa.guardado');
        Route::get('Estrategias/{id}/editar', 'SENAEMPRESAController@edit')->name('company.senaempresa.editarlo');
        Route::post('Estrategias{id}/actualizar', 'SENAEMPRESAController@update')->name('company.senaempresa.guardar_senaempresa');
        Route::delete('Estrategias/delete/{id}', 'SENAEMPRESAController@destroy')->name('company.senaempresa.eliminar_senaempresa');

        //Rutas para asociar cursos a senaempresa estrategias

        Route::get('Estrategias/Mostrar_Curso/', 'SENAEMPRESAController@mostrar_asociado')->name('company.senaempresa.mostrar_asociados_senaempresa');
        Route::post('Estrategias/Curso_Asociado/', 'SENAEMPRESAController@curso_asociado_senaempresa')->name('company.senaempresa.curso_asociado_senaempresa');
        Route::get('/company/senaempresa/get_associations', 'SENAEMPRESAController@getAssociation')->name('company.senaempresa.get_associations');

        //rutas de personal de senaempresa
        Route::get('Personal/', 'StaffSenaempresaController@mostrar_personal')->name('company.senaempresa.personal');
        Route::get('Personal/Nueva', 'StaffSenaempresaController@nuevo_personal')->name('company.senaempresa.nuevo_personal');
        Route::post('Personal/Nueva', 'StaffSenaempresaController@personal_nuevo')->name('company.senaempresa.personal_nuevo');
        Route::get('Personal/{id}/editar', 'StaffSenaempresaController@editar_personal')->name('company.senaempresa.editar_personal');
        Route::post('Personal/{id}/actualizar', 'StaffSenaempresaController@personal_editado')->name('company.senaempresa.personal_editado');
        Route::delete('Personal/delete/{id}', 'StaffSenaempresaController@destroy')->name('company.senaempresa.eliminar_personal');

        //Prestamos
        Route::get('Prestamos/', 'LoanController@index')->name('company.loan.prestamos');
        Route::get('Prestamos/Nuevo/', 'LoanController@register')->name('company.loan.Nuevo');
        Route::post('Prestamos/Prestamo_Nuevo/', 'LoanController@prestamo_nuevo')->name('company.loan.prestamo_nuevo');
        Route::get('Prestamos/edit/{id}', 'LoanController@editar')->name('company.loan.editar');
        Route::put('Prestamos/loan/update/{id}', 'LoanController@update')->name('company.loan.update');
        Route::get('Prestamos/devolver_prestamo/{id}', 'LoanController@devolver_prestamo')->name('company.loan.devolver_prestamo');

        //Inscripciones a vacantes
        Route::get('Vacantes/Inscripción/', 'PostulateController@inscription')->name('inscription');
        Route::post('Vacantes/Inscripción_Exitosa/', 'PostulateController@store')->name('company.postulate.store');

        //Postulados
        Route::get('Postulados/', 'PostulateController@postulates')->name('company.postulate');
        Route::get('Postulados/Score/{apprenticeId}', 'PostulateController@score')->name('company.postulate.score');
        Route::post('Postulados/Score/Puntaje_Asignado', 'PostulateController@assignScore')->name('company.postulate.score_asignado');





        //Rutas de vacantes
        Route::get('Vacantes/', 'VacantController@vacantes')->name('company.vacant.vacantes');
        Route::get('Vacantes/Agregar_Vacante/', 'VacantController@agregar_vacante')->name('company.vacant.agregar_vacante');
        Route::post('Vacantes/Nueva_Vacante/', 'VacantController@store')->name('company.vacant.nueva_vacante');
        Route::get('Vacantes/{id}/Editar_Vacante/', 'VacantController@edit')->name('company.vacant.editar_vacante');
        Route::post('Vacantes/Vacante_Editado/{id}/', 'VacantController@update')->name('company.vacant.vacante_editado');
        Route::delete('Vacantes/eliminar_vacante/{id}', 'VacantController@destroy')->name('company.vacant.eliminar_vacante');

        //Asociar curso a vacante
        Route::get('Vacantes/Mostrar_Curso', 'VacantController@mostrar_asociados')->name('company.vacant.mostrar_asociados');
        Route::post('Vacantes/Curso_Asociado', 'VacantController@curso_asociado')->name('company.vacant.curso_asociado');
        Route::get('/company/vacant/get_associations', 'VacantController@getAssociations')->name('company.vacant.get_associations');




        //rutas para cargo;

        //
        Route::get('Cargos/', 'PositionCompanyController@cargar')->name('company.position.cargos');
        Route::get('Cargos/Nueva', 'PositionCompanyController@registro')->name('company.position.nuevo_cargo');
        Route::post('Cargos/Nueva', 'PositionCompanyController@store')->name('company.position.cargo_nuevo');
        Route::get('Cargos/{id}/editar', 'PositionCompanyController@edit')->name('company.position.editar_cargo');
        Route::post('Cargos/{id}/actualizar', 'PositionCompanyController@update')->name('company.position.cargo_editado');
        Route::delete('cargos/delete/{id}', 'PositionCompanyController@destroy')->name('company.position.eliminar_cargo');


        Route::get('/registrar-asistencia', 'AttendanceSenaempresaController@showAttendanceList')->name('company.asistencia');

        // Ruta para procesar el registro de asistencia
        Route::post('/registrar-asistencia', 'AttendanceSenaempresaController@registerAttendance')->name('attendance.register');

        // Ruta para mostrar la lista de asistencias
        Route::get('/asistencias', 'AttendanceSenaempresaController@showAttendanceList')->name('attendance.list');
        Route::post('/obtener-datos-de-persona', 'AttendanceSenaempresaController@getPersonData')->name('getPersonData');

        Route::get('/score/{postulateId}', 'PostulateController@score_save');
    });
});
