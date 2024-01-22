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
        Route::post('/buses/store', 'BusesController@store')->name('bienestar.buses.store');
        Route::delete('/buses/delete/{id}', 'BusesController@destroy')->name('bienestar.buses.destroy');
        Route::put('/buses/update/{id}', 'BusesController@update')->name('bienestar.buses.update');

        // Vista CRUD tipo de beneficios
        Route::get('/typeofbenefits', 'TypesOfBenefitsController@typeofbenefits')->name('bienestar.typeofbenefits');
        Route::post('/typeofbenefits/create', 'TypesOfBenefitsController@store')->name('typeofbenefits.store');
        Route::delete('/typeofbenefits/{id}', 'TypesOfBenefitsController@destroy')->name('typeofbenefits.destroy');
        Route::put('/bienestar/typeofbenefits/{id}', 'TypesOfBenefitsController@update')->name('typeofbenefits.update');
        Route::delete('/typeofbenefits/{id}', 'TypesOfBenefitsController@destroy')->name('typeofbenefits.destroy');



        // Vista CRUD Pivota
        Route::get('/benefitstypeofbenefits', 'BenefitsTypesOfBenefitsController@benefitstypeofbenefits')->name('bienestar.benefitstypeofbenefits');
        Route::post('/benefitstypeofbenefits', 'BenefitsTypesOfBenefitsController@store')->name('bienestar.benefitstypeofbenefits.store');
        Route::put('/benefitstypeofbenefits/{id}', 'BenefitsTypesOfBenefitsController@update')->name('bienestar.benefitstypeofbenefits.update');
        Route::delete('/benefitstypeofbenefits/{id}', 'BenefitsTypesOfBenefitsController@destroy')->name('benefitstypeofbenefits.destroy');
        Route::put('/benefitstypeofbenefits/updateInline', 'BenefitsTypesOfBenefitsController@updateInline')->name('benefitstypeofbenefits.updateInline');

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


        // vista de conductores
        Route::get('/drivers', 'BusDriversController@drivers')->name('bienestar.drivers');
        Route::post('/drivers/add', 'BusDriversController@driversAdd')->name('bienestar.drivers.add');
        Route::put('/drivers/update/{id}', 'BusDriversController@driversUp')->name('bienestar.drivers.update');
        Route::delete('/drivers/delete/{id}', 'BusDriversController@delete')->name('bienestar.drivers.delete');


        // vista de gestiones de convocatorias
        Route::get('/Convocations', 'ConvocationsController@index')->name('bienestar.Convocations');
        Route::post('/Convocations/store', 'ConvocationsController@store')->name('bienestar.Convocations.store');
        Route::put('/Convocations/update/{id}', 'ConvocationsController@update')->name('bienestar.Convocations.update');


        //Vista crud formularios
        Route::get('/editforms', 'ConvocationsQuestionsController@editform')->name('bienestar.editform');
        Route::post('/saveform', 'ConvocationsQuestionsController@saveform')->name('bienestar.saveform');
        Route::post('/editforms/update/{id}', 'ConvocationsQuestionsController@updateQuestion')->name('bienestar.editform.update');
        Route::delete('/delete/question/{id}', 'ConvocationsQuestionsController@deleteQuestion')->name('bienestar.delete_question');
        Route::get('/addquestions', 'ConvocationsQuestionsController@add_question')->name('bienestar.add_question');
        Route::post('/addquestions/add', 'ConvocationsQuestionsController@addQuestion')->name('bienestar.add_question.add');
    });
});
