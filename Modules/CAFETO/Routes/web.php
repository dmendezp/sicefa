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
    });


});
