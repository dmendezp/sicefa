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
            Route::get('/admin/index', 'index')->name('hangarauto.admin.index');
            Route::get('/charge/index', 'index')->name('hangarauto.charge.index');
            Route::get('/conductor/index', 'index')->name('hangarauto.driver.index');
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
            Route::get('/get-municipalities/{departmentId}', 'ParkingController@getMunicipalities')->name('cefa.parking.solicitar.searchmunicipio');
            Route::post('/get-drivers/{driverId}', 'ParkingController@getDrivers')->name('cefa.parking.solicitar.searchdriver');
            Route::get('/get-vehicles/{petitionId}', 'ParkingController@getVehicles')->name('cefa.parking.solicitar.searchvehicles');
            Route::get('/get-vehiclessolicitar/{start_date}', 'ParkingController@getVehiclessolicitar')->name('cefa.parking.solicitar.searchvehiclessolicitar');


            /*Ruta Del CRUD Del Formulario De Registro */
            Route::get('/admin/tabla', 'ParkingController@table')->name('cefa.parking.table');
            Route::get('/charge/tabla', 'ParkingController@table')->name('cefa.charge.table');
            Route::get('/driver/tabla', 'ParkingController@tabledriver')->name('hangarauto.driver.petitions');
            Route::delete('admin/resulform/delete/{id}', 'ParkingController@delete')->name('cefa.parking.delete');
            Route::delete('charge/resulform/delete/{id}', 'ParkingController@delete')->name('cefa.charge.delete');
            Route::get('/admin/hangarauto/edit/{labor}', 'ParkingController@edit')->name('cefa.parking.edit');

            Route::get('/administrator/petitons', 'ParkingController@table')->name('hangarauto.admin.petitions');
            Route::get('/encargado/petitons', 'ParkingController@table')->name('hangarauto.charge.petitions');
            Route::post('/administrator/petitons/denegar/{id}', 'ParkingController@dennypetition')->name('hangarauto.admin.petitions.deny');
            Route::post('/administrator/petitons/denegar/{id}', 'ParkingController@dennypetition')->name('hangarauto.admin.petitions.deny');
            Route::post('/encargado/petitons/denegar/{id}', 'ParkingController@dennypetition')->name('hangarauto.charge.petitions.deny');
            Route::post('/encargado/petitons/denegar/{id}', 'ParkingController@dennypetition')->name('hangarauto.charge.petitions.deny');

            Route::get('/administrator/solicitar', 'ParkingController@getSolicitarAdd')->name('hangarauto.admin.petitions.add.index');
            Route::get('/encargado/solicitar', 'ParkingController@getSolicitarAdd')->name('hangarauto.charge.petitions.add.index');
            Route::post('/administrator/solicitar/add', 'ParkingController@postSolicitarAdd')->name('hangarauto.admin.petitions.add');
            Route::post('/encargado/solicitar/add', 'ParkingController@postSolicitarAdd')->name('hangarauto.charge.petitions.add');
            Route::post('/administrator/aprobar/add', 'ParkingController@assignadd')->name('hangarauto.admin.petitions.assign.add');
            Route::post('/encargado/aprobar/add', 'ParkingController@assignadd')->name('hangarauto.charge.petitions.assign.add');
            
        });

        Route::controller(RevisionesController::class)->group(function(){
            // Ruta Vista Tecnomecanica
            Route::get('/administrator/tecnomecanica', 'RevisionesController@tecnomecanica')->name('hangarauto.admin.tecnomecanica');
            Route::get('/encargado/tecnomecanica', 'RevisionesController@tecnomecanica')->name('hangarauto.charge.tecnomecanica');
            Route::get('/administrator/tecnomecanica/add', 'RevisionesController@getTecnomecanicaAdd')->name('hangarauto.admin.tecnomecanica.add');
            Route::get('/encargado/tecnomecanica/add', 'RevisionesController@getTecnomecanicaAdd')->name('hangarauto.charge.tecnomecanica.add');
            Route::post('/administrator/tecnomecanica/add', 'RevisionesController@postTecnomecanicaAdd')->name('hangarauto.admin.tecnomecanica.add');
            Route::post('/encargado/tecnomecanica/add', 'RevisionesController@postTecnomecanicaAdd')->name('hangarauto.charge.tecnomecanica.add');
            Route::get('/administrator/tecnomecanica/delete/{id}', 'RevisionesController@getTecnomecanicaDelete')->name('hangarauto.admin.tecnomecanica.delete');
            Route::get('/encargado/tecnomecanica/delete/{id}', 'RevisionesController@getTecnomecanicaDelete')->name('hangarauto.charge.tecnomecanica.delete');

            // Ruta Vista SOAT
            Route::get('/administrator/SOAT', 'RevisionesController@seguroobligatorio')->name('hangarauto.admin.soat');
            Route::get('/encargado/SOAT', 'RevisionesController@seguroobligatorio')->name('hangarauto.charge.soat');
            Route::get('/administrator//SOAT/add', 'RevisionesController@getSoatAdd')->name('hangarauto.admin.soat.add');
            Route::get('/encargado//SOAT/add', 'RevisionesController@getSoatAdd')->name('hangarauto.charge.soat.add');
            Route::post('/administrator//SOAT/add', 'RevisionesController@postSoatAdd')->name('hangarauto.admin.soat.add');
            Route::post('/encargado//SOAT/add', 'RevisionesController@postSoatAdd')->name('hangarauto.charge.soat.add');
            Route::get('/administrator//SOAT/Delete/{id}', 'RevisionesController@getSoatDelete')->name('hangarauto.admin.soat.delete');
            Route::get('/encargado//SOAT/Delete/{id}', 'RevisionesController@getSoatDelete')->name('hangarauto.charge.soat.delete');

            // Ruta Vista Consumo
            Route::get('/administrator/consumo', 'RevisionesController@consumo')->name('hangarauto.admin.consumo');
            Route::get('/encargado/consumo', 'RevisionesController@consumo')->name('hangarauto.charge.consumo');
            Route::post('/administrator/consumo/add', 'RevisionesController@postConsumoAdd')->name('hangarauto.admin.consumo.add');
            Route::post('/encargado/consumo/add', 'RevisionesController@postConsumoAdd')->name('hangarauto.charge.consumo.add');
            Route::get('/administrator/consumo/Delete/{id}', 'RevisionesController@getConsumoDelete')->name('hangarauto.admin.consumo.delete');
            Route::get('/encargado/consumo/Delete/{id}', 'RevisionesController@getConsumoDelete')->name('hangarauto.charge.consumo.delete');
        });
        
        Route::controller(VehiculosController::class)->group(function(){
            // Ruta Para Vista De Vehiculos
            Route::get('/administrador/vehiculos', 'VehiculosController@Vehicles')->name('hangarauto.admin.vehicles');
            Route::get('/encargado/vehiculos', 'VehiculosController@Vehicles')->name('hangarauto.charge.vehicles');
            Route::post('/administrador/vehiculos/crear', 'VehiculosController@postVehiclesStore')->name('hangarauto.admin.vehicles.store');
            Route::post('/encargado/vehiculos/crear', 'VehiculosController@postVehiclesStore')->name('hangarauto.charge.vehicles.store');
            Route::get('/administrator/vehiculos/edit/{id}', 'VehiculosController@getVehiclesEdit')->name('hangarauto.admin.vehicles.edit');
            Route::get('/encargado/vehiculos/edit/{id}', 'VehiculosController@getVehiclesEdit')->name('hangarauto.charge.vehicles.edit');
            Route::put('/administrator/vehiculos/edit/{id}', 'VehiculosController@postViajesEdit')->name('hangarauto.admin.vehicles.update');
            Route::put('/encargado/vehiculos/edit/{id}', 'VehiculosController@postViajesEdit')->name('hangarauto.charge.vehicles.update');
            // Ruta Para Eliminar Un Vehiculo
            Route::get('/administrator/vehiculos/delete/{id}', 'VehiculosController@getVehiclesDelete')->name('hangarauto.admin.vehicles.delete');
            Route::get('/encargado/vehiculos/delete/{id}', 'VehiculosController@getVehiclesDelete')->name('hangarauto.charge.vehicles.delete');
            
            Route::get('/administrator/vehiculos/report', 'VehiculosController@reportindex')->name('hangarauto.admin.vehicles.report.index');
            Route::get('/encargado/vehiculos/report', 'VehiculosController@reportindex')->name('hangarauto.charge.vehicles.report.index');
            Route::get('/conductor/vehiculos/report', 'VehiculosController@reportindex')->name('hangarauto.driver.vehicles.report.index');
            Route::post('/administrator/vehiculos/report/search', 'VehiculosController@search')->name('hangarauto.admin.vehicles.report.search');
            Route::post('/encargado/vehiculos/report/search', 'VehiculosController@search')->name('hangarauto.charge.vehicles.report.search');
            Route::post('/conductor/vehiculos/report/search', 'VehiculosController@search')->name('hangarauto.driver.vehicles.report.search');
            Route::get('/conductor/vehiculos/check/', 'VehiculosController@check')->name('hangarauto.driver.check');
            Route::get('/conductor/vehiculos/check/add', 'VehiculosController@getcheckadd')->name('hangarauto.driver.check.add.index');
            Route::post('/conductor/vehiculos/check/add/post', 'VehiculosController@postcheckadd')->name('hangarauto.driver.check.add');
            Route::get('/conductor/vehiculos/check/edit/{id}', 'VehiculosController@getcheckedit')->name('hangarauto.driver.check.edit');
            Route::put('/conductor/vehiculos/check/update/{id}', 'VehiculosController@updatecheck')->name('hangarauto.driver.check.update');
            Route::delete('/conductor/vehiculos/check/delete/{id}', 'VehiculosController@deletecheck')->name('hangarauto.driver.check.delete');
            Route::get('/encargado/vehiculos/check/', 'VehiculosController@check')->name('hangarauto.charge.check');
            Route::get('/encargado/vehiculos/check/add', 'VehiculosController@getcheckadd')->name('hangarauto.charge.check.add.index');
            Route::post('/encargado/vehiculos/check/add/post', 'VehiculosController@postcheckadd')->name('hangarauto.charge.check.add');
            Route::get('/encargado/vehiculos/check/edit/{id}', 'VehiculosController@getcheckedit')->name('hangarauto.charge.check.edit');
            Route::put('/encargado/vehiculos/check/update/{id}', 'VehiculosController@updatecheck')->name('hangarauto.charge.check.update');
            Route::delete('/encargado/vehiculos/check/delete/{id}', 'VehiculosController@deletecheck')->name('hangarauto.charge.check.delete');
            Route::get('/administrator/vehiculos/check/', 'VehiculosController@check')->name('hangarauto.admin.check');
            Route::get('/administrator/vehiculos/check/add', 'VehiculosController@getcheckadd')->name('hangarauto.admin.check.add.index');
            Route::post('/administrator/vehiculos/check/add/post', 'VehiculosController@postcheckadd')->name('hangarauto.admin.check.add');
            Route::get('/administrator/vehiculos/check/edit/{id}', 'VehiculosController@getcheckedit')->name('hangarauto.admin.check.edit');
            Route::put('/administrator/vehiculos/check/update/{id}', 'VehiculosController@updatecheck')->name('hangarauto.admin.check.update');
            Route::delete('/administrator/vehiculos/check/delete/{id}', 'VehiculosController@deletecheck')->name('hangarauto.admin.check.delete');

            
        });
        
        Route::controller(DriversController::class)->group(function(){
            // Rutas Para Vista Conductores
            Route::get('/administrator/conductores', 'DriversController@conductores')->name('hangarauto.admin.drivers');
            Route::get('/administrator/conductores/vehiculos', 'DriversController@driversvehicles_index')->name('hangarauto.admin.drivervehicles');
            Route::post('/administrator/conductores/vehiculos/add', 'DriversController@driversvehicles_add')->name('hangarauto.admin.drivervehicles.add');
            Route::delete('/administrator/conductores/vehiculos/delete/{epu}', 'DriversController@driversvehicles_delete')->name('hangarauto.admin.drivervehicles.delete');
            Route::get('/encargado/conductores', 'DriversController@conductores')->name('hangarauto.charge.drivers');
            Route::get('/administrator/conductores/create', 'DriversController@getCreateAdd')->name('hangarauto.admin.drivers.create');
            Route::get('/encargado/conductores/create', 'DriversController@getCreateAdd')->name('hangarauto.charge.drivers.create');
            Route::post('/administrator/conductores/create', 'DriversController@postCreateAdd')->name('hangarauto.admin.drivers.create');
            Route::post('/encargado/conductores/create', 'DriversController@postCreateAdd')->name('hangarauto.charge.drivers.create');
            Route::post('/administrator/conductores/search', 'DriversController@postDriversSearch')->name('hangarauto.admin.drivers.search');
            Route::post('/encargado/conductores/search', 'DriversController@postDriversSearch')->name('hangarauto.charge.drivers.search');
            Route::get('/administrator/conductores/delete/{id}', 'DriversController@getDriversDelete')->name('hangarauto.admin.drivers.delete');
            Route::get('/encargado/conductores/delete/{id}', 'DriversController@getDriversDelete')->name('hangarauto.charge.drivers.delete');
            // Rutas Para Editar Informacion De Los Conductores
            // Route::get('/administrator/conductores/edit/{id}', 'DriversController@getDriverEdit')->name('hangarauto.admin.drivers.edit');
            // Route::post('/administrator/conductores/edit/{id}', 'DriversController@postDriversEdit')->name('parking.admin.drivers.ediet');

            
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