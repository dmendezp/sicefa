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
        Route::get('/benefits', 'BenefitsController@benefitsView')->name('bienestar.admin.crud.benefits');

        Route::delete('/benefits/delete/{id}', 'BenefitsController@destroy')->name('cefa.bienestar.benefits.delete');
        Route::post('/benefits/add', 'BenefitsController@BenefitsViewAdd')->name('cefa.bienestar.benefits.add');
        Route::put('/benefits/update/{id}', 'BenefitsController@update')->name('cefa.bienestar.benefits.update');

        //Vista CRUD Buses
        Route::get('/buses', 'BusesController@index')->name('bienestar.admin.crud.buses');
        Route::post('/buses/store', 'BusesController@store')->name('bienestar.admin.save.buses');
        Route::put('/buses/update/{id} ', 'BusesController@update')->name('bienestar.admin.edit.buses');
        Route::delete('/buses/delete/{id}', 'BusesController@destroy')->name('bienestar.admin.delete.buses');
        

        // Vista CRUD tipo de beneficios rol admin
        Route::get('/typeofbenefits', 'TypesOfBenefitsController@typeofbenefits')->name('bienestar.admin.crud.typeofbenefits');
        Route::post('/typeofbenefits/store', 'TypesOfBenefitsController@store')->name('bienestar.admin.save.typeofbenefits');
        Route::delete('/typeofbenefits/{id}', 'TypesOfBenefitsController@destroy')->name('bienestar.admin.delete.typeofbenefits');
        Route::put('/typeofbenefits/{id}', 'TypesOfBenefitsController@update')->name('bienestar.admin.edit.typeofbenefits');
       
        /*// Vista CRUD tipo de beneficios
        Route::get('/typeofbenefits', 'TypesOfBenefitsController@typeofbenefits')->name('cefa.bienestar.typeofbenefits');
        Route::post('/typeofbenefits/store', 'TypesOfBenefitsController@store')->name('cefa.bienestar.typeofbenefits.store');
        Route::delete('/typeofbenefits/{id}', 'TypesOfBenefitsController@destroy')->name('cefa.bienestar.typeofbenefits.delete');
        Route::put('/typeofbenefits/{id}', 'TypesOfBenefitsController@update')->name('cefa.typeofbenefits.update');
        // Vista CRUD tipo de beneficios
        Route::get('/typeofbenefits', 'TypesOfBenefitsController@typeofbenefits')->name('cefa.bienestar.typeofbenefits');
        Route::post('/typeofbenefits/store', 'TypesOfBenefitsController@store')->name('cefa.bienestar.typeofbenefits.store');
        Route::delete('/typeofbenefits/{id}', 'TypesOfBenefitsController@destroy')->name('cefa.bienestar.typeofbenefits.delete');
        Route::put('/typeofbenefits/{id}', 'TypesOfBenefitsController@update')->name('cefa.typeofbenefits.update');*/
       
        


        // Vista CRUD Pivota rol admin
        Route::get('/benefitstypeofbenefits', 'BenefitsTypesOfBenefitsController@benefitstypeofbenefits')->name('bienestar.admin.view.benefitstypeofbenefits');
        Route::put('/benefitstypeofbenefits/updateInline', 'BenefitsTypesOfBenefitsController@updateInline')->name('bienestar.admin.updateInline.benefitstypeofbenefits');
        Route::get('/benefitstypeofbenefits/getCurrentState', 'BenefitsTypesOfBenefitsController@getCurrentState')->name('bienestar.admin.getCurrentState.benefitstypeofbenefits');
        
        /*// Vista CRUD Pivota rol lider de alimentacion
        Route::get('/benefitstypeofbenefits', 'BenefitsTypesOfBenefitsController@benefitstypeofbenefits')->name('bienestar.food_benefits_leaders.view.benefitstypeofbenefits');
        Route::put('/benefitstypeofbenefits/updateInline', 'BenefitsTypesOfBenefitsController@updateInline')->name('bienestar.food_benefits_leaders.updateInline.benefitstypeofbenefits');
        Route::get('/benefitstypeofbenefits/getCurrentState', 'BenefitsTypesOfBenefitsController@getCurrentState')->name('bienestar.food_benefits_leaders.getCurrentState.benefitstypeofbenefits');
                
        // Vista CRUD Pivota rol lider de rutas
        Route::get('/benefitstypeofbenefits', 'BenefitsTypesOfBenefitsController@benefitstypeofbenefits')->name('bienestar.transportation_benefits_leader.view.benefitstypeofbenefits');
        Route::put('/benefitstypeofbenefits/updateInline', 'BenefitsTypesOfBenefitsController@updateInline')->name('bienestar.transportation_benefits_leader.updateInline.benefitstypeofbenefits');
        Route::get('/benefitstypeofbenefits/getCurrentState', 'BenefitsTypesOfBenefitsController@getCurrentState')->name('bienestar.transportation_benefits_leader.getCurrentState.benefitstypeofbenefits');*/





        // Rutas para la vista postulation-management
        Route::get('/postulation-management', 'PostulationBenefitController@index')->name('bienestar.admin.view.postulation-management');
        Route::get('/postulation-management/{id}', 'PostulationBenefitController@show')->name('bienestar.admin.show.postulation-management');
        Route::put('/postulation-management/{id}/update-score', 'PostulationBenefitController@updateScore')->name('bienestar.admin.update-score.postulation-management');
        Route::post('/postulation-management/update-benefits', 'PostulationBenefitController@updateBenefits')->name('bienestar.admin.update-benefits.postulation-management');
        

        //Vistas Rutas de transporte
        Route::get('/transportroutes', 'RoutesTransportationController@index')->name('bienestar.admin.crud.transportroutes');
        Route::post('/transportroutes/add', 'RoutesTransportationController@store')->name('cefa.bienestar.transportroutes.add');
        Route::delete('/transportroutes/delete/{id}', 'RoutesTransportationController@destroy')->name('cefa.bienestar.transportroutes.destroy');
        Route::get('/transportroutes/{id}', 'RoutesTransportationController@edit')->name('cefa.bienestar.transportroutes.edit');
        Route::post('/transportroutes/update', 'RoutesTransportationController@update')->name('cefa.bienestar.transportroutes.update');


        // vista de conductores
        Route::get('/drivers', 'BusDriversController@drivers')->name('bienestar.admin.crud.drivers');
        Route::post('/drivers/add', 'BusDriversController@driversAdd')->name('cefa.bienestar.drivers.add');
        Route::put('/drivers/update/{id}', 'BusDriversController@driversUp')->name('cefa.bienestar.drivers.update');
        Route::delete('/drivers/delete/{id}', 'BusDriversController@delete')->name('cefa.bienestar.drivers.delete');


        // vista de gestiones de convocatorias
        Route::get('/Convocations', 'ConvocationsController@index')->name('bienestar.admin.crud.convocations');
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
        Route::get('/postulations', 'PostulationsController@index') ->name('cefa.bienestar.postulations');
        Route::get('/postulations/search', 'PostulationsController@search')->name('cefa.bienestar.search'); 
        Route::get('/postulations/search/getbenefits', 'PostulationsController@getBenefits')->name('cefa.bienestar.search_questions'); 



        //vista el listados apoyo alimentacion 
        Route::get('/AssistancesFoods', 'AssistancesFoodsController@index')->name('bienestar.admin.crud.beneficiaries_food');
        Route::post('/AssistancesFoods/store', 'AssistancesFoodsController@store')->name('cefa.bienestar.AssistancesFoods.store');

        //Vistas Rutas de transporte
        Route::get('/assign-transportation-routes', 'AssingTransportRoutesController@mostrarAsignaciones')->name('cefa.bienestar.assign-transportation-routes');
        Route::get('/assign-transportation-routes/{apprenticeId}', 'AssingTransportRoutesController@showAssignmentForm')->name('cefa.bienestar.assign-transportation-routes');

        //Vista de Formulario de asignacion de rutas de transporte
        Route::get('/assing-form-transportation-routes/index', 'AssingFormTransporRoutesController@index')->name('cefa.bienestar.assing-form-transportation-routes.index');
        Route::get('/assing-form-transportation-routes/store', 'AssingFormTransporRoutesController@create')->name('cefa.bienestar.assing-form-transportation-routes.store');
        Route::put('/assing-form-transportation-routes/updateInline', 'AssingFormTransporRoutesController@updateInline')->name('cefa.bienestar.assing-form-transportation-routes.updateInline');
        



    });
});
