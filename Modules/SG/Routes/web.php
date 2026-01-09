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
});
});

