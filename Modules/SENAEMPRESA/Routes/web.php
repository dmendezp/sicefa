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

        //RUTAS PARA EL REGISTRO, LA VISUALIZACIÓN, ELIMINACIÓN Y LA ACTUALIZACIÓN DE LAS ESTRATEGIAS DE SENAEMPRESA
        Route::prefix('Estrategias')->group(function () {
            Route::get('/', 'SENAEMPRESAController@senaempresa')->name('company.senaempresa.senaempresa');
            Route::get('/Nueva', 'SENAEMPRESAController@new_senaempresa')->name('company.senaempresa.new_senaempresa');
            Route::post('/Guardada', 'SENAEMPRESAController@senaempresa_new')->name('company.senaempresa.senaempresa_new');
            Route::get('/Editar/{id}', 'SENAEMPRESAController@edit_senaempresa')->name('company.senaempresa.edit_senaempresa');
            Route::post('/{id}/Actualizado', 'SENAEMPRESAController@senaempresa_edit')->name('company.senaempresa.senaempresa_edit');
            Route::delete('/Eliminado/{id}', 'SENAEMPRESAController@delete_senaempresa')->name('company.senaempresa.delete_senaempresa');

            //RUTAS PARA ASOCIAR CURSOS A LAS ESTRATEGIAS DE SENAEMPRESA
            Route::get('/Mostrar_Curso', 'SENAEMPRESAController@courses_senaempresa')->name('company.senaempresa.courses_senaempresa');
            Route::post('/Curso_Asociado', 'SENAEMPRESAController@courses_associates_senaempresa')->name('company.senaempresa.courses_associates_senaempresa');
            Route::get('/Obtener_asociaciones', 'SENAEMPRESAController@getAssociation')->name('company.senaempresa.get_associations');
        });

        //RUTAS PARA EL REGISTRO, LA VISUALIZACIÓN, ELIMINACIÓN Y LA ACTUALIZACIÓN DEL PERSONAL DE SENAEMPRESA
        Route::prefix('Personal')->group(function () {
            Route::get('/', 'StaffSenaempresaController@mostrar_personal')->name('company.senaempresa.personal');
            Route::get('/Nuevo', 'StaffSenaempresaController@nuevo_personal')->name('company.senaempresa.nuevo_personal');
            Route::post('/Guardado', 'StaffSenaempresaController@personal_nuevo')->name('company.senaempresa.personal_nuevo');
            Route::get('/Editar/{id}', 'StaffSenaempresaController@editar_personal')->name('company.senaempresa.editar_personal');
            Route::post('/{id}/Actualizado', 'StaffSenaempresaController@personal_editado')->name('company.senaempresa.personal_editado');
            Route::delete('/Eliminado/{id}', 'StaffSenaempresaController@destroy')->name('company.senaempresa.eliminar_personal');
        });

        //RUTAS PARA EL REGISTRO, LA VISUALIZACIÓN Y LA ACTUALIZACIÓN DE LOS PRESTAMOS EPP DE SENAEMPRESA
        Route::prefix('Prestamos')->group(function () {
            Route::get('/', 'LoanController@index')->name('company.loan.prestamos');
            Route::get('/Nuevo', 'LoanController@register')->name('company.loan.Nuevo');
            Route::post('/Guardado', 'LoanController@prestamo_nuevo')->name('company.loan.prestamo_nuevo');
            Route::get('/Editar/{id}', 'LoanController@editar')->name('company.loan.editar');
            Route::put('/{id}/Actualizado', 'LoanController@update')->name('company.loan.update');
            Route::get('/Devolver_prestamo/{id}', 'LoanController@devolver_prestamo')->name('company.loan.devolver_prestamo');
        });

        //RUTAS PARA EL REGISTRO, LA VISUALIZACIÓN, ELIMINACIÓN Y LA ACTUALIZACIÓN DE LAS VACANTES DE SENAEMPRESA
        Route::prefix('Vacantes')->group(function () {
            Route::get('/', 'VacantController@vacantes')->name('company.vacant.vacantes');
            Route::get('/Nueva', 'VacantController@agregar_vacante')->name('company.vacant.agregar_vacante');
            Route::post('/Guardada', 'VacantController@store')->name('company.vacant.nueva_vacante');
            Route::get('/Editar/{id}', 'VacantController@edit')->name('company.vacant.editar_vacante');
            Route::post('/{id}/Actualizada', 'VacantController@update')->name('company.vacant.vacante_editado');
            Route::delete('/Eliminado/{id}', 'VacantController@destroy')->name('company.vacant.eliminar_vacante');

            //RUTAS PARA ASOCIAR CURSOS A LAS VACANTES DE SENAEMPRESA
            Route::get('/Mostrar_Curso', 'VacantController@mostrar_asociados')->name('company.vacant.mostrar_asociados');
            Route::post('/Curso_Asociado', 'VacantController@curso_asociado')->name('company.vacant.curso_asociado');
            Route::get('/Obtener_asociaciones', 'VacantController@getAssociations')->name('company.vacant.get_associations');

            //RUTAS PARA REALIZAR LA INSCRIPCIÓN A LAS VACANTES DISPONIBLES SEGUN EL CURSO DE SENAEMPRESA
            Route::get('Vacantes/Inscripción/{vacancy_id}', 'PostulateController@inscription')->name('inscription');
            Route::post('Vacantes/Inscripción_Exitosa/', 'PostulateController@store')->name('company.postulate.store');
        });

        //RUTAS PARA LA VISUALIZACIÓN Y LA ASIGNACIÓN DE PUNTAJE A LOS POSTULADOS A LAS VACANTES DE SENAEMPRESA
        Route::prefix('Postulados')->group(function () {
            Route::get('/', 'PostulateController@postulates')->name('company.postulate');
            Route::get('/Asignar_puntaje/{apprenticeId}', 'FileSenaempresaController@score')->name('company.postulate.score');
            Route::post('/Puntaje_Asignado', 'FileSenaempresaController@assignScore')->name('company.postulate.score_asignado');
        });

        //RUTAS PARA EL REGISTRO, LA VISUALIZACIÓN, ELIMINACIÓN Y LA ACTUALIZACIÓN DE LOS CARGOS DE SENAEMPRESA
        Route::prefix('Cargos')->group(function () {
            Route::get('/', 'PositionCompanyController@cargar')->name('company.position.cargos');
            Route::get('/Nuevo', 'PositionCompanyController@registro')->name('company.position.nuevo_cargo');
            Route::post('/Guardado', 'PositionCompanyController@store')->name('company.position.cargo_nuevo');
            Route::get('/Editar/{id}', 'PositionCompanyController@edit')->name('company.position.editar_cargo');
            Route::post('/{id}/Actualizado', 'PositionCompanyController@update')->name('company.position.cargo_editado');
            Route::delete('/Eliminado/{id}', 'PositionCompanyController@destroy')->name('company.position.eliminar_cargo');
        });

        //RUTAS PARA EL REGISTRO, Y LA VISUALIZACIÓN DE LAS ASISTENCIAS DEL PERSONAL DE SENAEMPRESA
        Route::prefix('Asistencias')->group(function () {
            Route::get('/Registrar_asistencias', 'AttendanceSenaempresaController@showAttendanceList')->name('company.asistencia');
            Route::post('/Registrada', 'AttendanceSenaempresaController@registerAttendance')->name('attendance.register');

            // Ruta para mostrar la lista de asistencias
            Route::post('/Buscar_Asistencia', 'AttendanceSenaempresaController@queryAttendance')->name('queryAttendance');
            Route::post('/Obtener_datos', 'AttendanceSenaempresaController@getPersonData')->name('getPersonData');
        });

        Route::get('/score/{postulateId}', 'PostulateController@score_save');
    });
});
