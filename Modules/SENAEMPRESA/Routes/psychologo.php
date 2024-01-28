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



Route::middleware(['lang'])->group(function () {
    //Route::middleware(['lang'])->group(function(){
    Route::prefix('senaempresa')->group(function () {

        //RUTAS COMO APRENDIZ
        Route::prefix('psychologo')->group(function () {
            Route::get('/', 'SENAEMPRESAController@psychologo')->name('senaempresa.psychologo.index');
            Route::get('manual/', 'SENAEMPRESAController@manual_psychologo')->name('senaempresa.psychologo.manual_psychologo');

            //RUTAS PARA LA VISUALIZACIÓN Y LA ASIGNACIÓN DE PUNTAJE A LOS POSTULADOS A LAS VACANTES DE SENAEMPRESA
            Route::prefix('postulates')->group(function () {
                Route::get('/', 'PostulateController@postulates')->name('senaempresa.psychologo.postulates.index');
                Route::get('/assign_score/{apprenticeId}/{vacancyId}', 'PostulateController@assign_score')->name('senaempresa.psychologo.postulates.assign_score');
                Route::post('/score_assigned', 'PostulateController@score_assigned')->name('senaempresa.psychologo.postulates.score_assigned');

                Route::get('/state/{apprenticeId}', 'PostulateController@state')->name('senaempresa.psychologo.postulates.state');
                Route::post('/state_updated', 'PostulateController@state_updated')->name('senaempresa.psychologo.postulates.state_updated');
            });
        });
    });
});
