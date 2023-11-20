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
        //RUTAS COMO PASANTE
        Route::prefix('passant')->group(function () {
            Route::get('/', 'SENAEMPRESAController@Passant')->name('senaempresa.passant.index');

        //RUTAS PARA EL REGISTRO, LA VISUALIZACIÓN, ELIMINACIÓN Y LA ACTUALIZACIÓN DEL PERSONAL DE SENAEMPRESA
        Route::prefix('staff')->group(function () {
            Route::get('/', 'StaffSenaempresaController@staff')->name('senaempresa.passant.staff.index');
        });

        //RUTAS PARA EL REGISTRO, LA VISUALIZACIÓN Y LA ACTUALIZACIÓN DE LOS PRESTAMOS EPP DE SENAEMPRESA
        Route::prefix('loans')->group(function () {
            Route::get('/', 'LoanController@loans')->name('senaempresa.passant.loans.index');
            Route::get('/new', 'LoanController@new')->name('senaempresa.passant.loans.new');
            Route::post('/saved', 'LoanController@saved')->name('senaempresa.passant.loans.saved');
            Route::get('/edit/{id}', 'LoanController@edit')->name('senaempresa.passant.loans.edit');
            Route::put('/{id}/updated', 'LoanController@updated')->name('senaempresa.passant.loans.updated');
            Route::get('/return/{id}', 'LoanController@return')->name('senaempresa.passant.loans.return');
        });

        //RUTAS PARA EL REGISTRO, LA VISUALIZACIÓN, ELIMINACIÓN Y LA ACTUALIZACIÓN DE LAS VACANTES DE SENAEMPRESA
        Route::prefix('vacancies')->group(function () {
            Route::get('/', 'VacantController@vacancies')->name('senaempresa.passant.vacancies.index');
        
        });

        //RUTAS PARA EL REGISTRO, Y LA VISUALIZACIÓN DE LAS ASISTENCIAS DEL PERSONAL DE SENAEMPRESA
        Route::prefix('attendances')->group(function () {
            Route::get('/new', 'AttendanceSenaempresaController@new')->name('senaempresa.passant.attendances.index');
            Route::post('/register', 'AttendanceSenaempresaController@register')->name('senaempresa.passant.attendances.register');

            // Ruta para mostrar la lista de asistencias
            Route::post('/search', 'AttendanceSenaempresaController@queryAttendance')->name('senaempresa.passant.attendances.queryAttendance');
            Route::post('/getPersonData', 'AttendanceSenaempresaController@getPersonData')->name('senaempresa.passant.attendances.getPersonData');
        });
        });
    });
});
