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
        Route::controller(ParkingController::class)->group(function(){
            Route::get('/index', 'ParkingController@index')->name('cefa.parking.index');
        });

        // Ruta Para Vista Desarrolladores
        Route::controller(DevelopersController::class)->group(function(){
            Route::get('/developer', 'developer')->name('cefa.hangarauto.developers');
        });

        // Rutas Para Hacer Solicitudes
        Route::get('/index/solicitar', 'ParkingController@getSolicitarAdd')->name('cefa.parking.solicitar');
        Route::post('/index/solicitar', 'ParkingController@postSolicitarAdd')->name('cefa.parking.guardar');
        // Rutas Buscar Persona
        Route::post('/index/solicitar/search', 'ParkingController@postSolicitarSearch')->name('cefa.parking.solicitar.search');
        // Rutas Municipios
        Route::post('/index/solicitar/municipios/search', 'ParkingController@postMunicipiosSearch')->name('cefa.parking.solicitar.municipios.search');

        // Rutas Para Agregar Registros De Tecnomecanica
        Route::get('/tecnomecanica/add', 'RevisionesController@getTecnomecanicaAdd')->name('cefa.parking.tecnomecanica.add');
        Route::post('/tecnomecanica/add', 'RevisionesController@postTecnomecanicaAdd')->name('cefa.parking.tecnomecanica.add');
        Route::get('/tecnomecanica/delete/{id}', 'RevisionesController@getTecnomecanicaDelete')->name('cefa.parking.tecnomecanica.delete');

        // Rutas Para Agregar Registros De Soat
        Route::get('/SOAT/add', 'RevisionesController@getSoatAdd')->name('cefa.parking.soat.add');
        Route::post('/SOAT/add', 'RevisionesController@postSoatAdd')->name('cefa.parking.soat.add');
        Route::get('/SOAT/Delete/{id}', 'RevisionesController@getSoatDelete')->name('cefa.parking.soat.delete');

        // Ruta Para Vista De Vehiculos
        Route::get('/administrador/vehiculos', 'VehiculosController@Vehicles')->name('cefa.parking.vehicles');
        Route::post('/administrador/vehiculos/crear', 'VehiculosController@postVehiclesAdd')->name('parking.admin.vehicles.create');
        Route::get('/administrador/vehiculos/crear', 'VehiculosController@getVehiclesAdd')->name('parking.admin.vehicles.create');
    });
});
