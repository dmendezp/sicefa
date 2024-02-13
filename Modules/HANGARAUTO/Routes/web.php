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
        // Ruta Para Vista Index
        Route::controller(HangarAutoController::class)->group(function(){
            Route::get('/index', 'index')->name('cefa.hangarauto.index');
            Route::get('admin/index', 'index')->name('hangarauto.admin.index');
            Route::get('charge/index', 'index')->name('hangarauto.charge.index');
        });

        // Ruta Para Abrir Vista Index
        Route::controller(ParkingController::class)->group(function(){
            // Rutas Para Hacer Solicitudes
            Route::get('/index/solicitar', 'ParkingController@getSolicitarAdd')->name('cefa.parking.solicitar');
            Route::post('/index/solicitar', 'ParkingController@postSolicitarAdd')->name('cefa.parking.guardar');
            // Rutas Buscar Persona
            Route::post('/index/solicitar/search', 'ParkingController@postSolicitarSearch')->name('cefa.parking.solicitar.search');
            // Rutas Municipios
            Route::post('/index/solicitar/municipios/search', 'ParkingController@postMunicipiosSearch')->name('cefa.parking.solicitar.municipios.search');

            /*Ruta Del CRUD Del Formulario De Registro */
            Route::get('/admin/tabla', 'ParkingController@table')->name('cefa.parking.table');
            Route::get('/charge/tabla', 'ParkingController@table')->name('cefa.charge.table');
            Route::delete('admin/resulform/delete/{id}', 'ParkingController@delete')->name('cefa.parking.delete');
            Route::delete('charge/resulform/delete/{id}', 'delete')->name('cefa.charge.delete');
            Route::get('/admin/hangarauto/edit/{labor}', 'edit')->name('cefa.parking.edit');
        });

        Route::controller(RevisionesController::class)->group(function(){
            // Ruta Vista Tecnomecanica
            Route::get('/administrator/tecnomecanica', 'RevisionesController@tecnomecanica')->name('hangarauto.admin.tecnomecanica');
            Route::get('/administrator/tecnomecanica/add', 'RevisionesController@getTecnomecanicaAdd')->name('hangarauto.admin.tecnomecanica.add');
            Route::post('/administrator//tecnomecanica/add', 'RevisionesController@postTecnomecanicaAdd')->name('hangarauto.admin.tecnomecanica.add');
            Route::get('/administrator//tecnomecanica/delete/{id}', 'RevisionesController@getTecnomecanicaDelete')->name('hangarauto.admin.tecnomecanica.delete');

            // Ruta Vista SOAT
            Route::get('/administrator/SOAT', 'RevisionesController@seguroobligatorio')->name('hangarauto.admin.soat');
            Route::get('/administrator//SOAT/add', 'RevisionesController@getSoatAdd')->name('hangarauto.admin.soat.add');
            Route::post('/administrator//SOAT/add', 'RevisionesController@postSoatAdd')->name('hangarauto.admin.soat.add');
            Route::get('/administrator//SOAT/Delete/{id}', 'RevisionesController@getSoatDelete')->name('hangarauto.admin.soat.delete');

            // Ruta Vista Consumo
            Route::get('/administrator/consumo', 'RevisionesController@consumo')->name('hangarauto.admin.consumo');
            Route::post('/administrator/consumo/add', 'RevisionesController@postConsumoAdd')->name('hangarauto.admin.consumo.add');
            Route::get('/administrator/consumo/Delete/{id}', 'RevisionesController@getConsumoDelete')->name('hangarauto.admin.consumo.delete');
        });
        
        Route::controller(VehiculosController::class)->group(function(){
            // Ruta Para Vista De Vehiculos
            Route::get('/administrador/vehiculos', 'VehiculosController@Vehicles')->name('hangarauto.admin.vehicles');
            Route::post('/administrador/vehiculos/crear', 'VehiculosController@postVehiclesStore')->name('hangarauto.admin.vehicles.store');
            // Route::get('/administrador/vehiculos/crear', 'VehiculosController@getVehiclesAdd')->name('cefa.parking.admin.vehicles.create');
            // Rutas Para Editar Informacion De Un Vehiculo
            Route::get('/administrator/vehiculos/edit/{id}', 'VehiculosController@getVehiclesEdit')->name('hangarauto.admin.vehicles.edit');
            Route::put('/administrator/vehiculos/edit/{id}', 'VehiculosController@postViajesEdit')->name('hangarauto.admin.vehicles.update');
            // Ruta Para Eliminar Un Vehiculo
            Route::get('/administrator/vehiculos/delete/{id}', 'VehiculosController@getVehiclesDelete')->name('hangarauto.admin.vehicles.delete');
        });
        
        Route::controller(DriversController::class)->group(function(){
            // Rutas Para Vista Conductores
            Route::get('/administrator/conductores', 'DriversController@conductores')->name('hangarauto.admin.drivers');
            Route::get('/administrator/conductores/create', 'DriversController@getCreateAdd')->name('hangarauto.admin.drivers.create');
            Route::post('/administrator/conductores/create', 'DriversController@postCreateAdd')->name('hangarauto.admin.drivers.create');
            Route::post('/administrator/conductores/search', 'DriversController@postDriversSearch')->name('hangarauto.admin.drivers.search');
            Route::get('/administrator/conductores/delete/{id}', 'DriversController@getDriversDelete')->name('hangarauto.admin.drivers.delete');
            // Rutas Para Editar Informacion De Los Conductores
            // Route::get('/administrator/conductores/edit/{id}', 'DriversController@getDriverEdit')->name('parking.admin.drivers.edit');
            // Route::post('/administrator/conductores/edit/{id}', 'DriversController@postDriversEdit')->name('parking.admin.drivers.ediet');
            // Ruta Para Eliminar Los Conductores
            
        });

        // Ruta Para Vista Desarrolladores
        Route::controller(DevelopersController::class)->group(function(){
            Route::get('/developer', 'developer')->name('cefa.hangarauto.developers');
        });

        Route::controller(InstructionManualController::class)->group(function() {
            Route::get('/admin/instruction/manual', 'manual')->name('cefa.instruction.manual');
        });
    });
});