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

        //RUTAS COMO APRENDIZ
        Route::prefix('apprentice')->group(function () {
            Route::get('/', 'SENAEMPRESAController@Apprentice')->name('senaempresa.apprentice.index');
            Route::get('manual/', 'SENAEMPRESAController@manual_apprentice')->name('senaempresa.apprentice.manual_apprentice');

            //RUTAS PARA EL REGISTRO, LA VISUALIZACIÓN, ELIMINACIÓN Y LA ACTUALIZACIÓN DEL PERSONAL DE SENAEMPRESA
            Route::prefix('staff')->group(function () {
                Route::get('/', 'StaffSenaempresaController@staff')->name('senaempresa.apprentice.staff.index');
            });

            //RUTAS PARA EL REGISTRO, LA VISUALIZACIÓN Y LA ACTUALIZACIÓN DE LOS PRESTAMOS EPP DE SENAEMPRESA
            Route::prefix('loans')->group(function () {
                Route::get('/', 'LoanController@loans')->name('senaempresa.apprentice.loans.index');
            });

            //RUTAS PARA EL REGISTRO, LA VISUALIZACIÓN, ELIMINACIÓN Y LA ACTUALIZACIÓN DE LAS VACANTES DE SENAEMPRESA
            Route::prefix('vacancies')->group(function () {
                Route::get('/', 'VacantController@vacancies')->name('senaempresa.apprentice.vacancies.index');

                //RUTAS PARA REALIZAR LA INSCRIPCIÓN A LAS VACANTES DISPONIBLES SEGUN EL CURSO DE SENAEMPRESA
                Route::get('/inscription/{vacancy_id}', 'PostulateController@inscription')->name('senaempresa.apprentice.vacancies.inscription');
                Route::post('/registered', 'PostulateController@registered')->name('senaempresa.apprentice.vacancies.registered');
            });

            //RUTAS PARA LA VISUALIZACIÓN DE LAS ASISTENCIAS DEL PERSONAL DE SENAEMPRESA
            Route::prefix('attendances')->group(function () {
                Route::get('/new', 'AttendanceSenaempresaController@new')->name('senaempresa.apprentice.attendances.index');

                // Ruta para mostrar la lista de asistencias
                Route::post('/search', 'AttendanceSenaempresaController@queryAttendance')->name('senaempresa.apprentice.attendances.queryAttendance');
                Route::post('/getPersonData', 'AttendanceSenaempresaController@getPersonData')->name('senaempresa.apprentice.attendances.getPersonData');
            });
            //RUTAS PARA LA VISUALIZACIÓN Y LA ASIGNACIÓN DE PUNTAJE A LOS POSTULADOS A LAS VACANTES DE SENAEMPRESA
            Route::prefix('postulates')->group(function () {
                Route::get('/state_apprentice', 'PostulateController@postulations')->name('senaempresa.apprentice.postulates.state_apprentice');
            });
        });
    });
});
