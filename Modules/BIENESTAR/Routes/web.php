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
        Route::get('/home/transportation_benefits_leader', 'BIENESTARController@home')->name('bienestar.food_benefits_leaders.dashboard'); //home Lider del Beneficio de Alimentacion
        Route::get('/home/food_benefits_leader', 'BIENESTARController@home')->name('bienestar.transportation_benefits_leader.dashboard'); //home Lider del beneficio de Transporte
        Route::get('/home/feeding_assistant', 'BIENESTARController@home')->name('bienestar.feeding_assistant.dashboard'); //home Asistente de Alimentacion
        Route::get('/home/route_leader', 'BIENESTARController@home')->name('bienestar.route_leader.dashboard'); //home Lider de ruta
        Route::get('/user_manual', 'BIENESTARController@manual')->name('cefa.bienestar.user_manual');

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
        //Vista Crud Beneficio(LIDER BENEFICIO DE TRANSPORTE)
        Route::get('/transportation_benefits_leader/benefits', 'BenefitsController@benefitsView')->name('bienestar.transportation_benefits_leader.crud.benefits');
        Route::delete('/transportation_benefits_leader/benefits/delete/{id}', 'BenefitsController@destroy')->name('bienestar.transportation_benefits_leader.delete.benefits');
        Route::post('/transportation_benefits_leader/benefits/add', 'BenefitsController@BenefitsViewAdd')->name('bienestar.transportation_benefits_leader.save.benefits');
        Route::put('/transportation_benefits_leader/benefits/update/{id}', 'BenefitsController@update')->name('bienestar.transportation_benefits_leader.edit.benefits');

        //Vista CRUD Buses(ADMINISTRADOR)
        Route::get('/admin/buses', 'BusesController@index')->name('bienestar.admin.transportation.crud.buses');
        Route::post('/admin/buses/store', 'BusesController@store')->name('bienestar.admin.save.buses');
        Route::put('/admin/buses/update/{id}', 'BusesController@update')->name('bienestar.admin.edit.buses');
        Route::delete('/admin/buses/delete/{id}', 'BusesController@destroy')->name('bienestar.admin.delete.buses');
        //Vista CRUD Buses(LIDER BENEFICIO DE TRANSPORTE)
        Route::get('/transportation_benefits_leader/buses', 'BusesController@index')->name('bienestar.transportation_benefits_leader.transportation.crud.buses');
        Route::post('/transportation_benefits_leader/buses/store', 'BusesController@store')->name('bienestar.transportation_benefits_leader.save.buses');
        Route::put('/transportation_benefits_leader/buses/update/{id}', 'BusesController@update')->name('bienestar.transportation_benefits_leader.edit.buses');
        Route::delete('/transportation_benefits_leader/buses/delete/{id}', 'BusesController@destroy')->name('bienestar.transportation_benefits_leader.delete.buses');


        /*// Vista CRUD tipo de beneficios rol admin
        Route::get('/typeofbenefits', 'TypesOfBenefitsController@typeofbenefits')->name('bienestar.admin.crud.typeofbenefits');
        Route::post('/typeofbenefits/store', 'TypesOfBenefitsController@store')->name('bienestar.admin.save.typeofbenefits');
        Route::delete('/typeofbenefits/{id}', 'TypesOfBenefitsController@destroy')->name('bienestar.admin.delete.typeofbenefits');
        Route::put('/typeofbenefits/{id}', 'TypesOfBenefitsController@update')->name('bienestar.admin.edit.typeofbenefits');
       
        // Vista CRUD tipo de beneficios
        Route::get('/typeofbenefits', 'TypesOfBenefitsController@typeofbenefits')->name('cefa.bienestar.typeofbenefits');
        Route::post('/typeofbenefits/store', 'TypesOfBenefitsController@store')->name('cefa.bienestar.typeofbenefits.store');
        Route::delete('/typeofbenefits/{id}', 'TypesOfBenefitsController@destroy')->name('cefa.bienestar.typeofbenefits.delete');
        Route::put('/typeofbenefits/{id}', 'TypesOfBenefitsController@update')->name('cefa.typeofbenefits.update');
        // Vista CRUD tipo de beneficios
        Route::get('/typeofbenefits', 'TypesOfBenefitsController@typeofbenefits')->name('cefa.bienestar.typeofbenefits');
        Route::post('/typeofbenefits/store', 'TypesOfBenefitsController@store')->name('cefa.bienestar.typeofbenefits.store');
        Route::delete('/typeofbenefits/{id}', 'TypesOfBenefitsController@destroy')->name('cefa.bienestar.typeofbenefits.delete');
        Route::put('/typeofbenefits/{id}', 'TypesOfBenefitsController@update')->name('cefa.typeofbenefits.update');
        // Vista CRUD Pivota rol admin
        Route::get('/admin/benefitstypeofbenefits', 'BenefitsTypesOfBenefitsController@benefitstypeofbenefits')->name('bienestar.admin.view.benefitstypeofbenefits');
        Route::put('/admin/benefitstypeofbenefits/updateInline', 'BenefitsTypesOfBenefitsController@updateInline')->name('bienestar.admin.updateInline.benefitstypeofbenefits');
        Route::get('/admin/benefitstypeofbenefits/getCurrentState', 'BenefitsTypesOfBenefitsController@getCurrentState')->name('bienestar.admin.getCurrentState.benefitstypeofbenefits');        
        // Vista CRUD Pivota rol lider de alimentacion
        Route::get('/benefitstypeofbenefits', 'BenefitsTypesOfBenefitsController@benefitstypeofbenefits')->name('bienestar.food_benefits_leaders.view.benefitstypeofbenefits');
        Route::put('/benefitstypeofbenefits/updateInline', 'BenefitsTypesOfBenefitsController@updateInline')->name('bienestar.food_benefits_leaders.updateInline.benefitstypeofbenefits');
        Route::get('/benefitstypeofbenefits/getCurrentState', 'BenefitsTypesOfBenefitsController@getCurrentState')->name('bienestar.food_benefits_leaders.getCurrentState.benefitstypeofbenefits');
                
        // Vista CRUD Pivota rol lider de rutas
        Route::get('/benefitstypeofbenefits', 'BenefitsTypesOfBenefitsController@benefitstypeofbenefits')->name('bienestar.transportation_benefits_leader.view.benefitstypeofbenefits');
        Route::put('/benefitstypeofbenefits/updateInline', 'BenefitsTypesOfBenefitsController@updateInline')->name('bienestar.transportation_benefits_leader.updateInline.benefitstypeofbenefits');
        Route::get('/benefitstypeofbenefits/getCurrentState', 'BenefitsTypesOfBenefitsController@getCurrentState')->name('bienestar.transportation_benefits_leader.getCurrentState.benefitstypeofbenefits');*/

        // Rutas para la vista postulation-management(ADMINISTRADOR)
        Route::get('/admin/postulation-management', 'PostulationBenefitController@index')->name('bienestar.admin.view.postulation-management');
        Route::get('/admin/postulation-management/{id}', 'PostulationBenefitController@show')->name('bienestar.admin.show.postulation-management');
        Route::post('/admin/postulation-management/update-benefits', 'PostulationBenefitController@updateStateBenefit')->name('bienestar.admin.update-benefits.postulation-management');
        Route::get('/admin/postulation-management/remove_benefit/{postulationId}', 'PostulationBenefitController@remove_benefit')->name('bienestar.admin.remove-benefit.postulation-management');
        
        // Rutas para la vista postulation-management(LIDER BENEFICIO DE ALIMENTACION)
        Route::get('/food_benefits_leaders/postulation-management', 'PostulationBenefitController@index')->name('bienestar.food_benefits_leaders.view.postulation-management');
        Route::get('/food_benefits_leaders/postulation-management/{id}', 'PostulationBenefitController@show')->name('bienestar.food_benefits_leaders.show.postulation-management');
        Route::post('/food_benefits_leaders/postulation-management/update-benefits', 'PostulationBenefitController@updateStateBenefit')->name('bienestar.food_benefits_leaders.update-benefits.postulation-management');
        Route::get('/food_benefits_leaders/postulation-management/remove_benefit/{postulationId}', 'PostulationBenefitController@remove_benefit')->name('bienestar.food_benefits_leaders.remove-benefit.postulation-management');

        // Rutas para la vista postulation-management(LIDER BENEFICIO DE TRANSPORTE)
        Route::get('/transportation_benefits_leader/postulation-management', 'PostulationBenefitController@index')->name('bienestar.transportation_benefits_leader.view.postulation-management');
        Route::get('/transportation_benefits_leader/postulation-management/{id}', 'PostulationBenefitController@show')->name('bienestar.transportation_benefits_leader.show.postulation-management');
        Route::post('/transportation_benefits_leader/postulation-management/update-benefits', 'PostulationBenefitController@updateStateBenefit')->name('bienestar.transportation_benefits_leader.update-benefits.postulation-management');
        Route::get('/transportation_benefits_leader/postulation-management/remove_benefit/{postulationId}', 'PostulationBenefitController@remove_benefit')->name('bienestar.transportation_benefits_leader.remove-benefit.postulation-management');


        //Vistas Rutas de transporte(ADMINISTRADOR)
        Route::get('/admin/transportroutes', 'RoutesTransportationController@index')->name('bienestar.admin.transportation.crud.transportroutes');
        Route::post('/admin/transportroutes/add', 'RoutesTransportationController@store')->name('bienestar.admin.save.transportroutes');
        Route::delete('/admin/transportroutes/delete/{id}', 'RoutesTransportationController@destroy')->name('bienestar.admin.delete.transportroutes');
        Route::put('/admin/transportroutes/update/{id}', 'RoutesTransportationController@update')->name('bienestar.admin.edit.transportroutes');
        //Vistas Rutas de transporte(LIDER BENEFICIO DE TRANSPORTE)
        Route::get('/transportation_benefits_leader/transportroutes', 'RoutesTransportationController@index')->name('bienestar.transportation_benefits_leader.transportation.crud.transportroutes');
        Route::post('/transportation_benefits_leader/transportroutes/add', 'RoutesTransportationController@store')->name('bienestar.transportation_benefits_leader.save.transportroutes');
        Route::delete('/transportation_benefits_leader/transportroutes/delete/{id}', 'RoutesTransportationController@destroy')->name('bienestar.transportation_benefits_leader.delete.transportroutes');
        Route::put('/transportation_benefits_leader/transportroutes/update/{id}', 'RoutesTransportationController@update')->name('bienestar.transportation_benefits_leader.edit.transportroutes');

        // vista de conductores(ADMINISTRADOR)
        Route::get('/admin/drivers', 'BusDriversController@drivers')->name('bienestar.admin.transportation.crud.drivers');
        Route::post('/admin/drivers/add', 'BusDriversController@driversAdd')->name('bienestar.admin.save.drivers');
        Route::put('/admin/drivers/update/{id}', 'BusDriversController@driversUp')->name('bienestar.admin.edit.drivers');
        Route::delete('/admin/drivers/delete/{id}', 'BusDriversController@delete')->name('bienestar.admin.delete.drivers');
        // vista de conductores(LIDER BENEFICIO DE TRANSPORTE)
        Route::get('/transportation_benefits_leader/drivers', 'BusDriversController@drivers')->name('bienestar.transportation_benefits_leader.transportation.crud.drivers');
        Route::post('/transportation_benefits_leader/drivers/add', 'BusDriversController@driversAdd')->name('bienestar.transportation_benefits_leader.save.drivers');
        Route::put('/transportation_benefits_leader/drivers/update/{id}', 'BusDriversController@driversUp')->name('bienestar.transportation_benefits_leader.edit.drivers');
        Route::delete('/transportation_benefits_leader/drivers/delete/{id}', 'BusDriversController@delete')->name('bienestar.transportation_benefits_leader.delete.drivers');

        // vista de gestiones de convocatorias(ADMINISTRADOR)
        Route::get('/admin/convocations', 'ConvocationsController@index')->name('bienestar.admin.convocations.crud.convocations');
        Route::post('/admin/convocations/store', 'ConvocationsController@store')->name('bienestar.admin.save.convocations');
        Route::delete('/admin/convocations/delete/{id}', 'ConvocationsController@destroy')->name('bienestar.admin.delete.convocations');
        Route::put('/admin/convocations/update/{id}', 'ConvocationsController@update')->name('bienestar.admin.edit.convocations');
         // vista de gestiones de convocatorias(LIDER BENEFICIO DE ALIMENTACION)
         Route::get('/food_benefits_leaders/convocations', 'ConvocationsController@index')->name('bienestar.food_benefits_leaders.convocations.crud.convocations');
         Route::post('/food_benefits_leaders/convocations/store', 'ConvocationsController@store')->name('bienestar.food_benefits_leaders.save.convocations');
         Route::delete('/food_benefits_leaders/convocations/delete/{id}', 'ConvocationsController@destroy')->name('bienestar.food_benefits_leaders.delete.convocations');
         Route::put('/food_benefits_leaders/convocations/update/{id}', 'ConvocationsController@update')->name('bienestar.food_benefits_leaders.edit.convocations');
        // vista de gestiones de convocatorias(LIDER BENEFICIO DE TRANSPORTE)
        Route::get('/transportation_benefits_leader/convocations', 'ConvocationsController@index')->name('bienestar.transportation_benefits_leader.convocations.crud.convocations');
        Route::post('/transportation_benefits_leader/convocations/store', 'ConvocationsController@store')->name('bienestar.transportation_benefits_leader.save.convocations');
        Route::delete('/transportation_benefits_leader/convocations/delete/{id}', 'ConvocationsController@destroy')->name('bienestar.transportation_benefits_leader.delete.convocations');
        Route::put('/transportation_benefits_leader/convocations/update/{id}', 'ConvocationsController@update')->name('bienestar.transportation_benefits_leader.edit.convocations');

        //Vista crud formularios(ADMINISTRADOR)
        Route::get('/admin/editforms', 'ConvocationsQuestionsController@editform')->name('bienestar.admin.convocations.crud.editform');
        Route::get('/admin/editforms/marked_questions', 'ConvocationsQuestionsController@showForm')->name('bienestar.admin.convocations.marked_questions.editform');
        Route::post('/admin/saveform', 'ConvocationsQuestionsController@saveform')->name('bienestar.admin.saveform.editform');
        Route::post('/admin/delete_question_call', 'ConvocationsQuestionsController@deleteQuestionCall')->name('bienestar.admin.delete_question_call.editform');
        Route::post('/admin/editforms/update/{id}', 'ConvocationsQuestionsController@updateQuestion')->name('bienestar.admin.edit.editform');
        Route::post('/admin/editforms/addAnswer', 'ConvocationsQuestionsController@updateAnswer')->name('bienestar.admin.add.answer.editform');
        Route::delete('/admin/delete/question/{id}', 'ConvocationsQuestionsController@deleteQuestion')->name('bienestar.admin.delete.question.editform');
        Route::delete('/admin/delete/question/answer/{id}', 'ConvocationsQuestionsController@deleteAnswer')->name('bienestar.admin.delete.answer.editform');
        Route::get('/admin/addquestions', 'ConvocationsQuestionsController@add_question')->name('bienestar.admin.add_question.editform');
        Route::post('/admin/addquestions/add_answer', 'ConvocationsQuestionsController@add_answer')->name('bienestar.admin.save.editform');
        //Vista crud formularios(LIDER BENEFICIO DE ALIMENTACION)
        Route::get('/food_benefits_leaders/editforms', 'ConvocationsQuestionsController@editform')->name('bienestar.food_benefits_leaders.convocations.crud.editform');
        Route::get('/food_benefits_leaders/editforms/marked_questions', 'ConvocationsQuestionsController@showForm')->name('bienestar.food_benefits_leaders.convocations.marked_questions.editform');
        Route::post('/food_benefits_leaders/saveform', 'ConvocationsQuestionsController@saveform')->name('bienestar.food_benefits_leaders.saveform.editform');
        Route::post('/food_benefits_leaders/delete_question_call', 'ConvocationsQuestionsController@deleteQuestionCall')->name('bienestar.food_benefits_leaders.delete_question_call.editform');
        Route::post('/food_benefits_leaders/editforms/update/{id}', 'ConvocationsQuestionsController@updateQuestion')->name('bienestar.food_benefits_leaders.edit.editform');
        Route::delete('/food_benefits_leaders/delete/question/{id}', 'ConvocationsQuestionsController@deleteQuestion')->name('bienestar.food_benefits_leaders.delete.question.editform');
        Route::delete('/food_benefits_leaders/delete/question/answer/{id}', 'ConvocationsQuestionsController@deleteAnswer')->name('bienestar.food_benefits_leaders.delete.answer.editform');
        Route::get('/food_benefits_leaders/addquestions', 'ConvocationsQuestionsController@add_question')->name('bienestar.food_benefits_leaders.add_question.editform');
        Route::post('/food_benefits_leaders/addquestions/add_answer', 'ConvocationsQuestionsController@add_answer')->name('bienestar.food_benefits_leaders.save.editform');
        //Vista crud formularios(LIDER BENEFICIO DE TRANSPORTE)
        Route::get('/transportation_benefits_leader/editforms', 'ConvocationsQuestionsController@editform')->name('bienestar.transportation_benefits_leader.convocations.crud.editform');
        Route::get('/food_benefits_leaders/editforms/marked_questions', 'ConvocationsQuestionsController@showForm')->name('bienestar.transportation_benefits_leader.convocations.marked_questions.editform');
        Route::post('/transportation_benefits_leader/saveform', 'ConvocationsQuestionsController@saveform')->name('bienestar.transportation_benefits_leader.saveform.editform');
        Route::post('/transportation_benefits_leader/delete_question_call', 'ConvocationsQuestionsController@deleteQuestionCall')->name('bienestar.transportation_benefits_leader.delete_question_call.editform');
        Route::post('/transportation_benefits_leader/editforms/update/{id}', 'ConvocationsQuestionsController@updateQuestion')->name('bienestar.transportation_benefits_leader.edit.editform');
        Route::delete('/transportation_benefits_leader/delete/question/{id}', 'ConvocationsQuestionsController@deleteQuestion')->name('bienestar.transportation_benefits_leader.delete.question.editform');
        Route::delete('/transportation_benefits_leader/delete/question/answer/{id}', 'ConvocationsQuestionsController@deleteAnswer')->name('bienestar.transportation_benefits_leader.delete.answer.editform');
        Route::get('/transportation_benefits_leader/addquestions', 'ConvocationsQuestionsController@add_question')->name('bienestar.transportation_benefits_leader.add_question.editform');
        Route::post('/transportation_benefits_leader/addquestions/add_answer', 'ConvocationsQuestionsController@add_answer')->name('bienestar.transportation_benefits_leader.save.editform');


        // Vista De Consulta(Publica)
        Route::get('/callconsultation', 'CallConsultationController@index')->name('cefa.bienestar.callconsultation');
        Route::post('/callconsultation/search-postulation', 'CallConsultationController@search')->name('cefa.bienestar.searchPostulation');

        // Vista de Postulaciones(Publica)
        Route::get('/postulations', 'PostulationsController@index')->name('cefa.bienestar.postulations');
        Route::post('/postulations/search', 'PostulationsController@search')->name('cefa.bienestar.search');
        Route::post('/postulations/search/getquestions', 'PostulationsController@getquestions')->name('cefa.bienestar.search_questions');
        Route::post('/postulations/search/getallquestions', 'PostulationsController@getallquestions')->name('cefa.bienestar.search_all_questions');
        Route::post('/postulations/save', 'PostulationsController@savepostulation')->name('cefa.bienestar.savepostulation');

        //vista el listados apoyo alimentacion(ADMINISTRADOR)
        Route::get('/admin/foodrecord', 'AssistancesFoodsController@index')->name('bienestar.admin.food.crud.beneficiaries_food');
        Route::get('/admin/assistancefood', 'AssistancesFoodsController@assistancefoodrecord')->name('bienestar.admin.food.view.food_assistance_lists');
        Route::get('/admin/filtro-porcentaje', 'AssistancesFoodsController@filtrarPorcentaje')->name('bienestar.admin.route.food_assistance_lists.filter');
        //vista el listados apoyo alimentacion(LIDER BENEFICIO DE ALIMENTACION)
        Route::get('/food_benefits_leaders/foodrecord', 'AssistancesFoodsController@index')->name('bienestar.food_benefits_leaders.food.crud.beneficiaries_food');
        Route::get('/food_benefits_leaders/assistancefood', 'AssistancesFoodsController@assistancefoodrecord')->name('bienestar.food_benefits_leaders.food.view.food_assistance_lists');
        Route::get('/food_benefits_leaders/filtro-porcentaje', 'AssistancesFoodsController@filtrarPorcentaje')->name('bienestar.food_benefits_leaders.route.food_assistance_lists.filter');
        //Vistas Asignar Rutas de transporte
        Route::get('/admin/assign-transportation-routes', 'AssingTransportRoutesController@mostrarAsignaciones')->name('bienestar.admin.transportation.view.assign_transport_route');
        Route::get('/assign-transportation-routes/{apprenticeId}', 'AssingTransportRoutesController@showAssignmentForm')->name('cefa.bienestar.assign-transportation-routes');

        //Vista de Formulario de asignacion de rutas de transporte(ADMINISTRADOR)
        Route::get('/admin/assing-form-transportation-routes', 'AssingFormTransporRoutesController@index')->name('bienestar.admin.transportation.view.assing_form_transportation_routes');
        Route::put('/admin/assing-form-transportation-routes/updateInline', 'AssingFormTransporRoutesController@updateInline')->name('bienestar.admin.updateInline.assing_form_transportation_routes');
        //Vista de Formulario de asignacion de rutas de transporte(LIDER BENEFICIO DE TRANSPORTE)
        Route::get('/transportation_benefits_leader/assing-form-transportation-routes', 'AssingFormTransporRoutesController@index')->name('bienestar.transportation_benefits_leader.transportation.view.assing_form_transportation_routes');
        Route::put('/transportation_benefits_leader/assing-form-transportation-routes/updateInline', 'AssingFormTransporRoutesController@updateInline')->name('bienestar.transportation_benefits_leader.updateInline.assing_form_transportation_routes');

        //vista de listado lista de asistencia de transporte(ADMINISTRADOR)
        route::get('/admin/transportation_assistance_list', 'TransportationAssistancesController@index')->name('bienestar.admin.transportation.view.transportation_assistance_lists');
        Route::post('/admin/search/filter', 'TransportationAssistancesController@search')->name('bienestar.admin.view.transportation_assistance_lists.consult');
        Route::get('/admin/attendance_report', 'TransportationAssistancesController@Attendance_failures')->name('bienestar.admin.attendance_report.transportation_assistance_lists.consult');
        Route::get('/admin/failure_reporting', 'TransportationAssistancesController@Failure_reporting')->name('bienestar.admin.failure_reporting.transportation_assistance_lists.consult');
        Route::get('/admin/failure_reporting/store', 'TransportationAssistancesController@Failure_reporting_store')->name('bienestar.admin.failure_reporting.transportation_assistance_lists.store');
        //vista de listado lista de asistencia de transporte(LIDER BENEFICIO DE TRANSPORTE)
        route::get('/transportation_benefits_leader/transportation_assistance_list', 'TransportationAssistancesController@index')->name('bienestar.transportation_benefits_leader.transportation.view.transportation_assistance_lists');
        Route::post('/transportation_benefits_leader/busqueda/documentos', 'TransportationAssistancesController@search')->name('bienestar.transportation_benefits_leader.view.transportation_assistance_lists.consult');
        Route::get('/transportation_benefits_leader/attendance_report', 'TransportationAssistancesController@Attendance_failures')->name('bienestar.transportation_benefits_leader.attendance_report.transportation_assistance_lists.consult');
        Route::get('/transportation_benefits_leader/failure_reporting', 'TransportationAssistancesController@Failure_reporting')->name('bienestar.transportation_benefits_leader.failure_reporting.transportation_assistance_lists.consult');
        
        //Vista transportation-assistance
        Route::get('/admin/transportation_asistance', 'TransportationAssistancesController@indexasistances')->name('bienestar.admin.transportation.view.asistance_transport');
        Route::post('/admin/transportation_asistance/search', 'TransportationAssistancesController@searchapprentice')->name('bienestar.admin.form.asistance_transport');
        //Vista transportation-assistance(LIDER BENEFICIO DE TRANSPORTE)
        Route::get('/transportation_benefits_leader/transportation_asistance', 'TransportationAssistancesController@indexasistances')->name('bienestar.transportation_benefits_leader.transportation.view.asistance_transport');
        Route::post('/transportation_benefits_leader/transportation_asistance/search', 'TransportationAssistancesController@searchapprentice')->name('bienestar.transportation_benefits_leader.form.asistance_transport');

        //Vista foood-assistance(ADMINISTRADOR)
        Route::get('/admin/food_assistance', 'AssistancesFoodsController@food_assitances')->name('bienestar.admin.food.view.food_assistance');
        Route::post('/admin/food_assistance/search', 'AssistancesFoodsController@assistances')->name('bienestar.admin.form.food_assistance');
        //Vista foood-assistance(LIDER BENEFICIO DE ALIMENTACION)
        Route::get('/food_benefits_leaders/food_assistance', 'AssistancesFoodsController@food_assitances')->name('bienestar.food_benefits_leaders.food.view.food_assistance');
        Route::post('/food_benefits_leaders/food_assistance/search', 'AssistancesFoodsController@assistances')->name('bienestar.food_benefits_leaders.form.food_assistance');
    });
});