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

        //RUTAS COMO ADMINISTRADOR
        Route::prefix('admin')->group(function () {
            Route::get('/', 'SENAEMPRESAController@Admin')->name('senaempresa.admin.index');
            Route::get('manual/', 'SENAEMPRESAController@manual_admin')->name('senaempresa.admin.manual_admin');

            //RUTAS PARA EL REGISTRO, LA VISUALIZACIÓN, ELIMINACIÓN Y LA ACTUALIZACIÓN DE LAS FASES DE SENAEMPRESA
            Route::prefix('phases')->group(function () {
                Route::get('/', 'PhaseSenaempresaController@phases')->name('senaempresa.admin.phases.index');
                Route::get('/new', 'PhaseSenaempresaController@new')->name('senaempresa.admin.phases.new');
                Route::post('/saved', 'PhaseSenaempresaController@saved')->name('senaempresa.admin.phases.saved');
                Route::get('/edit/{id}', 'PhaseSenaempresaController@edit')->name('senaempresa.admin.phases.edit');
                Route::post('/{id}/updated', 'PhaseSenaempresaController@updated')->name('senaempresa.admin.phases.updated');
                Route::delete('/delete/{id}', 'PhaseSenaempresaController@delete')->name('senaempresa.admin.phases.delete');


                //RUTAS PARA ASOCIAR CURSOS A LAS FASES DE SENAEMPRESA
                Route::get('/show_associates', 'PhaseSenaempresaController@show_associates')->name('senaempresa.admin.phases.show_associates');
                Route::post('/associated_course', 'PhaseSenaempresaController@associated_course')->name('senaempresa.admin.phases.associated_course');
                Route::get('/get_associations', 'PhaseSenaempresaController@get_associations')->name('senaempresa.admin.phases.get_associations');
            });

            //RUTAS PARA EL REGISTRO, LA VISUALIZACIÓN, ELIMINACIÓN Y LA ACTUALIZACIÓN DEL PERSONAL DE SENAEMPRESA
            Route::prefix('staff')->group(function () {
                Route::get('/', 'StaffSenaempresaController@staff')->name('senaempresa.admin.staff.index');
                Route::get('/new', 'StaffSenaempresaController@new')->name('senaempresa.admin.staff.new');
                Route::post('/saved', 'StaffSenaempresaController@saved')->name('senaempresa.admin.staff.saved');
                Route::get('/edit/{id}', 'StaffSenaempresaController@edit')->name('senaempresa.admin.staff.edit');
                Route::post('/{id}/updated', 'StaffSenaempresaController@updated')->name('senaempresa.admin.staff.updated');
                Route::delete('/delete/{id}', 'StaffSenaempresaController@delete')->name('senaempresa.admin.staff.delete');
            });


            //RUTAS PARA EL REGISTRO, LA VISUALIZACIÓN Y LA ACTUALIZACIÓN DE LOS PRESTAMOS EPP DE SENAEMPRESA
            Route::prefix('loans')->group(function () {
                Route::get('/', 'LoanController@loans')->name('senaempresa.admin.loans.index');
                Route::get('/generatepdf', 'LoanController@generateLoansPDF')->name('senaempresa.admin.loans.generate.pdf');
                Route::get('/new', 'LoanController@new')->name('senaempresa.admin.loans.new');
                Route::post('/saved', 'LoanController@saved')->name('senaempresa.admin.loans.saved');
                Route::get('/edit/{id}', 'LoanController@edit')->name('senaempresa.admin.loans.edit');
                Route::put('/{id}/updated', 'LoanController@updated')->name('senaempresa.admin.loans.updated');
                Route::get('/return/{id}', 'LoanController@return')->name('senaempresa.admin.loans.return');

                Route::get('inventory/', 'LoanController@inventory')->name('senaempresa.admin.loans.inventory');
                Route::get('inventory/generatepdf', 'LoanController@generateInventoryPDF')->name('senaempresa.admin.loans.generate.inventory.pdf');
            });


            //RUTAS PARA EL REGISTRO, LA VISUALIZACIÓN, ELIMINACIÓN Y LA ACTUALIZACIÓN DE LAS VACANTES DE SENAEMPRESA
            Route::prefix('vacancies')->group(function () {
                Route::get('/', 'VacantController@vacancies')->name('senaempresa.admin.vacancies.index');
                Route::get('/new', 'VacantController@new')->name('senaempresa.admin.vacancies.new');
                Route::post('/saved', 'VacantController@saved')->name('senaempresa.admin.vacancies.saved');
                Route::get('/edit/{id}', 'VacantController@edit')->name('senaempresa.admin.vacancies.edit');
                Route::post('/{id}/updated', 'VacantController@updated')->name('senaempresa.admin.vacancies.updated');
                Route::delete('/delete/{id}', 'VacantController@delete')->name('senaempresa.admin.vacancies.delete');

                //RUTAS PARA ASOCIAR CURSOS A LAS VACANTES DE SENAEMPRESA
                Route::get('/partner_course', 'VacantController@partner_course')->name('senaempresa.admin.vacancies.partner_course');
                Route::post('/show_associates', 'VacantController@show_associates')->name('senaempresa.admin.vacancies.show_associates');
                Route::get('/get_associations', 'VacantController@getAssociations')->name('senaempresa.admin.vacancies.get_associations');

                //RUTAS PARA REALIZAR LA INSCRIPCIÓN A LAS VACANTES DISPONIBLES SEGUN EL CURSO DE SENAEMPRESA
                Route::get('/inscription/{vacancy_id}', 'PostulateController@inscription')->name('senaempresa.admin.vacancies.inscription');
                Route::post('/registered', 'PostulateController@registered')->name('senaempresa.admin.vacancies.registered');
            });

            //RUTAS PARA LA VISUALIZACIÓN Y LA ASIGNACIÓN DE PUNTAJE A LOS POSTULADOS A LAS VACANTES DE SENAEMPRESA
            Route::prefix('postulates')->group(function () {
                Route::get('/', 'PostulateController@postulates')->name('senaempresa.admin.postulates.index');
                Route::get('/assign_score/{apprenticeId}/{vacancyId}', 'PostulateController@assign_score')->name('senaempresa.admin.postulates.assign_score');
                Route::post('/score_assigned', 'PostulateController@score_assigned')->name('senaempresa.admin.postulates.score_assigned');

                Route::get('/state/{apprenticeId}', 'PostulateController@state')->name('senaempresa.admin.postulates.state');
                Route::post('/state_updated', 'PostulateController@state_updated')->name('senaempresa.admin.postulates.state_updated');

                Route::get('/selected', 'PostulateController@seleccionados')->name('senaempresa.admin.postulates.selected');

                Route::get('/selected/generatepdf', 'PostulateController@generateseleccionadosPDF')->name('senaempresa.admin.postulates.selected.generatepdf');
            });

            //RUTAS PARA EL REGISTRO, LA VISUALIZACIÓN, ELIMINACIÓN Y LA ACTUALIZACIÓN DE LOS CARGOS DE SENAEMPRESA
            Route::prefix('positions')->group(function () {
                Route::get('/', 'PositionCompanyController@positions')->name('senaempresa.admin.positions.index');
                Route::get('/new', 'PositionCompanyController@new')->name('senaempresa.admin.positions.new');
                Route::post('/saved', 'PositionCompanyController@saved')->name('senaempresa.admin.positions.saved');
                Route::get('/edit/{id}', 'PositionCompanyController@edit')->name('senaempresa.admin.positions.edit');
                Route::post('/{id}/update', 'PositionCompanyController@updated')->name('senaempresa.admin.positions.updated');
                Route::delete('/delete/{id}', 'PositionCompanyController@delete')->name('senaempresa.admin.positions.delete');
            });

            //RUTAS PARA EL REGISTRO, Y LA VISUALIZACIÓN DE LAS ASISTENCIAS DEL PERSONAL DE SENAEMPRESA
            Route::prefix('attendances')->group(function () {
                Route::get('/new', 'AttendanceSenaempresaController@new')->name('senaempresa.admin.attendances.index');
                Route::post('/register', 'AttendanceSenaempresaController@register')->name('senaempresa.admin.attendances.register');
                Route::post('/load-staff-by-senaempresa', 'AttendanceSenaempresaController@loadStaffBySenaempresa')->name('senaempresa.admin.attendances.loadStaffBySenaempresa');
                Route::post('/loadAttendancesBySenaempresa', 'AttendanceSenaempresaController@loadAttendancesBySenaempresa')->name('senaempresa.admin.attendances.loadAttendancesBySenaempresa');
                Route::post('/loadReportBySenaempresa', 'AttendanceSenaempresaController@loadReportBySenaempresa')->name('senaempresa.admin.attendances.loadReportBySenaempresa');

                // Ruta para mostrar la lista de asistencias
                Route::post('/search', 'AttendanceSenaempresaController@queryAttendance')->name('senaempresa.admin.attendances.queryAttendance');
            });
        });
    });
});
