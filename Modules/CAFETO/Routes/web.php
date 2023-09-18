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

Route::middleware(['lang'])->group(function () {  // Middleware para la internzación (manejo de idiomas) y verficación de permisos y roles
    Route::prefix('cafeto')->group(function () { //Agrega el prefijo en la url (sicefa.test/cafeto/...).

        // Rutas generales para el módulo CAFETO
        Route::controller(CAFETOController::class)->group(function () { //Agrega por única vez el controlador, para que seguidamente sea solo.
            Route::get('index', 'index')->name('cefa.cafeto.index'); // Vista principal y pública de la aplicación (Pública)
            Route::get('developers', 'devs')->name('cefa.cafeto.devs'); // Vista de creditos y desarrolladores, pública de la aplicación (Pública)
            Route::get('information', 'info')->name('cefa.cafeto.info'); // Vista mas info sobre cafeto y pública de la aplicación (Pública)
            Route::get('admin', 'admin')->name('cafeto.admin.index'); // Vista principal del Administrador (Administrador)
            Route::get('cashier', 'cashier')->name('cafeto.cashier.index'); // Vista principal del Cajero (Cajero)
        });
        
        // Rutas para Inventario
        Route::controller(InventoryController::class)->group(function () {
            Route::get('admin/inventory/index', 'index')->name('cafeto.admin.inventory.index'); // Inventario actual (Administrador)
            Route::get('cashier/inventory/index', 'index')->name('cafeto.cashier.inventory.index'); // Inventario actual (Cajero)
            Route::get('admin/inventory/create', 'create')->name('cafeto.admin.inventory.create'); // Formulario de registro de entrada de inventario (Administrador)
            Route::get('cashier/inventory/create', 'create')->name('cafeto.cashier.inventory.create'); // Formulario de registro de entrada de inventario (Cajero)
            Route::get('admin/inventory/status', 'status')->name('cafeto.admin.inventory.status'); // Producto vencidos y por vencer (Administrador)
            Route::get('cashier/inventory/status', 'status')->name('cafeto.cashier.inventory.status'); // Producto vencidos y por vencer (Cajero)
            Route::get('admin/inventory/low', 'low_create')->name('cafeto.admin.inventory.low'); // Formulario de registro de bajas de inventario (Administrador)
            Route::get('cashier/inventory/low', 'low_create')->name('cafeto.cashier.inventory.low'); // Formulario de registro de bajas de inventario (Cajero)


            //Rutas para reportes de inventario
            Route::get('admin/reports/index', 'reports')->name('ptventa.admin.reports.index'); // Vista principal de la sección de reportes (Administrador)
            Route::get('cashier/reports/index', 'reports')->name('ptventa.cashier.reports.index'); // Vista principal de la sección de reportes (Cajero)


            // Reportes de entrada de inventario - Ruta para mostrar el formulario
            Route::get('reports/inventory/entries', 'showInventoryEntriesForm')->name('cafeto.reports.inventory.entries'); // Vista de consulta de entradas de inventario por fecha
            Route::post('reports/inventory/entries', 'generateInventoryEntries')->name('cafeto.reports.generate.inventory.entries'); // Realizar consulta de entradas de inventario por fechas recibidas 
            Route::post('reports/inventory/entries/generatepdf', 'generateInventoryEntriesPDF')->name('cafeto.reports.generate.entries.pdf'); // Generar PDF de entradas de inventario


            // Reportes de entrada de inventario - Ruta para mostrar el formulario
            Route::get('reports/inventory/entries', 'showInventoryEntriesForm')->name('cafeto.reports.inventory.entries'); // Vista de consulta de entradas de inventario por fecha
            Route::post('reports/inventory/entries', 'generateInventoryEntries')->name('cafeto.reports.generate.inventory.entries'); // Realizar consulta de entradas de inventario por fechas recibidas
            Route::post('reports/inventory/entries/generatepdf', 'generateInventoryEntriesPDF')->name('cafeto.reports.generate.entries.pdf'); // Generar PDF de entradas de inventario
        });

        /* Rutas para administrar las ventas */
        Route::controller(SaleController::class)->group(function () {
            Route::get('admin/sale/index', 'index')->name('cafeto.admin.sale.index'); // Vista principal de ventas realizadas en sesión de caja (Administrador)
        });

        /* Ruta para admiistrar los pruductos */
        Route::controller(ElementController::class)->group(function () {
            Route::get('admin/element/index', 'index')->name('cafeto.admin.element.index'); // Vista principal de productos (Administrador)
            Route::get('edit/{element}', 'edit')->name('cafeto.element.edit'); // Vista del formulario para acutalizar imagen de elemento
            Route::post('update/{element}', 'update')->name('cafeto.element.update'); // Carga de nueva imagen para elemento
            Route::get('create', 'create')->name('cafeto.element.create');
            Route::post('store', 'store')->name('cafeto.element.store');
        });
    });
});
