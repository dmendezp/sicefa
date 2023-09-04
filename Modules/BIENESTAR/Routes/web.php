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

Route::prefix('bienestar')->group(function() {
    Route::get('/', 'BIENESTARController@index');
});

Route::prefix('/bienestar')->group(function() {
    //vista home
    Route::get('/home', 'BIENESTARController@home')->name('bienestar.home');

    //vistas de prueba
    Route::get('/APEformulario', 'BIENESTARController@APEformulario')->name('bienestar.APEformulario');
    Route::get('/SCANrutas', 'BIENESTARController@SCANrutas')->name('bienestar.SCANrutas');
    Route::get('/SCANrestorant', 'BIENESTARController@SCANrestorant')->name('bienestar.SCANrestorant');
    Route::get('/LIDrutas', 'BIENESTARController@LIDrutas')->name('bienestar.LIDrutas');
    Route::get('/home', 'BIENESTARController@home')->name('bienestar.home');
    Route::get('/HISeventos', 'BIENESTARController@HISeventos')->name('bienestar.HISeventos');
    Route::get('/APEtransporte', 'BIENESTARController@APEtransporte')->name('bienestar.APEtransporte');
    Route::get('/APEsena', 'BIENESTARController@APEsena')->name('bienestar.APEsena');
    Route::get('/APEinterno', 'BIENESTARController@APEinterno')->name('bienestar.APEinterno');
    Route::get('/LIDretorant', 'BIENESTARController@LIDretorant')->name('bienestar.LIDretorant');
    Route::get('/APEalimentacion', 'BIENESTARController@APEalimentacion')->name('bienestar.APEalimentacion');
   
   //Vista Crud Beneficio
    Route::get('/benefits', 'BenefitsController@BenefitsView')->name('bienestar.benefits');
    Route::delete('/benefits/delete/{id}', 'BenefitsController@delete')->name('bienestar.benefits.delete');
    Route::post('/benefits/add', 'BenefitsController@BenefitsViewAdd')->name('bienestar.benefits.add');
    Route::put('/benefits/update/{id}','BenefitsController@update')->name('bienestar.benefits.update');
    Route::post('/benefits/update/{id}', 'BenefitsController@update')->name('benefits.update');

     //Vista CRUD Buses
     Route::get('/buses', 'BusesController@index')->name('bienestar.buses');
     Route::post('/buses/store', 'BusesController@store')->name('bienestar.buses.store');
     Route::delete('/buses/delete/{id}', 'BusesController@destroy')->name('bienestar.buses.destroy');
     Route::put('/buses/update/{id}', 'BusesController@update')->name('bienestar.buses.update');

      // Vista CRUD tipo de beneficios
    Route::get('/typeofbenefits', 'TypesOfBenefitsController@typeofbenefits')->name('bienestar.typeofbenefits');
    Route::post('/typeofbenefits/create', 'TypesOfBenefitsController@store')->name('typeofbenefits.store');
    Route::delete('/typeofbenefits/{id}', 'TypesOfBenefitsController@destroy')->name('typeofbenefits.destroy');
    Route::put('/bienestar/typeofbenefits/{id}', 'TypesOfBenefitsController@update')->name('typeofbenefits.update');
    Route::get('/transportroutes','TransportroutesController@transportroutes')->name('bienestar.transportroutes');


    // Vista CRUD Pivota
    Route::get('/benefitstypeofbenefits', 'BenefitsTypesOfBenefitsController@benefitstypeofbenefits')->name('bienestar.benefitstypeofbenefits');
    Route::post('/benefitstypeofbenefits', 'BenefitsTypesOfBenefitsController@store')->name('bienestar.benefitstypeofbenefits.store');
    Route::put('/benefitstypeofbenefits/{id}', 'BenefitsTypesOfBenefitsController@update')->name('bienestar.benefitstypeofbenefits.update');
    Route::delete('/benefitstypeofbenefits/{id}', 'BenefitsTypesOfBenefitsController@destroy')->name('benefitstypeofbenefits.destroy');

    // Rutas para la vista postulation
    Route::get('/postulations', 'PostulationsController@index')->name('bienestar.postulations.index');
    Route::get('/postulations/{id}', 'PostulationsController@show')->name('bienestar.postulations.show');
    Route::get('/postulations/modal/{id}', 'PostulationsController@showModal')->name('bienestar.postulations.modal');
    Route::post('/update-postulation-score/{id}', 'PostulationsController@updateScore')->name('bienestar.postulations.update-score');
    Route::post('/mark-beneficiaries', 'TuController@markBeneficiaries')->name('bienestar.mark-beneficiaries');
    Route::post('/assign-benefits', 'PostulationsController@assignBenefits')->name('bienestar.postulations.assign-benefits');
    Route::get('/convocatoria', 'ConvocationsController@convocatoria')->name('convocatoria');
    Route::post('/bienestar/assign-benefits', 'PostulationsController@assignBenefits')->name('bienestar.postulations.assign-benefits');
    Route::put('bienestar/postulations/update-state/{id}', 'PostulationsController@updateState')->name('bienestar.postulations.update-state');
    Route::post('/bienestar/postulations/create', 'PostulationsController@create')->name('bienestar.postulations.create');
    Route::post('bienestar/postulations/mark-as-beneficiaries', 'PostulationsController@markAsBeneficiaries')->name('bienestar.postulations.mark-as-beneficiaries');

    
    
    //Vistas Rutas de transporte
    Route::get('/transportroutes','RoutesTransportationsController@transportroutes')->name('bienestar.transportroutes');
    Route::post('/transportroutes/add','RoutesTransportationsController@transportroutesAdd')->name('bienestar.transportroutes.add');
    Route::get('/LisRutas', 'RoutesTransportationsController@LisRutas')->name('bienestar.LisRutas');

    // vista de conductores
    Route::get('/Drivers_view', 'BusDriversController@Drivers_view')->name('bienestar.Drivers_view');
    Route::post('/Drivers_view/add', 'BusDriversController@Drivers_viewAdd')->name('bienestar.Driversw.add');
    Route::put('/Drivers_view/update/{id}', 'BusDriversController@Drivers_viewUp')->name('bienestar.Drivers.update');
    Route::delete('/Drivers_view/delete/{id}', 'BusDriversController@delete')->name('bienestar.Drivers.delete');


});
    


