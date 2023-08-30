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

Route::prefix('cafeto')->group(function(){ //Agrega el prefijo en la url (sicefa.test/cafeto/...).
    Route::controller(CAFETOController::class)->group(function(){ //Agrega por única vez el controlador, para que seguidamente sea solo.
        Route::get('index', 'index')->name('cefa.cafeto.index');
        Route::get('developers', 'devs')->name('cefa.cafeto.devs'); // Vista de creditos y desarrolladores, pública de la aplicación (Pública)
        Route::get('information', 'info')->name('cefa.cafeto.info'); // Vista mas info sobre PTVENTA y pública de la aplicación (Pública)
    });

    /* Rutas para administrar el inventario */
    Route::controller(InventoryController::class)->group(function(){
        Route::get('/inventory', 'index')->name('cafeto.inventory.index'); // Ver inventario de la boadega de la aplicación
        //::get('create', 'create')->name('cafeto.inventory.create'); // Formulario de registro de entrada de inventario (registro de productos)
            //Route::get('pdf', 'pdf')->name('cafeto.inventory.pdf'); // Descarga de formato de pdf
       //Route::get('status', 'status')->name('cafeto.inventory.status');// ver estado de productos
            //Route::get('low', 'low')->name('cafeto.inventory.low'); // ver registro de baja 
        Route::get('inventory/create', 'create')->name('cafeto.inventory.create'); // Formulario de registro de entrada de inventario


        //Rutas para reportes de inventario
        Route::get('reports/index', 'reports')->name('cafeto.reports.index'); // Vista principal de la sección de reportes

        // Reportes de entrada de inventario - Ruta para mostrar el formulario
        Route::get('reports/inventory/entries', 'showInventoryEntriesForm')->name('cafeto.reports.inventory.entries'); // Vista de consulta de entradas de inventario por fecha
        Route::post('reports/inventory/entries', 'generateInventoryEntries')->name('cafeto.reports.generate.inventory.entries'); // Realizar consulta de entradas de inventario por fechas recibidas
        Route::post('reports/inventory/entries/generatepdf', 'generateInventoryEntriesPDF')->name('cafeto.reports.generate.entries.pdf'); // Generar PDF de entradas de inventario


    });

    /* Rutas para administrar las ventas */
    Route::controller(SaleController::class)->group(function(){
        Route::get('/sale', 'index')->name('cafeto.sale.index'); // Formulario para registrar venta
    });

    /* Ruta para admiistrar los pruductos */
    Route::controller(ElementController::class)->group(function(){
        Route::get('/element', 'index')->name('cafeto.element.index'); // Ver imagenes de productos
        Route::get('edit/{element}', 'edit')->name('cafeto.element.edit'); // Vista del formulario para acutalizar imagen de elemento
        Route::post('update/{element}', 'update')->name('cafeto.element.update'); // Carga de nueva imagen para elemento
        Route::get('create', 'create')->name('cafeto.element.create');
        Route::post('store', 'store')->name('cafeto.element.store');
    });


});
