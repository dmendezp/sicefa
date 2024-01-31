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
            // Rutas Para Hacer Solicitudes
            Route::get('/index/solicitar', 'ParkingController@getSolicitarAdd')->name('cefa.parking.solicitar');
            Route::post('/index/solicitar', 'ParkingController@postSolicitarAdd')->name('cefa.parking.guardar');
            // Rutas Buscar Persona
            Route::post('/index/solicitar/search', 'ParkingController@postSolicitarSearch')->name('cefa.parking.solicitar.search');
            // Rutas Municipios
            Route::post('/index/solicitar/municipios/search', 'ParkingController@postMunicipiosSearch')->name('cefa.parking.solicitar.municipios.search');
        });

        // Ruta Para Vista Desarrolladores
        Route::controller(DevelopersController::class)->group(function(){
            Route::get('/developer', 'developer')->name('cefa.hangarauto.developers');
        });

        Route::controller(RevisionesController::class)->group(function(){
            // Ruta Vista Tecnomecanica
            Route::get('/administrator/tecnomecanica', 'RevisionesController@tecnomecanica')->name('cefa.parking.tecnomecanica');
            // Rutas Para Agregar Registros De Tecnomecanica
            Route::get('/tecnomecanica/add', 'RevisionesController@getTecnomecanicaAdd')->name('cefa.parking.tecnomecanica.add');
            Route::post('/tecnomecanica/add', 'RevisionesController@postTecnomecanicaAdd')->name('cefa.parking.tecnomecanica.add');
            Route::get('/tecnomecanica/delete/{id}', 'RevisionesController@getTecnomecanicaDelete')->name('cefa.parking.tecnomecanica.delete');

            // Ruta Vista SOAT
            Route::get('/administrator/SOAT', 'RevisionesController@seguroobligatorio')->name('cefa.parking.soat');
            // Rutas Para Agregar Registros De Soat
            Route::get('/SOAT/add', 'RevisionesController@getSoatAdd')->name('cefa.parking.soat.add');
            Route::post('/SOAT/add', 'RevisionesController@postSoatAdd')->name('cefa.parking.soat.add');
            Route::get('/SOAT/Delete/{id}', 'RevisionesController@getSoatDelete')->name('cefa.parking.soat.delete');
        });
        
        Route::controller(VehiculosController::class)->group(function(){
            // Ruta Para Vista De Vehiculos
            Route::get('/administrador/vehiculos', 'VehiculosController@Vehicles')->name('cefa.parking.vehicles');
            // Rutas Para Agregar Un Vehiculo
            Route::post('/administrador/vehiculos/crear', 'VehiculosController@postVehiclesAdd')->name('parking.admin.vehicles.create');
            Route::get('/administrador/vehiculos/crear', 'VehiculosController@getVehiclesAdd')->name('parking.admin.vehicles.create');
            // Rutas Para Editar Informacion De Un Vehiculo
            Route::get('/administrator/vehiculos/edit/{id}', 'VehiculosController@getViajesEdit')->name('parking.amdin.vehicles.edit');
            Route::post('/administrator/vehiculos/edit/{id}', 'VehiculosController@postViajesEdit')->name('parking.admin.vechicles.edit');
            // Ruta Para Eliminar Un Vehiculo
            Route::get('/administrator/vehiculos/delete/{id}', 'VehiculosController@getVehiclesDelete')->name('parking.admin.vehicles.delete');
        });
        
        Route::controller(DriversController::class)->group(function(){
            // Rutas Para Vista Conductores
            Route::get('/administrator/conductores', 'DriversController@conductores')->name('cefa.parking.drivers');
            // Ruta Para El Crud Conductores
            Route::post('/administrator/conductores/create', 'DriversController@postCreateAdd')->name('parking.admin.create');
            Route::get('/administrator/conductores/create', 'DriversController@getCreateAdd')->name('parking.admin.create');
            Route::post('/administrator/conductores/search', 'DriversController@postDriversSearch')->name('parking.admin.drivers.search');
            // Rutas Para Editar Informacion De Los Conductores
            // Route::get('/administrator/conductores/edit/{id}', 'DriversController@getDriverEdit')->name('parking.admin.drivers.edit');
            // Route::post('/administrator/conductores/edit/{id}', 'DriversController@postDriversEdit')->name('parking.admin.drivers.ediet');
            // Ruta Para Eliminar Los Conductores
            Route::get('/administrator/conductores/delete/{id}', 'DriversController@getDriversDelete')->name('parking.admin.drivers.delete');
        });
    });
});
