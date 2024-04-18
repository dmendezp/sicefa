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
        //RUTAS COMO LIDER TALENTO HUMANO
        Route::prefix('human_talent_leader')->group(function () {
            Route::get('/', 'SENAEMPRESAController@human_talent_leader')->name('senaempresa.human_talent_leader.index');
            Route::get('manual/', 'SENAEMPRESAController@manual_human_talent_leader')->name('senaempresa.human_talent_leader.manual_human_talent_leader');

        //RUTAS PARA EL REGISTRO, LA VISUALIZACIÓN, ELIMINACIÓN Y LA ACTUALIZACIÓN DEL PERSONAL DE SENAEMPRESA
        Route::prefix('staff')->group(function () {
            Route::get('/', 'StaffSenaempresaController@staff')->name('senaempresa.human_talent_leader.staff.index');
        });

        //RUTAS PARA EL REGISTRO, LA VISUALIZACIÓN Y LA ACTUALIZACIÓN DE LOS PRESTAMOS EPP DE SENAEMPRESA
        Route::prefix('loans')->group(function () {
            Route::get('/', 'LoanController@loans')->name('senaempresa.human_talent_leader.loans.index');
            Route::get('/generatepdf', 'LoanController@generateLoansPDF')->name('senaempresa.human_talent_leader.loans.generate.pdf');
            Route::get('/new', 'LoanController@new')->name('senaempresa.human_talent_leader.loans.new');
            Route::post('/saved', 'LoanController@saved')->name('senaempresa.human_talent_leader.loans.saved');
            Route::get('/edit/{id}', 'LoanController@edit')->name('senaempresa.human_talent_leader.loans.edit');
            Route::put('/{id}/updated', 'LoanController@updated')->name('senaempresa.human_talent_leader.loans.updated');
            Route::get('/return/{id}', 'LoanController@return')->name('senaempresa.human_talent_leader.loans.return');
        });

        //RUTAS PARA EL REGISTRO, LA VISUALIZACIÓN, ELIMINACIÓN Y LA ACTUALIZACIÓN DE LAS VACANTES DE SENAEMPRESA
        Route::prefix('vacancies')->group(function () {
            Route::get('/', 'VacantController@vacancies')->name('senaempresa.human_talent_leader.vacancies.index');

        });

        //RUTAS PARA EL REGISTRO, Y LA VISUALIZACIÓN DE LAS ASISTENCIAS DEL PERSONAL DE SENAEMPRESA
        Route::prefix('attendances')->group(function () {
            Route::get('/new', 'AttendanceSenaempresaController@new')->name('senaempresa.human_talent_leader.attendances.index');
            Route::post('/register', 'AttendanceSenaempresaController@register')->name('senaempresa.human_talent_leader.attendances.register');
            Route::post('/load-staff-by-senaempresa', 'AttendanceSenaempresaController@loadStaffBySenaempresa')->name('senaempresa.human_talent_leader.attendances.loadStaffBySenaempresa');
            Route::post('/loadAttendancesBySenaempresa', 'AttendanceSenaempresaController@loadAttendancesBySenaempresa')->name('senaempresa.human_talent_leader.attendances.loadAttendancesBySenaempresa');
            Route::post('/loadReportBySenaempresa', 'AttendanceSenaempresaController@loadReportBySenaempresa')->name('senaempresa.human_talent_leader.attendances.loadReportBySenaempresa');

            // Ruta para mostrar la lista de asistencias
            Route::post('/search', 'AttendanceSenaempresaController@queryAttendance')->name('senaempresa.human_talent_leader.attendances.queryAttendance');
        });


        });
    });
});
