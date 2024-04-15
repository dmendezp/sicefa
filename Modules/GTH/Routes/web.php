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

    Route::prefix('gth')->group(function () {

        Route::get('/index', 'GTHController@index')->name('cefa.index.view');
        Route::get('/admin', 'GTHController@index')->name('gth.admin.index');
        Route::get('/attendanceregister', 'GTHController@viewregisterattendance')->name('gth.registerattendance.registerattendance.index');

        // Type_employee
        Route::get('/employeetypes', 'EmployeeTypController@viewemployeetypes')->name('gth.admin.employeetypes.index'); //nombres de la vista
        Route::get('/employeetypes/create', 'EmployeeTypController@getcreateemployeetypes')->name('cefa.gth.employeetypes.create');
        Route::post('/employeetypes/create', 'EmployeeTypController@postcreateemployeetypes')->name('cefa.gth.employeetypes.create');
        Route::delete('/gth/employeetypes/{id}/delete', 'EmployeeTypController@deleteEmployeeType')->name('cefa.gth.employeetypes.delete');
        Route::patch('/gth/employeetypes/update{id}', 'EmployeeTypController@updateeemployeetypes')->name('cefa.gth.employeetypes.update');
        Route::get('gth/employeetypes/{id}', 'EmployeeTypController@showEmployeeType')->name('cefa.gth.employeetypes.show');



        // Type_contractor
        Route::get('/contractortypes', 'ContractTypController@viewcontractortypes')->name('gth.admin.contractortypes.index'); //nombres de la vista
        Route::post('/contractortypes/create', 'ContractTypController@postcreatecontractortypes')->name('cefa.gth.contractortypes.create');
        Route::delete('/gth/contractortypes/{id}/delete', 'ContractTypController@deleteContractorTypes')->name('cefa.gth.contractortypes.delete');
        Route::patch('/gth/contractortypes/update{id}', 'ContractTypController@updatecontractortypes')->name('cefa.gth.contractortypes.update');
        Route::get('gth/contractortypes/{id}', 'ContractTypController@showContractorTypes')->name('cefa.gth.contractortypes.show');

        // insurer_entities
        Route::get('/insurerentities', 'InsurerEntitiesController@viewinsurerentities')->name('gth.admin.insurerentities.index'); //nombres de la vista
        Route::post('/insurerentities/create', 'InsurerEntitiesController@postcreateinsurerentities')->name('cefa.gth.insurerentities.create');
        Route::delete('/gth/insurerentities/{id}/delete', 'InsurerEntitiesController@deleteInsurerEntities')->name('cefa.gth.insurerentities.delete');
        Route::patch('/gth/insurerentities/update{id}', 'InsurerEntitiesController@updateinsurerentities')->name('cefa.gth.insurerentities.update');
        Route::get('gth/insurerentities/{id}', 'InsurerEntitiesController@showInsurerEntities')->name('cefa.gth.insurerentities.show');

        // pension_entities
        Route::get('/pensionentities', 'PensionEntitiesController@viewpensionentities')->name('gth.admin.pensionentities.index'); //nombres de la vista
        Route::post('/pensionentities/create', 'PensionEntitiesController@postcreatepensionentities')->name('cefa.gth.pensionentities.create');
        Route::delete('/gth/pensionentities/{id}/delete', 'PensionEntitiesController@deletePensionEntities')->name('cefa.gth.pensionentities.delete');
        Route::patch('/gth/pensionentities/update{id}', 'PensionEntitiesController@updatepensionentities')->name('cefa.gth.pensionentities.update');
        Route::get('gth/pensionentities/{id}', 'PensionEntitiesController@showPensionEntities')->name('cefa.gth.pensionentities.show');

        //Contract_report
        Route::get('/contractreports', 'ContractReportController@viewcontractreports')->name('gth.admin.contractreports.index');
        Route::post('/contractreports', 'ContractReportController@create')->name('cefa.gth.contractreports.store');
        Route::get('/get-person-data', 'ContractReportController@getPersonData')->name('cefa.gth.getPersonData');

        //Contractors
        Route::get('/contractors', 'ContractorsController@viewcontractor')->name('gth.admin.contractors.index');
        Route::post('/contractors/create', 'ContractorsController@postcreatecontractor')->name('cefa.gth.contractor.create');
        Route::delete('/gth/contractors/{id}/delete', 'ContractorsController@deleteContractor')->name('cefa.gth.contractor.delete');
        Route::patch('/gth/contractors/update{id}', 'ContractorsController@updatecontractor')->name('cefa.gth.contractor.update');
        Route::get('gth/contractors/{id}', 'ContractorsController@showContractor')->name('cefa.gth.contractor.show');

        //Posicion
        Route::get('/positions', 'PositionsController@viewpositions')->name('gth.admin.position.index'); //nombres de la vista
        Route::post('/positions/create', 'PositionsController@postcreatepositions')->name('cefa.gth.positions.create');
        Route::delete('/gth/positions/{id}/delete', 'PositionsController@deletepositions')->name('cefa.gth.positions.delete');
        Route::patch('/gth/positions/update/{id}', 'PositionsController@updatepositions')->name('cefa.gth.positions.update');
        Route::get('gth/positions/{id}', 'PositionsController@showPositions')->name('cefa.gth.positions.show');

        //officials
        Route::get('/official', 'OfficialController@viewofficials')->name('gth.admin.officials.index');
        Route::get('/obtener_datos', 'OfficialController@getPersonDatas')->name('cefa.gth.getPersonDatas');
        Route::post('/employees', 'OfficialController@store')->name('cefa.gth.store');
        Route::post('/official/edit/{id}', 'OfficialController@edit_official')->name('cefa.gth.officials.update');
        Route::delete('/gth/officials/{id}/delete', 'OfficialController@deleteofficials')->name('cefa.gth.officials.delete');

        //brigader
        Route::get('/brigade', 'BrigadeController@viewbrigader')->name('gth.admin.brigader.index');
        Route::get('/asistencia', 'BrigadeController@viewAsistencia')->name ('cefa.gth.brigade.asistencia');
        Route::get('/reporte', 'BrigadeController@generateReport')->name('cefa.brigade.reporte');

        //Contractual Certificate
        Route::get('/contractualcertificate', 'ContractualCertificateController@viewcontractualcertificate')->name('cefa.contractualcertificate.view');
        Route::post('/contractualcertificate/search', 'ContractualCertificateController@search')->name('cefa.contractualcertificate.search');
        Route::get('/contractualcertificate/pdf/{id}', 'ContractualCertificateController@pdf')->name('cefa.contractualcertificate.pdf');

        //User manual
        Route::get('/usermanual', 'UserManualController@viewusermanual')->name('cefa.usermanual.view');

        // Attendance
        Route::get('/attendance', 'AttendanceController@viewattendance')->name('gth.registerattendance.attendancecourse.index');
        Route::post('/attendance/search', 'AttendanceController@search')->name('cefa.attendance.search');

        // Attendance Report
        Route::get('/attendancereport', 'AttendanceReportController@viewattendancereport')->name('gth.brigadista.attendancereport.index');

        //Register Attendance
        Route::get('/registerattendance', 'RegisterAttendanceController@registerattendance')->name('cefa.registerattendance.store');
    });
});

