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

    //Biometric_report
    Route::get('/biometricreports', 'BiometricReportController@viewBiometricReports')->name('gth.biometricreports.view');

    //Contract_report
    Route::get('/contractreports', 'ContractReportController@viewcontractreports')->name('gth.contractreports.view');
    Route::post('/contractreports', 'ContractReportController@create')->name('gth.contractreports.store');
    Route::get('/get-person-data', 'ContractReportController@getPersonData')->name('gth.getPersonData');

    //Contractors
    Route::get('/contractors', 'ContractorsController@viewcontractor')->name('gth.contractors.view');
    Route::get('/contractors/create', 'ContractorsController@create')->name('gth.contractors.create');
    Route::post('/contractors/store', 'ContractorsController@store')->name('gth.contractors.store');
    Route::get('/contractors/{id}', 'ContractorsController@show')->name('gth.contractors.show');
    Route::get('/contractors/edit/{id}', 'ContractorsController@edit')->name('gth.contractors.edit');
    Route::patch('contractors/{id}', 'ContractorsController@update')->name('gth.contractors.update');
    Route::delete('/contractors/{id}/delete', 'ContractorsController@destroy')->name('gth.contractors.destroy');
});
