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
        Route::get('/home/admin', 'BIENESTARController@home')->name('bienestar.admin.dashboard');
        Route::get('/home/transportation_benefits_leader', 'BIENESTARController@home')->name('bienestar.food_benefits_leaders.dashboard');//home Lider del Beneficio de Alimentacion
        Route::get('/home/food_benefits_leader', 'BIENESTARController@home')->name('bienestar.transportation_benefits_leader.dashboard');//home Lider del beneficio de Transporte
        Route::get('/home/feeding_assistant', 'BIENESTARController@home')->name('bienestar.feeding_assistant.dashboard');//home Asistente de Alimentacion
        Route::get('/home/route_leader', 'BIENESTARController@home')->name('bienestar.route_leader.dashboard');//home Lider de ruta


        //Vista Crud Beneficio(ADMINISTRADOR)
        Route::get('/admin/benefits', 'BenefitsController@benefitsView')->name('bienestar.admin.crud.benefits');
        Route::delete('/admin/benefits/delete/{id}', 'BenefitsController@destroy')->name('bienestar.admin.delete.benefits');
        Route::post('/admin/benefits/add', 'BenefitsController@BenefitsViewAdd')->name('bienestar.admin.save.benefits');
        Route::put('/admin/benefits/update/{id}', 'BenefitsController@update')->name('bienestar.admin.edit.benefits');

         //Vista Crud Beneficio(LIDER BENEFICIO DE ALIMENTACION)
         Route::get('/food_benefits_leaders/benefits', 'BenefitsController@benefitsView')->name('bienestar.food_benefits_leaders.crud.benefits');
         Route::delete('/food_benefits_leaders/benefits/delete/{id}', 'BenefitsController@destroy')->name('bienestar.food_benefits_leaders.delete.benefits');
         Route::post('/food_benefits_leaders/benefits/add', 'BenefitsController@BenefitsViewAdd')->name('bienestar.food_benefits_leaders.save.benefits');
         Route::put('/food_benefits_leaders/benefits/update/{id}', 'BenefitsController@update')->name('bienestar.food_benefits_leaders.edit.benefits');

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
        Route::post('/transportroutes/add', 'RoutesTransportationController@store')->name('bienestar.admin.save.transportroutes');
        Route::delete('/transportroutes/delete/{id}', 'RoutesTransportationController@destroy')->name('bienestar.admin.delete.transportroutes');
        Route::put('/transportroutes/update/{id}', 'RoutesTransportationController@update')->name('bienestar.admin.edit.transportroutes');


        // vista de conductores
        Route::get('/drivers', 'BusDriversController@drivers')->name('bienestar.admin.crud.drivers');
        Route::post('/drivers/add', 'BusDriversController@driversAdd')->name('bienestar.admin.save.drivers');
        Route::put('/drivers/update/{id}', 'BusDriversController@driversUp')->name('bienestar.admin.edit.drivers');
        Route::delete('/drivers/delete/{id}', 'BusDriversController@delete')->name('bienestar.admin.delete.drivers');


        // vista de gestiones de convocatorias
        Route::get('/Convocations', 'ConvocationsController@index')->name('bienestar.admin.crud.convocations');
        Route::post('/Convocations/store', 'ConvocationsController@store')->name('bienestar.admin.save.convocations');
        Route::delete('/Convocations/delete/{id}', 'ConvocationsController@destroy')->name('bienestar.admin.delete.convocations');
        Route::put('/Convocations/update/{id}', 'ConvocationsController@update')->name('bienestar.admin.edit.convocations');


        //Vista crud formularios
        Route::get('/editforms', 'ConvocationsQuestionsController@editform')->name('bienestar.admin.crud.editform');
        Route::post('/saveform', 'ConvocationsQuestionsController@saveform')->name('bienestar.admin.saveform.editform');
        Route::post('/editforms/update/{id}', 'ConvocationsQuestionsController@updateQuestion')->name('bienestar.admin.edit.editform');
        Route::delete('/delete/question/{id}', 'ConvocationsQuestionsController@deleteQuestion')->name('bienestar.admin.delete.editform');
        Route::get('/addquestions', 'ConvocationsQuestionsController@add_question')->name('bienestar.admin.add_question.editform');
        Route::post('/addquestions/add_answer', 'ConvocationsQuestionsController@add_answer')->name('bienestar.admin.save.editform');
       
        // Vista De Consulta
        Route::get('/callconsultation', 'CallConsultationController@index')->name('cefa.bienestar.callconsultation');
        Route::post('/busqueda', 'CallConsultationController@buscar')->name('cefa.bienestar.busqueda');
        Route::post('/busqueda/document', 'CallConsultationController@search')->name('cefa.bienestar.search1');
        Route::post('/search', 'CallConsultationController@searchByDocumentNumber')->name('cefa.bienestar.search.by.document');
        Route::post('/procesar-formulario', 'CallConsultationController@procesarFormulario')->name('cefa.bienestar.procesar.formulario');
        Route::get('/consulta/{documentNumber}', 'CallConsultationController@consultarBeneficios')->name('cefa.bienestar.consulta.resultados');
        // Vista de Postulaciones
        Route::get('/postulations', 'PostulationsController@index') ->name('cefa.bienestar.postulations');
        Route::post('/postulations/search', 'PostulationsController@search')->name('cefa.bienestar.search'); 
        Route::post('/postulations/search/getquestions', 'PostulationsController@getquestions')->name('cefa.bienestar.search_questions'); 
        Route::post('/postulations/search/getallquestions', 'PostulationsController@getallquestions')->name('cefa.bienestar.search_all_questions'); 
        Route::post('/postulations/save', 'PostulationsController@savepostulation')->name('cefa.bienestar.savepostulation'); 




        //vista el listados apoyo alimentacion(ADMINISTRADOR)
        Route::get('/foodrecord', 'AssistancesFoodsController@index')->name('bienestar.admin.crud.beneficiaries_food');
        Route::get('/assistancefood', 'AssistancesFoodsController@assistancefoodrecord')->name('bienestar.admin.view.food_assistance_lists');
        Route::get('/filtro-porcentaje', 'AssistancesFoodsController@filtrarPorcentaje')->name('bienestar.admin.route.food_assistance_lists.filter');
        //vista el listados apoyo alimentacion(LIDER BENEFICIO DE ALIMENTACION)
        Route::get('/foodrecord', 'AssistancesFoodsController@index')->name('bienestar.food_benefits_leaders.crud.beneficiaries_food');
        Route::get('/assistancefood', 'AssistancesFoodsController@assistancefoodrecord')->name('bienestar.food_benefits_leaders.view.food_assistance_lists');
        Route::get('/filtro-porcentaje', 'AssistancesFoodsController@filtrarPorcentaje')->name('bienestar.food_benefits_leaders.route.food_assistance_lists.filter');


        //Vistas Asignar Rutas de transporte
        Route::get('/assign-transportation-routes', 'AssingTransportRoutesController@mostrarAsignaciones')->name('bienestar.admin.view.assign_transport_route');
        Route::get('/assign-transportation-routes/{apprenticeId}', 'AssingTransportRoutesController@showAssignmentForm')->name('cefa.bienestar.assign-transportation-routes');

        //Vista de Formulario de asignacion de rutas de transporte
        Route::get('/assing-form-transportation-routes/index', 'AssingFormTransporRoutesController@index')->name('cefa.bienestar.assing-form-transportation-routes.index');
        Route::get('/assing-form-transportation-routes/store', 'AssingFormTransporRoutesController@create')->name('cefa.bienestar.assing-form-transportation-routes.store');
        Route::put('/assing-form-transportation-routes/updateInline', 'AssingFormTransporRoutesController@updateInline')->name('cefa.bienestar.assing-form-transportation-routes.updateInline');

        //vista de listado lista de asistencia de transporte
        route::get('/transportation_assistance_list', 'TransportationAssistancesController@index')->name('bienestar.admin.view.transportation_assistance_lists');
        Route::post('/busqueda/documentos', 'TransportationAssistancesController@search')->name('bienestar.admin.view.transportation_assistance_lists.consult');

        //Vista transportation-assistance
        Route::get('/transportation_asistance', 'TransportationAssistancesController@indexasistances')->name('bienestar.admin.view.asistance_transport');
        Route::post('/transportation_asistance/search', 'TransportationAssistancesController@searchapprentice')->name('bienestar.admin.form.asistance_transport');

    });
});
