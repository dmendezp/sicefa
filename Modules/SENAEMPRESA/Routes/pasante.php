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
        Route::prefix('passant')->group(function () {
            Route::get('/', 'SENAEMPRESAController@passant')->name('senaempresa.passant.index');
            
            //RUTAS PARA LA VISUALIZACIÓN DE LAS FASES DE SENAEMPRESA
            Route::prefix('phases')->group(function () {
                Route::get('/', 'SENAEMPRESAController@phases')->name('senaempresa.passant.phases.index');
            });

            //RUTAS PARA LA VISUALIZACIÓN DEL PERSONAL DE SENAEMPRESA
            Route::prefix('staff')->group(function () {
                Route::get('/', 'StaffSenaempresaController@staff')->name('senaempresa.passant.staff.index');
            });
        });
    });
});
