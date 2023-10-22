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
        Route::get('/benefits', 'BenefitsController@benefitsView')->name('cefa.bienestar.benefits');

        Route::delete('/benefits/delete/{id}', 'BenefitsController@destroy')->name('cefa.bienestar.benefits.delete');
        Route::post('/benefits/add', 'BenefitsController@BenefitsViewAdd')->name('cefa.bienestar.benefits.add');
        Route::put('/benefits/update/{id}', 'BenefitsController@update')->name('cefa.bienestar.benefits.update');

        //Vista CRUD Buses
        Route::get('/buses', 'BusesController@index')->name('cefa.bienestar.buses');
        Route::post('/buses/store', 'BusesController@store')->name('cefa.bienestar.buses.store');
        Route::put('/buses/update/{id} ', 'BusesController@update')->name('cefa.bienestar.buses.update');
        Route::delete('/buses/delete/{id}', 'BusesController@destroy')->name('cefa.bienestar.buses.destroy');
        

        // Vista CRUD tipo de beneficios
        Route::get('/typeofbenefits', 'TypesOfBenefitsController@typeofbenefits')->name('cefa.bienestar.typeofbenefits');
        Route::post('/typeofbenefits/create', 'TypesOfBenefitsController@store')->name('cefa.typeofbenefits.store');
        Route::delete('/typeofbenefits/{id}', 'TypesOfBenefitsController@destroy')->name('cefa.typeofbenefits.destroy');
        Route::put('/bienestar/typeofbenefits/{id}', 'TypesOfBenefitsController@update')->name('cefa.typeofbenefits.update');
        Route::delete('/typeofbenefits/{id}', 'TypesOfBenefitsController@destroy')->name('cefa.typeofbenefits.destroy');



        // Vista CRUD Pivota
        Route::get('/benefitstypeofbenefits', 'BenefitsTypesOfBenefitsController@benefitstypeofbenefits')->name('cefa.bienestar.benefitstypeofbenefits');
        Route::put('/benefitstypeofbenefits/updateInline', 'BenefitsTypesOfBenefitsController@updateInline')->name('cefa.bienestar.benefitstypeofbenefits.updateInline');
        Route::get('/benefitstypeofbenefits/getCurrentState', 'BenefitsTypesOfBenefitsController@getCurrentState')->name('cefa.bienestar.benefitstypeofbenefits.getCurrentState');

        // Rutas para la vista postulation-management
        Route::get('/postulation-management', 'PostulationBenefitController@index')->name('cefa.bienestar.postulation-management.index');
        Route::get('/postulation-management/{id}', 'PostulationBenefitController@show')->name('cefa.bienestar.postulation-management.show');
        Route::put('/postulation-management/{id}/update-score', 'PostulationBenefitController@updateScore')->name('cefa.bienestar.postulation-management.update-score');
        Route::put('/postulation-management/update-state', 'PostulationBenefitController@updateState')->name('cefa.bienestar.postulation-management.update-state');
        Route::post('/postulation-management/update-benefits', 'PostulationBenefitController@updateBenefits')->name('cefa.bienestar.postulation-management.update-benefits');
        Route::post('/postulation-management/assign-benefits', 'PostulationBenefitController@assignBenefitsToPostulations')->name('cefa.bienestar.postulation-management.assign-benefits');
        

        //Vistas Rutas de transporte
        Route::get('/transportroutes', 'RoutesTransportationController@index')->name('bienestar.admin.crud.transportroutes');
        Route::get('/transportroutes', 'RoutesTransportationController@index')->name('bienestar.transportation_benefits_leader.crud.transportroutes');


        Route::post('/transportroutes/add', 'RoutesTransportationController@store')->name('cefa.bienestar.transportroutes.add');
        Route::delete('/transportroutes/delete/{id}', 'RoutesTransportationController@destroy')->name('cefa.bienestar.transportroutes.destroy');
        Route::get('/transportroutes/{id}', 'RoutesTransportationController@edit')->name('cefa.bienestar.transportroutes.edit');
        Route::post('/transportroutes/update', 'RoutesTransportationController@update')->name('cefa.bienestar.transportroutes.update');


        // vista de conductores
        Route::get('/drivers', 'BusDriversController@drivers')->name('cefa.bienestar.drivers');
        Route::post('/drivers/add', 'BusDriversController@driversAdd')->name('cefa.bienestar.drivers.add');
        Route::put('/drivers/update/{id}', 'BusDriversController@driversUp')->name('cefa.bienestar.drivers.update');
        Route::delete('/drivers/delete/{id}', 'BusDriversController@delete')->name('cefa.bienestar.drivers.delete');


        // vista de gestiones de convocatorias
        Route::get('/Convocations', 'ConvocationsController@index')->name('cefa.bienestar.Convocations');
        Route::post('/Convocations/store', 'ConvocationsController@store')->name('cefa.bienestar.Convocations.store');
        Route::delete('/Convocations/delete/{id}', 'ConvocationsController@destroy')->name('cefa.bienestar.Convocations.destroy');
        Route::put('/Convocations/update/{id}', 'ConvocationsController@update')->name('cefa.bienestar.Convocations.update');


        //Vista crud formularios
        Route::get('/editforms', 'ConvocationsQuestionsController@editform')->name('cefa.bienestar.editform');
        Route::post('/saveform', 'ConvocationsQuestionsController@saveform')->name('cefa.bienestar.saveform');
        Route::post('/editforms/update/{id}', 'ConvocationsQuestionsController@updateQuestion')->name('cefa.bienestar.editform.update');
        Route::delete('/delete/question/{id}', 'ConvocationsQuestionsController@deleteQuestion')->name('cefa.bienestar.delete_question');
        Route::get('/addquestions', 'ConvocationsQuestionsController@add_question')->name('cefa.bienestar.add_question');
        Route::post('/addquestions/add_answer', 'ConvocationsQuestionsController@add_answer')->name('cefa.bienestar.add_question.add');
       
        // Vista De Consulta
            Route::get('/callconsultation', 'CallConsultationController@index')->name('cefa.bienestar.callconsultation');
        Route::post('/busqueda', 'CallConsultationController@buscar')->name('cefa.bienestar.busqueda');
        Route::post('/busqueda/document', 'CallConsultationController@search')->name('cefa.bienestar.search1');
        Route::post('/search', 'CallConsultationController@searchByDocumentNumber')->name('cefa.bienestar.search.by.document');
        Route::post('/procesar-formulario', 'CallConsultationController@procesarFormulario')->name('cefa.bienestar.procesar.formulario');
        Route::get('/consulta/{documentNumber}', 'CallConsultationController@consultarBeneficios')->name('cefa.bienestar.consulta.resultados');
        // Vista de Postulaciones
        route::get('/postulations', 'PostulationsController@index') ->name('cefa.bienestar.postulations');
        Route::get('/postulations/search', 'PostulationsController@search')->name('cefa.bienestar.search');        

        //vista el listados apoyo alimentacion 
        Route::get('/AssistancesFoods', 'AssistancesFoodsController@index')->name('cefa.bienestar.AssistancesFoods');
        Route::post('/AssistancesFoods/store', 'AssistancesFoodsController@store')->name('cefa.bienestar.AssistancesFoods.store');

        //Vistas Rutas de transporte
        Route::get('/assign-transportation-routes', 'AssingTransportRoutesController@mostrarAsignaciones')->name('cefa.bienestar.assign-transportation-routes');
        Route::get('/assign-transportation-routes/{apprenticeId}', 'AssingTransportRoutesController@showAssignmentForm')->name('cefa.bienestar.assign-transportation-routes');



    });
});
