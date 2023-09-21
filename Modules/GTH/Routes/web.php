<?php
use Illuminate\Support\Facades\Route;
use Modules\GTH\Http\Controllers\EmployeeTypController;

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

Route::prefix('gth')->group(function () {
    Route::get('/index', 'GTHController@index')->name('index.view');
    Route::get('/attendance', 'GTHController@viewattendance')->name('attendance.view');
    Route::get('/attendanceregister', 'GTHController@viewregisterattendance')->name('reattendance.view');
    Route::get('/official', 'GTHController@viewofficial')->name('officials.view');
    Route::get('/contractualcertificate', 'GTHController@viewcontractualcertificate')->name('contractualcertificates.view');

    // Type_employee
    Route::get('/employeetypes', 'EmployeeTypController@viewemployeetypes')->name('gth.employeetypes.view'); //nombres de la vista
    Route::get('/employeetypes/create', 'EmployeeTypController@getcreateemployeetypes')->name('gth.employeetypes.create');
    Route::post('/employeetypes/create', 'EmployeeTypController@postcreateemployeetypes')->name('gth.employeetypes.create');
    Route::delete('/gth/employeetypes/{id}/delete', 'EmployeeTypController@deleteEmployeeType')->name('gth.employeetypes.delete');
    Route::patch('/gth/employeetypes/update{id}', 'EmployeeTypController@updateeemployeetypes')->name('gth.employeetypes.update');
    Route::get('gth/employeetypes/{id}', [EmployeeTypController::class, 'showEmployeeType'])->name('gth.employeetypes.show');

    // Type_contractor
    Route::get('/contractortypes', 'ContractTypController@viewcontractortypes')->name('gth.contractortypes.view'); //nombres de la vista
    Route::post('/contractortypes/create', 'ContractTypController@postcreatecontractortypes')->name('gth.contractortypes.create');
    Route::delete('/gth/contractortypes/{id}/delete', 'ContractTypController@deleteContractorTypes')->name('gth.contractortypes.delete');
    Route::patch('/gth/contractortypes/update{id}', 'ContractTypController@updatecontractortypes')->name('gth.contractortypes.update');
    Route::get('gth/contractortypes/{id}', [ContractTypController::class, 'showContractorTypes'])->name('gth.contractortypes.show');

    // insurer_entities
    Route::get('/insurerentities', 'InsurerEntitiesController@viewinsurerentities')->name('gth.insurerentities.view'); //nombres de la vista
    Route::post('/insurerentities/create', 'InsurerEntitiesController@postcreateinsurerentities')->name('gth.insurerentities.create');
    Route::delete('/gth/insurerentities/{id}/delete', 'InsurerEntitiesController@deleteInsurerEntities')->name('gth.insurerentities.delete');
    Route::patch('/gth/insurerentities/update{id}', 'InsurerEntitiesController@updateinsurerentities')->name('gth.insurerentities.update');
    Route::get('gth/insurerentities/{id}', [InsurerEntitiesController::class, 'showInsurerEntities'])->name('gth.insurerentities.show');

    // Biometric_report
    Route::get('/biometricreports', 'BiometricReportController@viewBiometricReports')->name('gth.biometricreports.view');
    Route::post('/biometricreports/create/{id}', 'BiometricReportController@postcreateBiometricReport')->name('gth.biometricreports.create');
    Route::put('/gth/biometricreports/update{id}', 'BiometricReportController@updateBiometricReport')->name('gth.biometricreports.update');
    Route::get('/gth/biometricreports/{id}/showpersondetails', 'BiometricReportController@showPersonDetails')->name('gth.biometricreports.showpersondetails');
    Route::patch('/gth/biometricreports/{id}', 'BiometricReportController@showcontractortypes')->name('gth.contractortypes.show');



    //Contract_report
    Route::get('/contractreports', 'ContractReportController@viewcontractreports')->name('gth.contractreports.view');
    Route::post('/contractreports', 'ContractReportController@create')->name('gth.contractreports.store');
    Route::get('/get-person-data', 'ContractReportController@getPersonData')->name('gth.getPersonData');

    //Contractors
    Route::get('/contractors', 'ContractorsController@viewcontractor')->name('gth.contractors.view');
    Route::post('/contractors/create', 'ContractorsController@postcreatecontractor')->name('gth.contractor.create');
    Route::delete('/gth/contractors/{id}/delete', 'ContractorsController@deleteContractor')->name('gth.contractor.delete');
    Route::patch('/gth/contractors/update{id}', 'ContractorsController@updatecontractor')->name('gth.contractor.update');
    Route::get('gth/contractors/{id}', [ContractorsController::class, 'showContractor'])->name('gth.contractor.show');

    //Posicion
    Route::get('/positions', 'PositionsController@viewpositions')->name('gth.position'); //nombres de la vista
    Route::post('/positions/create', 'PositionsController@postcreatepositions')->name('gth.positions.create');
    Route::delete('/gth/positions/{id}/delete', 'PositionsController@deletepositions')->name('gth.positions.delete');
    Route::patch('/gth/positions/update{id}', 'PositionsController@updatepositions')->name('gth.positions.update');
    Route::get('gth/positions/{id}', [PositionsController::class, 'showPositions'])->name('gth.positions.show');


});
