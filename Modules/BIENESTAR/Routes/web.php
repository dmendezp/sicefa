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

Route::prefix('bienestar')->group(function () {
    Route::get('/', 'BIENESTARController@index');
});

Route::middleware(['lang'])->group(function () {
    Route::prefix('/bienestar')->group(function () {
        //vista home
        Route::get('/home', 'BIENESTARController@home')->name('cefa.bienestar.home');

        //Vista Crud Beneficio
        Route::get('/benefits', 'BenefitsController@benefitsView')->name('cefa.bienestar.benefits');
        Route::delete('/benefits/delete/{id}', 'BenefitsController@destroy')->name('cefa.bienestar.benefits.delete');
        Route::post('/benefits/add', 'BenefitsController@BenefitsViewAdd')->name('cefa.bienestar.benefits.add');
        Route::put('/benefits/update/{id}', 'BenefitsController@update')->name('cefa.bienestar.benefits.update');

        //Vista CRUD Buses
        Route::get('/buses', 'BusesController@index')->name('cefa.bienestar.buses');
        Route::post('/buses/store', 'BusesController@store')->name('cefa.bienestar.buses.store');
        Route::delete('/buses/delete/{id}', 'BusesController@destroy')->name('cefa.bienestar.buses.destroy');
        Route::put('/buses/update/{id}', 'BusesController@update')->name('cefa.bienestar.buses.update');

        // Vista CRUD tipo de beneficios
        Route::get('/typeofbenefits', 'TypesOfBenefitsController@typeofbenefits')->name('cefa.bienestar.typeofbenefits');
        Route::post('/typeofbenefits/create', 'TypesOfBenefitsController@store')->name('cefa.typeofbenefits.store');
        Route::delete('/typeofbenefits/{id}', 'TypesOfBenefitsController@destroy')->name('cefa.typeofbenefits.destroy');
        Route::put('/bienestar/typeofbenefits/{id}', 'TypesOfBenefitsController@update')->name('cefa.typeofbenefits.update');
        Route::delete('/typeofbenefits/{id}', 'TypesOfBenefitsController@destroy')->name('cefa.typeofbenefits.destroy');



        // Vista CRUD Pivota
        Route::get('/benefitstypeofbenefits', 'BenefitsTypesOfBenefitsController@benefitstypeofbenefits')->name('cefa.bienestar.benefitstypeofbenefits');
        Route::post('/benefitstypeofbenefits', 'BenefitsTypesOfBenefitsController@store')->name('cefa.bienestar.benefitstypeofbenefits.store');
        Route::put('/benefitstypeofbenefits/{id}', 'BenefitsTypesOfBenefitsController@update')->name('cefa.bienestar.benefitstypeofbenefits.update');
        Route::delete('/benefitstypeofbenefits/{id}', 'BenefitsTypesOfBenefitsController@destroy')->name('cefa.bienestar.benefitstypeofbenefits.destroy');
        Route::put('/benefitstypeofbenefits/updateInline', 'BenefitsTypesOfBenefitsController@updateInline')->name('cefa.bienestar.benefitstypeofbenefits.updateInline');

        // Rutas para la vista postulation
        Route::get('/postulations', 'PostulationsController@index')->name('bienestar.postulations.index');
        Route::get('/postulations/{id}', 'PostulationsController@show')->name('bienestar.postulations.show');
        Route::get('/postulations/modal/{id}', 'PostulationsController@showModal')->name('bienestar.postulations.modal');
        Route::post('/update-postulation-score/{id}', 'PostulationsController@updateScore')->name('bienestar.postulations.update-score');
        Route::post('/assign-benefits', 'PostulationsController@assignBenefits')->name('bienestar.postulations.assign-benefits');
        Route::get('/convocatoria', 'ConvocationsController@convocatoria')->name('convocatoria');
        Route::post('/bienestar/assign-benefits', 'PostulationsController@assignBenefits')->name('bienestar.postulations.assign-benefits');
        Route::put('bienestar/postulations/update-state/{id}', 'PostulationsController@updateState')->name('bienestar.postulations.update-state');
        Route::post('/bienestar/postulations/create', 'PostulationsController@create')->name('bienestar.postulations.create');
        Route::post('bienestar/postulations/mark-as-beneficiaries', 'PostulationsController@markAsBeneficiaries')->name('bienestar.postulations.mark-as-beneficiaries');
        Route::post('/marcar-beneficiarios', 'PostulationsController@markAsBeneficiaries')->name('bienestar.postulations.mark-as-beneficiaries');
        Route::post('bienestar/postulations/mark-as-beneficiaries', 'PostulationsController@markAsBeneficiaries')->name('bienestar.postulations.mark-as-beneficiaries');



        //Vistas Rutas de transporte
        Route::get('/transportroutes', 'RoutesTransportationsController@index')->name('cefa.bienestar.transportroutes');
        Route::post('/transportroutes/add', 'RoutesTransportationsController@transportroutesAdd')->name('cefa.bienestar.transportroutes.add');
        Route::post('/transportroutes/store', 'RoutesTransportationsController@store')->name('cefa.bienestar.transportroutes.store');
        Route::delete('/transportroutes/delete/{id}', 'RoutesTransportationsController@destroy')->name('cefa.bienestar.transportroutes.destroy');


        // vista de conductores
        Route::get('/drivers', 'BusDriversController@drivers')->name('cefa.bienestar.drivers');
        Route::post('/drivers/add', 'BusDriversController@driversAdd')->name('cefa.bienestar.drivers.add');
        Route::put('/drivers/update/{id}', 'BusDriversController@driversUp')->name('cefa.bienestar.drivers.update');
        Route::delete('/drivers/delete/{id}', 'BusDriversController@delete')->name('cefa.bienestar.drivers.delete');


        // vista de gestiones de convocatorias
        Route::get('/Convocations', 'ConvocationsController@index')->name('bienestar.Convocations');
        Route::post('/Convocations/store', 'ConvocationsController@store')->name('bienestar.Convocations.store');
        Route::put('/Convocations/update/{id}', 'ConvocationsController@update')->name('bienestar.Convocations.update');


        //Vista crud formularios
        Route::get('/editforms', 'ConvocationsQuestionsController@editform')->name('cefa.bienestar.editform');
        Route::post('/saveform', 'ConvocationsQuestionsController@saveform')->name('cefa.bienestar.saveform');
        Route::post('/editforms/update/{id}', 'ConvocationsQuestionsController@updateQuestion')->name('cefa.bienestar.editform.update');
        Route::delete('/delete/question/{id}', 'ConvocationsQuestionsController@deleteQuestion')->name('cefa.bienestar.delete_question');
        Route::get('/addquestions', 'ConvocationsQuestionsController@add_question')->name('cefa.bienestar.add_question');
        Route::post('/addquestions/add', 'ConvocationsQuestionsController@addQuestion')->name('cefa.bienestar.add_question.add');
    });
});
