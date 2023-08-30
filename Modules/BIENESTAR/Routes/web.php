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
    Route::get('/APEalimentacion', 'BIENESTARController@APEalimentacion')->name('bienestar.APEalimentacion');
});

Route::prefix('/bienestar')->group(function() {
    Route::get('/APEinterno', 'BIENESTARController@APEinterno')->name('bienestar.APEinterno');
});

Route::prefix('/bienestar')->group(function() {
    Route::get('/APEsena', 'BIENESTARController@APEsena')->name('bienestar.APEsena');
});
Route::prefix('/bienestar')->group(function() {
    Route::get('/APEtransporte', 'BIENESTARController@APEtransporte')->name('bienestar.APEtransporte');
});
Route::prefix('/bienestar')->group(function() {
    Route::get('/HISeventos', 'BIENESTARController@HISeventos')->name('bienestar.HISeventos');
});
Route::prefix('/bienestar')->group(function() {
    Route::get('/home', 'BIENESTARController@home')->name('bienestar.home');
});
Route::prefix('/bienestar')->group(function() {
    Route::get('/LIDretorant', 'BIENESTARController@LIDretorant')->name('bienestar.LIDretorant');
});
Route::prefix('/bienestar')->group(function() {
    Route::get('/LIDrutas', 'BIENESTARController@LIDrutas')->name('bienestar.LIDrutas');
});
Route::prefix('/bienestar')->group(function() {
    Route::get('/SCANrestorant', 'BIENESTARController@SCANrestorant')->name('bienestar.SCANrestorant');
});
Route::prefix('/bienestar')->group(function() {
    Route::get('/SCANrutas', 'BIENESTARController@SCANrutas')->name('bienestar.SCANrutas');
});
Route::prefix('/bienestar')->group(function() {
    Route::get('/APEformulario', 'BIENESTARController@APEformulario')->name('bienestar.APEformulario');
});
Route::prefix('/bienestar')->group(function() {
    Route::get('/home', 'BIENESTARController@home')->name('bienestar.home');
   
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


        //Vistas Rutas de transporte
    Route::get('/transportroutes','RoutesTransportationsController@transportroutes')->name('bienestar.transportroutes');
    Route::post('/transportroutes/add','RoutesTransportationsController@transportroutesAdd')->name('bienestar.transportroutes.add');
});
Route::prefix('/bienestar')->group(function() {
    Route::get('/LisRutas', 'RoutesTransportationsController@LisRutas')->name('bienestar.LisRutas');
});

