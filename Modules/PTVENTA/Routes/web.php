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

Route::middleware(['lang'])->group(function(){  // Middleware para la internzación (manejo de idiomas) y verficación de permisos y roles
    Route::prefix('ptventa')->group(function() {  // agrega el prefijo en la url (sicefa.test/ptventa/...)
        // Rutas generales para el modulo PTVENTA
        Route::controller(PTVENTAController::class)->group(function(){ // Agregar por única vez el controlodaar para posteriormente solo definir rutas con el formato (url, método_controlador)->name(nombre_de_ruta)
            Route::get('index', 'index')->name('cefa.ptventa.index'); // Vista principal y pública de la aplicación.
            Route::get('developers', 'devs')->name('cefa.ptventa.devs'); // Vista de creditos ydesarrolladores, pública de la aplicación.
            Route::get('information', 'info')->name('cefa.ptventa.info'); // Vista mas info sobre PTVENTA y pública de la aplicación.
        });

        //Rutas para Inventario
        Route::prefix('inventory')->controller(InventoryController::class)->group(function(){
            Route::get('index', 'index')->name('ptventa.inventory.index'); // Vista principal del inventario (listado de actual productos en inventario)
            Route::get('create', 'create')->name('ptventa.inventory.create'); // Formulario de registro de entrada de inventario (registro de productos)
            Route::get('pdf', 'pdf')->name('ptventa.inventory.pdf'); // Descarga de formato de pdf
            Route::get('status', 'status')->name('ptventa.inventory.status');
            Route::get('low', 'low')->name('ptventa.inventory.low');
        });

            //Ruta de reporte
        Route::prefix('report')->controller(InventoryController::class)->group(function(){
            Route::get('form', 'form')->name('ptventa.report.form');
            Route::post('result_form', 'result_form')->name('ptventa.report.result_form');
            Route::get('table', 'table')->name('ptventa.report.table');
        });

        //Rutas para Ventas
        Route::prefix('sale')->controller(SaleController::class)->group(function(){
            Route::get('index', 'index')->name('ptventa.sale.index'); // Vista principal de ventas
            Route::get('register', 'register')->name('ptventa.sale.register'); // Vista de registro de venta
        });

        // Rutas para Elementos
        Route::prefix('images')->controller(ElementController::class)->group(function(){
            Route::get('index', 'index')->name('ptventa.element.image.index'); // Vista principal de elementos para administrar imagenes
            Route::get('edit/{element}', 'edit')->name('ptventa.element.image.edit'); // Vista del formulario para acutalizar imagen de elemento
            Route::post('update/{element}', 'update')->name('ptventa.element.image.update'); // Carga de nueva imagen para elemento
        });

        // Rutas para Caja
        Route::prefix('cash')->controller(CashController::class)->group(function(){
            Route::get('cash', 'index')->name('ptventa.cash.index'); // Vista principal de caja
            Route::post('cashCount', 'store')->name('ptventa.cashCount.store');
        });
    });
});
