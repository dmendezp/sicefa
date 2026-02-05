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
    Route::prefix('sg')->group(function () {
        Route::get('/index', 'SGController@index')->name('cefa.sg.index');
        Route::get('/admin/welcome', 'SGController@admin')->name('sg.admin.welcome');
        Route::get('/liderDeUnidad/panelLider', 'SGController@liderDeUnidad')->name('sg.liderDeUnidad.panelLider');
        Route::get('/aprendiz/panelAprendiz', 'SGController@aprendiz')->name('sg.aprendiz.panelAprendiz');
        Route::get('/modules', 'SGController@modules')->name('sg.modules');

    });
});

Route::get('/desarrolladores', 'SGController@devs')->name('sg.desarrolladores');
Route::get('/manual', 'SGController@manual')->name('sg.manual');


Route::middleware(['auth'])->group(function () {
        Route::prefix('sg')->group(function () {

            // Rutas para la gestión de razas
            Route::get('/admin/razas', 'BreedController@index')->name('sg.admin.sg.razas.index');
            Route::get('/admin/razas/create', 'BreedController@create')->name('sg.admin.sg.razas.create');
            Route::post('/admin/razas', 'BreedController@store')->name('sg.admin.sg.razas.store');
            Route::get('/admin/{id}/edit', 'BreedController@edit')->name('sg.admin.sg.razas.edit');
            Route::put('/admin/{id}', 'BreedController@update')->name('sg.admin.sg.razas.update');
            Route::delete('/admin/{id}', 'BreedController@destroy')->name('sg.admin.sg.razas.destroy');
            Route::get('/admin/{id}', 'BreedController@show')->name('sg.admin.sg.razas.show');

            // Rutas para la gestión de medicamentos
            Route::get('/medicamentos', 'MedicineController@index')->name('sg.admin.sg.medicamentos.index');
            Route::get('/medicamentos/create', 'MedicineController@create')->name('sg.admin.sg.medicamentos.create');
            Route::post('/medicamentos', 'MedicineController@store')->name('sg.admin.sg.medicamentos.store');
            Route::get('/medicamentos/{id}/edit', 'MedicineController@edit')->name('sg.admin.sg.medicamentos.edit');
            Route::put('/medicamentos/{id}', 'MedicineController@update')->name('sg.admin.sg.medicamentos.update');
            Route::delete('/medicamentos/{id}', 'MedicineController@destroy')->name('sg.admin.sg.medicamentos.destroy');
            Route::get('/medicamentos/{id}', 'MedicineController@show')->name('sg.admin.sg.medicamentos.show');

            // Rutas para la gestión de animales
            Route::get('/animales', 'AnimalController@index')->name('sg.admin.sg.animales.index');
            Route::get('/animales/create', 'AnimalController@create')->name('sg.admin.sg.animales.create');
            Route::post('/animales', 'AnimalController@store')->name('sg.admin.sg.animales.store');
            Route::get('/animales/{id}/edit', 'AnimalController@edit')->name('sg.admin.sg.animales.edit');
            Route::put('/animales/{id}', 'AnimalController@update')->name('sg.admin.sg.animales.update');
            Route::delete('/animales/{id}', 'AnimalController@destroy')->name('sg.admin.sg.animales.destroy');
            Route::get('/animales/{id}', 'AnimalController@show')->name('sg.admin.sg.animales.show');

            // Rutas para la gestión de bodegas de ganadería
            Route::get('/sg/bodegas', 'WarehouseCattleRaisingController@index')->name('sg.admin.sg.bodegas.index');
            Route::get('/sg/bodegas/create', 'WarehouseCattleRaisingController@create')->name('sg.admin.sg.bodegas.create');
            Route::post('/sg/bodegas', 'WarehouseCattleRaisingController@store')->name('sg.admin.sg.bodegas.store');
            Route::get('/sg/bodegas/{id}/edit', 'WarehouseCattleRaisingController@edit')->name('sg.admin.sg.bodegas.edit');
            Route::put('/sg/bodegas/{id}', 'WarehouseCattleRaisingController@update')->name('sg.admin.sg.bodegas.update');
            Route::delete('/sg/bodegas/{id}', 'WarehouseCattleRaisingController@destroy')->name('sg.admin.sg.bodegas.destroy');
            Route::get('/sg/bodegas/{id}', 'WarehouseCattleRaisingController@show')->name('sg.admin.sg.bodegas.show');

            // Rutas para la gestión de insumos de ganadería
            Route::get('/sg/insumos', 'SupplyCattleRaisingController@index')->name('sg.admin.sg.insumos.index');
            Route::get('/sg/insumos/create', 'SupplyCattleRaisingController@create')->name('sg.admin.sg.insumos.create');
            Route::post('/sg/insumos', 'SupplyCattleRaisingController@store')->name('sg.admin.sg.insumos.store');
            Route::get('/sg/insumos/{id}/edit', 'SupplyCattleRaisingController@edit')->name('sg.admin.sg.insumos.edit');
            Route::put('/sg/insumos/{id}', 'SupplyCattleRaisingController@update')->name('sg.admin.sg.insumos.update');
            Route::delete('/sg/insumos/{id}', 'SupplyCattleRaisingController@destroy')->name('sg.admin.sg.insumos.destroy');
            Route::get('/sg/insumos/{id}', 'SupplyCattleRaisingController@show')->name('sg.admin.sg.insumos.show');

            // Rutas para la gestión de herramientas de ganadería
            Route::get('/sg/herramientas', 'ToolCattleRaisingController@index')->name('sg.admin.sg.herramientas.index');
            Route::get('/sg/herramientas/create', 'ToolCattleRaisingController@create')->name('sg.admin.sg.herramientas.create');
            Route::post('/sg/herramientas', 'ToolCattleRaisingController@store')->name('sg.admin.sg.herramientas.store');
            Route::get('/sg/herramientas/{id}/edit', 'ToolCattleRaisingController@edit')->name('sg.admin.sg.herramientas.edit');
            Route::put('/sg/herramientas/{id}', 'ToolCattleRaisingController@update')->name('sg.admin.sg.herramientas.update');
            Route::delete('/sg/herramientas/{id}', 'ToolCattleRaisingController@destroy')->name('sg.admin.sg.herramientas.destroy');
            Route::get('/sg/herramientas/{id}', 'ToolCattleRaisingController@show')->name('sg.admin.sg.herramientas.show');
            
            //rutas para la gestión de producciones de leche
            Route::get('/sg/produccion', 'MilkProductionController@index')->name('sg.admin.sg.produccion.index');
            Route::get('/sg/produccion/create', 'MilkProductionController@create')->name('sg.admin.sg.produccion.create');
            Route::post('/sg/produccion', 'MilkProductionController@store')->name('sg.admin.sg.produccion.store');
            Route::get('/sg/produccion/{id}/edit', 'MilkProductionController@edit')->name('sg.admin.sg.produccion.edit');
            Route::put('/sg/produccion/{id}', 'MilkProductionController@update')->name('sg.admin.sg.produccion.update');
            Route::delete('/sg/produccion/{id}', 'MilkProductionController@destroy')->name('sg.admin.sg.produccion.destroy');
            Route::get('/sg/produccion/{id}', 'MilkProductionController@show')->name('sg.admin.sg.produccion.show');

            // Rutas para la gestión de historias clínicas de ganadería
            Route::get('/sg/salud', 'HealthRecordCattleRaisingController@index')->name('sg.admin.sg.salud.index');
            Route::get('/sg/salud/create', 'HealthRecordCattleRaisingController@create')->name('sg.admin.sg.salud.create');
            Route::post('/sg/salud', 'HealthRecordCattleRaisingController@store')->name('sg.admin.sg.salud.store');
            Route::get('/sg/salud/{id}/edit', 'HealthRecordCattleRaisingController@edit')->name('sg.admin.sg.salud.edit');
            Route::put('/sg/salud/{id}', 'HealthRecordCattleRaisingController@update')->name('sg.admin.sg.salud.update');
            Route::delete('/sg/salud/{id}', 'HealthRecordCattleRaisingController@destroy')->name('sg.admin.sg.salud.destroy');
            Route::get('/sg/salud/{id}', 'HealthRecordCattleRaisingController@show')->name('sg.admin.sg.salud.show');

            // Rutas para la gestión de tratamientos de ganadería
            Route::get('/sg/tratamientos', 'TreatmentCattleRaisingController@index')->name('sg.admin.sg.tratamientos.index');
            Route::get('/sg/tratamientos/create', 'TreatmentCattleRaisingController@create')->name('sg.admin.sg.tratamientos.create');
            Route::post('/sg/tratamientos', 'TreatmentCattleRaisingController@store')->name('sg.admin.sg.tratamientos.store');
            Route::get('/sg/tratamientos/{id}/edit', 'TreatmentCattleRaisingController@edit')->name('sg.admin.sg.tratamientos.edit');
            Route::put('/sg/tratamientos/{id}', 'TreatmentCattleRaisingController@update')->name('sg.admin.sg.tratamientos.update');
            Route::delete('/sg/tratamientos/{id}', 'TreatmentCattleRaisingController@destroy')->name('sg.admin.sg.tratamientos.destroy');
            Route::get('/sg/tratamientos/{id}', 'TreatmentCattleRaisingController@show')->name('sg.admin.sg.tratamientos.show');

            // Rutas para la gestión de pruebas diagnósticas de ganadería
            Route::get('/sg/diagnosticos', 'TestController@index')->name('sg.admin.sg.diagnosticos.index');
            Route::get('/sg/diagnosticos/create', 'TestController@create')->name('sg.admin.sg.diagnosticos.create');
            Route::post('/sg/diagnosticos', 'TestController@store')->name('sg.admin.sg.diagnosticos.store');
            Route::get('/sg/diagnosticos/{id}/edit', 'TestController@edit')->name('sg.admin.sg.diagnosticos.edit');
            Route::put('/sg/diagnosticos/{id}', 'TestController@update')->name('sg.admin.sg.diagnosticos.update');
            Route::delete('/sg/diagnosticos/{id}', 'TestController@destroy')->name('sg.admin.sg.diagnosticos.destroy');
            Route::get('/sg/diagnosticos/{id}', 'TestController@show')->name('sg.admin.sg.diagnosticos.show');

            // Rutas para la gestión de inseminaciones de ganadería
            Route::get('/sg/inseminaciones', 'InseminationController@index')->name('sg.admin.sg.inseminaciones.index');
            Route::get('/sg/inseminaciones/create', 'InseminationController@create')->name('sg.admin.sg.inseminaciones.create');
            Route::post('/sg/inseminaciones', 'InseminationController@store')->name('sg.admin.sg.inseminaciones.store');
            Route::get('/sg/inseminaciones/{id}/edit', 'InseminationController@edit')->name('sg.admin.sg.inseminaciones.edit');
            Route::put('/sg/inseminaciones/{id}', 'InseminationController@update')->name('sg.admin.sg.inseminaciones.update');
            Route::delete('/sg/inseminaciones/{id}', 'InseminationController@destroy')->name('sg.admin.sg.inseminaciones.destroy');
            Route::get('/sg/inseminaciones/{id}', 'InseminationController@show')->name('sg.admin.sg.inseminaciones.show');

            // Rutas para la gestión de nacimientos de ganadería
            Route::get('/sg/nacimientos', 'BirthController@index')->name('sg.admin.sg.nacimientos.index');
            Route::get('/sg/nacimientos/create', 'BirthController@create')->name('sg.admin.sg.nacimientos.create');
            Route::post('/sg/nacimientos', 'BirthController@store')->name('sg.admin.sg.nacimientos.store');
            Route::get('/sg/nacimientos/{id}/edit', 'BirthController@edit')->name('sg.admin.sg.nacimientos.edit');
            Route::put('/sg/nacimientos/{id}', 'BirthController@update')->name('sg.admin.sg.nacimientos.update');
            Route::delete('/sg/nacimientos/{id}', 'BirthController@destroy')->name('sg.admin.sg.nacimientos.destroy');
            Route::get('/sg/nacimientos/{id}', 'BirthController@show')->name('sg.admin.sg.nacimientos.show');

            // Rutas para la gestión de registros de peso de ganadería
            Route::get('/sg/pesos', 'WeightRecordController@index')->name('sg.admin.sg.pesos.index');
            Route::get('/sg/pesos/create', 'WeightRecordController@create')->name('sg.admin.sg.pesos.create');
            Route::post('/sg/pesos', 'WeightRecordController@store')->name('sg.admin.sg.pesos.store');
            Route::get('/sg/pesos/{id}/edit', 'WeightRecordController@edit')->name('sg.admin.sg.pesos.edit');
            Route::put('/sg/pesos/{id}', 'WeightRecordController@update')->name('sg.admin.sg.pesos.update');
            Route::delete('/sg/pesos/{id}', 'WeightRecordController@destroy')->name('sg.admin.sg.pesos.destroy');
            Route::get('/sg/pesos/{id}', 'WeightRecordController@show')->name('sg.admin.sg.pesos.show');

            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //rutas para los aprendices
            //rutas para la gestion de animal por parte del aprendiz
            Route::get('/ANIMALES', 'AnimalController@indexaprendiz')->name('sg.aprendiz.sg.ANIMALES.index');
            Route::get('/ANIMALES/create', 'AnimalController@createaprendiz')->name('sg.aprendiz.sg.ANIMALES.create');
            Route::post('/ANIMALES', 'AnimalController@storeaprendiz')->name('sg.aprendiz.sg.ANIMALES.store');
            Route::get('/ANIMALES/{id}/edit', 'AnimalController@editaprendiz')->name('sg.aprendiz.sg.ANIMALES.edit');
            Route::put('/ANIMALES/{id}', 'AnimalController@updateaprendiz')->name('sg.aprendiz.sg.ANIMALES.update');
            Route::delete('/ANIMALES/{id}', 'AnimalController@destroyaprendiz')->name('sg.aprendiz.sg.ANIMALES.destroy');
            Route::get('/ANIMALES/{id}', 'AnimalController@showaprendiz')->name('sg.aprendiz.sg.ANIMALES.show');

            //rutas para la gestion de produccion de leche por parte del aprendiz
            Route::get('/sg/PRODUCCION', 'MilkProductionController@indexaprendiz')->name('sg.aprendiz.sg.PRODUCCION.index');
            Route::get('/sg/PRODUCCION/create', 'MilkProductionController@createaprendiz')->name('sg.aprendiz.sg.PRODUCCION.create');
            Route::post('/sg/PRODUCCION', 'MilkProductionController@storeaprendiz')->name('sg.aprendiz.sg.PRODUCCION.store');
            Route::get('/sg/PRODUCCION/{id}/edit', 'MilkProductionController@editaprendiz')->name('sg.aprendiz.sg.PRODUCCION.edit');
            Route::put('/sg/PRODUCCION/{id}', 'MilkProductionController@updateaprendiz')->name('sg.aprendiz.sg.PRODUCCION.update');
            Route::delete('/sg/PRODUCCION/{id}', 'MilkProductionController@destroyaprendiz')->name('sg.aprendiz.sg.PRODUCCION.destroy');
            Route::get('/sg/PRODUCCION/{id}', 'MilkProductionController@showaprendiz')->name('sg.aprendiz.sg.PRODUCCION.show');

            //rutas para la gestion de registros de peso por parte del aprendiz
            Route::get('/sg/PESOS', 'WeightRecordController@indexaprendiz')->name('sg.aprendiz.sg.PESOS.index');
            Route::get('/sg/PESOS/create', 'WeightRecordController@createaprendiz')->name('sg.aprendiz.sg.PESOS.create');
            Route::post('/sg/PESOS', 'WeightRecordController@storeaprendiz')->name('sg.aprendiz.sg.PESOS.store');
            Route::get('/sg/PESOS/{id}/edit', 'WeightRecordController@editaprendiz')->name('sg.aprendiz.sg.PESOS.edit');
            Route::put('/sg/PESOS/{id}', 'WeightRecordController@updateaprendiz')->name('sg.aprendiz.sg.PESOS.update');
            Route::delete('/sg/PESOS/{id}', 'WeightRecordController@destroyaprendiz')->name('sg.aprendiz.sg.PESOS.destroy');
            Route::get('/sg/PESOS/{id}', 'WeightRecordController@showaprendiz')->name('sg.aprendiz.sg.PESOS.show');

            //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            //rutas para los lideres de unidad
            //rutas para la gestion de animales por parte del lider de unidad
            Route::get('/animals', 'AnimalController@indexliderDeUnidad')->name('sg.liderDeUnidad.sg.animals.index');
            Route::get('/animals/create', 'AnimalController@createliderDeUnidad')->name('sg.liderDeUnidad.sg.animals.create');
            Route::post('/animals', 'AnimalController@storeliderDeUnidad')->name('sg.liderDeUnidad.sg.animals.store');
            Route::get('/animals/{id}/edit', 'AnimalController@editliderDeUnidad')->name('sg.liderDeUnidad.sg.animals.edit');
            Route::put('/animals/{id}', 'AnimalController@updateliderDeUnidad')->name('sg.liderDeUnidad.sg.animals.update');
            Route::delete('/animals/{id}', 'AnimalController@destroyliderDeUnidad')->name('sg.liderDeUnidad.sg.animals.destroy');
            Route::get('/animals/{id}', 'AnimalController@showliderDeUnidad')->name('sg.liderDeUnidad.sg.animals.show');

            //rutas para las razas por parte del lider de unidad
            Route::get('/breeds', 'BreedController@indexliderDeUnidad')->name('sg.liderDeUnidad.sg.breeds.index');
            Route::get('/breeds/create', 'BreedController@createliderDeUnidad')->name('sg.liderDeUnidad.sg.breeds.create');
            Route::post('/breeds', 'BreedController@storeliderDeUnidad')->name('sg.liderDeUnidad.sg.breeds.store');
            Route::get('/breeds/{id}/edit', 'BreedController@editliderDeUnidad')->name('sg.liderDeUnidad.sg.breeds.edit');
            Route::put('/breeds/{id}', 'BreedController@updateliderDeUnidad')->name('sg.liderDeUnidad.sg.breeds.update');
            Route::delete('/breeds/{id}', 'BreedController@destroyliderDeUnidad')->name('sg.liderDeUnidad.sg.breeds.destroy');
            Route::get('/breeds/{id}', 'BreedController@showliderDeUnidad')->name('sg.liderDeUnidad.sg.breeds.show');

            // Rutas para la gestión de medicamentos por parte del lider de unidad
            Route::get('/medicines', 'MedicineController@indexliderDeUnidad')->name('sg.liderDeUnidad.sg.medicines.index');
            Route::get('/medicines/create', 'MedicineController@createliderDeUnidad')->name('sg.liderDeUnidad.sg.medicines.create');
            Route::post('/medicines', 'MedicineController@storeliderDeUnidad')->name('sg.liderDeUnidad.sg.medicines.store');
            Route::get('/medicines/{id}/edit', 'MedicineController@editliderDeUnidad')->name('sg.liderDeUnidad.sg.medicines.edit');
            Route::put('/medicines/{id}', 'MedicineController@updateliderDeUnidad')->name('sg.liderDeUnidad.sg.medicines.update');
            Route::delete('/medicines/{id}', 'MedicineController@destroyliderDeUnidad')->name('sg.liderDeUnidad.sg.medicines.destroy');
            Route::get('/medicines/{id}', 'MedicineController@showliderDeUnidad')->name('sg.liderDeUnidad.sg.medicines.show');

            // Rutas para la gestión de inseminaciones por parte del lider de unidad
            Route::get('/sg/inseminations', 'InseminationController@indexliderDeUnidad')->name('sg.liderDeUnidad.sg.inseminations.index');
            Route::get('/sg/inseminations/create', 'InseminationController@createliderDeUnidad')->name('sg.liderDeUnidad.sg.inseminations.create');
            Route::post('/sg/inseminations', 'InseminationController@storeliderDeUnidad')->name('sg.liderDeUnidad.sg.inseminations.store');
            Route::get('/sg/inseminations/{id}/edit', 'InseminationController@editliderDeUnidad')->name('sg.liderDeUnidad.sg.inseminations.edit');
            Route::put('/sg/inseminations/{id}', 'InseminationController@updateliderDeUnidad')->name('sg.liderDeUnidad.sg.inseminations.update');
            Route::delete('/sg/inseminations/{id}', 'InseminationController@destroyliderDeUnidad')->name('sg.liderDeUnidad.sg.inseminations.destroy');
            Route::get('/sg/inseminations/{id}', 'InseminationController@showliderDeUnidad')->name('sg.liderDeUnidad.sg.inseminations.show');

            // Rutas para la gestión de nacimientos por parte del lider de unidad
            Route::get('/sg/births', 'BirthController@indexliderDeUnidad')->name('sg.liderDeUnidad.sg.births.index');
            Route::get('/sg/births/create', 'BirthController@createliderDeUnidad')->name('sg.liderDeUnidad.sg.births.create');
            Route::post('/sg/births', 'BirthController@storeliderDeUnidad')->name('sg.liderDeUnidad.sg.births.store');
            Route::get('/sg/births/{id}/edit', 'BirthController@editliderDeUnidad')->name('sg.liderDeUnidad.sg.births.edit');
            Route::put('/sg/births/{id}', 'BirthController@updateliderDeUnidad')->name('sg.liderDeUnidad.sg.births.update');
            Route::delete('/sg/births/{id}', 'BirthController@destroyliderDeUnidad')->name('sg.liderDeUnidad.sg.births.destroy');
            Route::get('/sg/births/{id}', 'BirthController@showliderDeUnidad')->name('sg.liderDeUnidad.sg.births.show');

            // Rutas para la gestión de historias clínicas por parte del lider de unidad
            Route::get('/sg/health', 'HealthRecordCattleRaisingController@indexliderDeUnidad')->name('sg.liderDeUnidad.sg.health.index');
            Route::get('/sg/health/create', 'HealthRecordCattleRaisingController@createliderDeUnidad')->name('sg.liderDeUnidad.sg.health.create');
            Route::post('/sg/health', 'HealthRecordCattleRaisingController@storeliderDeUnidad')->name('sg.liderDeUnidad.sg.health.store');
            Route::get('/sg/health/{id}/edit', 'HealthRecordCattleRaisingController@editliderDeUnidad')->name('sg.liderDeUnidad.sg.health.edit');
            Route::put('/sg/health/{id}', 'HealthRecordCattleRaisingController@updateliderDeUnidad')->name('sg.liderDeUnidad.sg.health.update');
            Route::delete('/sg/health/{id}', 'HealthRecordCattleRaisingController@destroyliderDeUnidad')->name('sg.liderDeUnidad.sg.health.destroy');
            Route::get('/sg/health/{id}', 'HealthRecordCattleRaisingController@showliderDeUnidad')->name('sg.liderDeUnidad.sg.health.show');

            // Rutas para la gestión de tratamientos por parte del lider de unidad
            Route::get('/sg/treatments', 'TreatmentCattleRaisingController@indexliderDeUnidad')->name('sg.liderDeUnidad.sg.treatments.index');
            Route::get('/sg/treatments/create', 'TreatmentCattleRaisingController@createliderDeUnidad')->name('sg.liderDeUnidad.sg.treatments.create');
            Route::post('/sg/treatments', 'TreatmentCattleRaisingController@storeliderDeUnidad')->name('sg.liderDeUnidad.sg.treatments.store');
            Route::get('/sg/treatments/{id}/edit', 'TreatmentCattleRaisingController@editliderDeUnidad')->name('sg.liderDeUnidad.sg.treatments.edit');
            Route::put('/sg/treatments/{id}', 'TreatmentCattleRaisingController@updateliderDeUnidad')->name('sg.liderDeUnidad.sg.treatments.update');
            Route::delete('/sg/treatments/{id}', 'TreatmentCattleRaisingController@destroyliderDeUnidad')->name('sg.liderDeUnidad.sg.treatments.destroy');
            Route::get('/sg/treatments/{id}', 'TreatmentCattleRaisingController@showliderDeUnidad')->name('sg.liderDeUnidad.sg.treatments.show');

            // Rutas para la gestión de pruebas diagnósticas por parte del lider de unidad
            Route::get('/sg/diagnostics', 'TestController@indexliderDeUnidad')->name('sg.liderDeUnidad.sg.diagnostics.index');
            Route::get('/sg/diagnostics/create', 'TestController@createliderDeUnidad')->name('sg.liderDeUnidad.sg.diagnostics.create');
            Route::post('/sg/diagnostics', 'TestController@storeliderDeUnidad')->name('sg.liderDeUnidad.sg.diagnostics.store');
            Route::get('/sg/diagnostics/{id}/edit', 'TestController@editliderDeUnidad')->name('sg.liderDeUnidad.sg.diagnostics.edit');
            Route::put('/sg/diagnostics/{id}', 'TestController@updateliderDeUnidad')->name('sg.liderDeUnidad.sg.diagnostics.update');
            Route::delete('/sg/diagnostics/{id}', 'TestController@destroyliderDeUnidad')->name('sg.liderDeUnidad.sg.diagnostics.destroy');
            Route::get('/sg/diagnostics/{id}', 'TestController@showliderDeUnidad')->name('sg.liderDeUnidad.sg.diagnostics.show');

            //rutas para la gestion de produccion de leche por parte del lider de unidad
            Route::get('/sg/production', 'MilkProductionController@indexliderDeUnidad')->name('sg.liderDeUnidad.sg.production.index');
            Route::get('/sg/production/create', 'MilkProductionController@createliderDeUnidad')->name('sg.liderDeUnidad.sg.production.create');
            Route::post('/sg/production', 'MilkProductionController@storeliderDeUnidad')->name('sg.liderDeUnidad.sg.production.store');
            Route::get('/sg/production/{id}/edit', 'MilkProductionController@editliderDeUnidad')->name('sg.liderDeUnidad.sg.production.edit');
            Route::put('/sg/production/{id}', 'MilkProductionController@updateliderDeUnidad')->name('sg.liderDeUnidad.sg.production.update');
            Route::delete('/sg/production/{id}', 'MilkProductionController@destroyliderDeUnidad')->name('sg.liderDeUnidad.sg.production.destroy');
            Route::get('/sg/production/{id}', 'MilkProductionController@showliderDeUnidad')->name('sg.liderDeUnidad.sg.production.show');

            //rutas para la gestion de registros de peso por parte del lider de unidad
            Route::get('/sg/weight', 'WeightRecordController@indexliderDeUnidad')->name('sg.liderDeUnidad.sg.weight.index');
            Route::get('/sg/weight/create', 'WeightRecordController@createliderDeUnidad')->name('sg.liderDeUnidad.sg.weight.create');
            Route::post('/sg/weight', 'WeightRecordController@storeliderDeUnidad')->name('sg.liderDeUnidad.sg.weight.store');
            Route::get('/sg/weight/{id}/edit', 'WeightRecordController@editliderDeUnidad')->name('sg.liderDeUnidad.sg.weight.edit');
            Route::put('/sg/weight/{id}', 'WeightRecordController@updateliderDeUnidad')->name('sg.liderDeUnidad.sg.weight.update');
            Route::delete('/sg/weight/{id}', 'WeightRecordController@destroyliderDeUnidad')->name('sg.liderDeUnidad.sg.weight.destroy');
            Route::get('/sg/weight/{id}', 'WeightRecordController@showliderDeUnidad')->name('sg.liderDeUnidad.sg.weight.show');
});
});

