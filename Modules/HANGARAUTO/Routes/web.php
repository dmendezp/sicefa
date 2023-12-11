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
    Route::prefix('hangarauto')->group(function () {

        // Ruta Para Abrir Vista Index
        Route::controller(HANGARAUTOController::class)->group(function(){
            Route::get('/index', 'index')->name('cefa.hangarauto.index');
        });

        // Ruta Para Vista Desarrolladores
        Route::controller(DevelopersController::class)->group(function(){
            Route::get('/developer', 'developer')->name('cefa.hangarauto.developers');
        });

        // Rutas Para Hacer Solicitudes
        Route::controller(SolicitudController::class)->group(function(){
            Route::get('/Inicio/solicitar', 'getSolicitarAdd')->name('hangarauto.solicitar');
            // Ruta Buscar Persona
            Route::get('/Inicio/solicitar/search', 'postSolicitarSearch')->name('cefa.solicitar.search');
        });
    });
});
