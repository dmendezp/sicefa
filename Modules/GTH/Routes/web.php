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
        Route::get('/attendance', 'GTHController@viewattendance')->name('cefa.attendance.view');
        Route::get('/attendanceregister', 'GTHController@viewregisterattendance')->name('cefa.reattendance.view');
        Route::get('/contractualcertificate', 'GTHController@viewcontractualcertificate')->name('cefa.contractualcertificates.view');

        // Type_employee
        Route::get('/employeetypes', 'EmployeeTypController@viewemployeetypes')->name('cefa.gth.employeetypes.view'); //nombres de la vista
        Route::get('/employeetypes/create', 'EmployeeTypController@getcreateemployeetypes')->name('cefa.gth.employeetypes.create');
        Route::post('/employeetypes/create', 'EmployeeTypController@postcreateemployeetypes')->name('cefa.gth.employeetypes.create');
        Route::delete('/gth/employeetypes/{id}/delete', 'EmployeeTypController@deleteEmployeeType')->name('cefa.gth.employeetypes.delete');
        Route::patch('/gth/employeetypes/update{id}', 'EmployeeTypController@updateeemployeetypes')->name('cefa.gth.employeetypes.update');
        Route::get('gth/employeetypes/{id}', 'EmployeeTypController@showEmployeeType')->name('cefa.gth.employeetypes.show');



        // Type_contractor
        Route::get('/contractortypes', 'ContractTypController@viewcontractortypes')->name('cefa.gth.contractortypes.view'); //nombres de la vista
        Route::post('/contractortypes/create', 'ContractTypController@postcreatecontractortypes')->name('cefa.gth.contractortypes.create');
        Route::delete('/gth/contractortypes/{id}/delete', 'ContractTypController@deleteContractorTypes')->name('cefa.gth.contractortypes.delete');
        Route::patch('/gth/contractortypes/update{id}', 'ContractTypController@updatecontractortypes')->name('cefa.gth.contractortypes.update');
        Route::get('gth/contractortypes/{id}', 'ContractTypController@showContractorTypes')->name('cefa.gth.contractortypes.show');

        // insurer_entities
        Route::get('/insurerentities', 'InsurerEntitiesController@viewinsurerentities')->name('cefa.gth.insurerentities.view'); //nombres de la vista
        Route::post('/insurerentities/create', 'InsurerEntitiesController@postcreateinsurerentities')->name('cefa.gth.insurerentities.create');
        Route::delete('/gth/insurerentities/{id}/delete', 'InsurerEntitiesController@deleteInsurerEntities')->name('cefa.gth.insurerentities.delete');
        Route::patch('/gth/insurerentities/update{id}', 'InsurerEntitiesController@updateinsurerentities')->name('cefa.gth.insurerentities.update');
        Route::get('gth/insurerentities/{id}', 'InsurerEntitiesController@showInsurerEntities')->name('cefa.gth.insurerentities.show');

        // pension_entities
        Route::get('/pensionentities', 'PensionEntitiesController@viewpensionentities')->name('cefa.gth.pensionentities.view'); //nombres de la vista
        Route::post('/pensionentities/create', 'PensionEntitiesController@postcreatepensionentities')->name('cefa.gth.pensionentities.create');
        Route::delete('/gth/pensionentities/{id}/delete', 'PensionEntitiesController@deletePensionEntities')->name('cefa.gth.pensionentities.delete');
        Route::patch('/gth/pensionentities/update{id}', 'PensionEntitiesController@updatepensionentities')->name('cefa.gth.pensionentities.update');
        Route::get('gth/pensionentities/{id}', 'PensionEntitiesController@showPensionEntities')->name('cefa.gth.pensionentities.show');

        // Biometric_report
        Route::get('/biometricreports', 'BiometricReportController@viewBiometricReports')->name('cefa.gth.biometricreports.view');
        Route::get('datatable/users', 'BiometricReportController@user')->name('datatable.user');
        Route::post('/biometricreports/create/{id}', 'BiometricReportController@postcreateBiometricReport')->name('cefa.gth.biometricreports.create');
        Route::put('/gth/biometricreports/update{id}', 'BiometricReportController@updateBiometricReport')->name('cefa.gth.biometricreports.update');
        Route::get('/gth/biometricreports/{id}/showpersondetails', 'BiometricReportController@showPersonDetails')->name('cefa.gth.biometricreports.showpersondetails');
        Route::patch('/gth/biometricreports/{id}', 'BiometricReportController@showcontractortypes')->name('cefa.gth.contractortypes.show');


        //Contract_report
        Route::get('/contractreports', 'ContractReportController@viewcontractreports')->name('cefa.gth.contractreports.view');
        Route::post('/contractreports', 'ContractReportController@create')->name('cefa.gth.contractreports.store');
        Route::get('/get-person-data', 'ContractReportController@getPersonData')->name('cefa.gth.getPersonData');

        //Contractors
        Route::get('/contractors', 'ContractorsController@viewcontractor')->name('cefa.gth.contractors.view');
        Route::post('/contractors/create', 'ContractorsController@postcreatecontractor')->name('cefa.gth.contractor.create');
        Route::delete('/gth/contractors/{id}/delete', 'ContractorsController@deleteContractor')->name('cefa.gth.contractor.delete');
        Route::patch('/gth/contractors/update{id}', 'ContractorsController@updatecontractor')->name('cefa.gth.contractor.update');
        Route::get('gth/contractors/{id}', 'ContractorsController@showContractor')->name('cefa.gth.contractor.show');

        //Posicion
        Route::get('/positions', 'PositionsController@viewpositions')->name('cefa.gth.position'); //nombres de la vista
        Route::post('/positions/create', 'PositionsController@postcreatepositions')->name('cefa.gth.positions.create');
        Route::delete('/gth/positions/{id}/delete', 'PositionsController@deletepositions')->name('cefa.gth.positions.delete');
        Route::patch('/gth/positions/update/{id}', 'PositionsController@updatepositions')->name('cefa.gth.positions.update');
        Route::get('gth/positions/{id}', 'PositionsController@showPositions')->name('cefa.gth.positions.show');

        //officials
        Route::get('/official', 'OfficialController@viewofficials')->name('cefa.gth.officials.view');
        Route::get('/obtener_datos', 'OfficialController@getPersonDatas')->name('cefa.gth.getPersonDatas');
        Route::post('/employees', 'OfficialController@store')->name('cefa.gth.store');
        Route::patch('/official/edit/{id}', 'OfficialController@edit_official')->name('cefa.gth.officials.update');
        Route::delete('/gth/officials/{id}/delete', 'OfficialController@deleteofficials')->name('cefa.gth.officials.delete');

    });
});
