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
        //RUTAS COMO PASANTE
        Route::prefix('pasante')->group(function () {
            Route::get('/', 'CompanyController@Pasante')->name('senaempresa.pasante.index');
            //RUTAS PARA LA VISUALIZACIÓN DE LAS FASES DE SENAEMPRESA
            Route::prefix('phases')->group(function () {
                Route::get('/', 'SENAEMPRESAController@phases')->name('senaempresa.admin.phases.index');
            });
        });
    });
});
