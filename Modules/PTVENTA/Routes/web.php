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
            Route::get('index', 'index')->name('cefa.ptventa.index'); // Vista principal y pública de la aplicación (Pública)
            Route::get('developers', 'devs')->name('cefa.ptventa.devs'); // Vista de creditos ydesarrolladores, pública de la aplicación (Pública)
            Route::get('information', 'info')->name('cefa.ptventa.info'); // Vista mas info sobre PTVENTA y pública de la aplicación (Pública)
            Route::get('admin', 'admin')->name('ptventa.admin.index'); // Vista principal del Administrador (Administrador)
            Route::get('cashier', 'cashier')->name('ptventa.cashier.index'); // Vista principal del Cajero (Cajero)
            Route::get('admin/configuration', 'configuration')->name('ptventa.admin.configuration.index'); // Vista de configuracion, como generar un ticket o factura de prueba y verificar la conexion de la impresora, etc. (Administrador)
            Route::get('cashier/configuration', 'configuration')->name('ptventa.cashier.configuration.index'); // Vista de configuracion, como generar un ticket o factura de prueba y verificar la conexion de la impresora, etc. (Cajero)
        });

        // Rutas para Inventario
        Route::controller(InventoryController::class)->group(function(){
            Route::get('admin/inventory/index', 'index')->name('ptventa.admin.inventory.index'); // Inventario actual (Administrador)
            Route::get('cashier/inventory/index', 'index')->name('ptventa.cashier.inventory.index'); // Inventario actual (Cajero)
            Route::get('admin/inventory/create', 'create')->name('ptventa.admin.inventory.create'); // Formulario de registro de entrada de inventario (Administrador)
            Route::get('cashier/inventory/create', 'create')->name('ptventa.cashier.inventory.create'); // Formulario de registro de entrada de inventario (Cajero)
            Route::get('admin/inventory/status', 'status')->name('ptventa.admin.inventory.status'); // Producto vencidos y por vencer (Administrador)
            Route::get('cashier/inventory/status', 'status')->name('ptventa.cashier.inventory.status'); // Producto vencidos y por vencer (Cajero)
        });

        // Rutas de reportes
        Route::controller(InventoryController::class)->group(function(){
            Route::get('admin/reports/index', 'reports')->name('ptventa.admin.reports.index'); // Vista principal de la sección de reportes (Administrador)
            Route::get('cashier/reports/index', 'reports')->name('ptventa.cashier.reports.index'); // Vista principal de la sección de reportes (Cajero)
            // Reportes de inventario
            Route::post('admin/reports/inventory/generatepdf', 'generateInventoryPDF')->name('ptventa.admin.reports.inventory.generate.pdf'); // Generar PDF del inventario actual (Administrador)
            Route::post('cashier/reports/inventory/generatepdf', 'generateInventoryPDF')->name('ptventa.cashier.reports.inventory.generate.pdf'); // Generar PDF del inventario actual (Cajero)
            // Reportes de entrada de inventario - Ruta para mostrar el formulario
            Route::get('admin/reports/inventory/entries', 'showInventoryEntriesForm')->name('ptventa.admin.reports.inventory.entries'); // Vista de consulta de entradas de inventario por fecha (Administrador)
            Route::get('cashier/reports/inventory/entries', 'showInventoryEntriesForm')->name('ptventa.cashier.reports.inventory.entries'); // Vista de consulta de entradas de inventario por fecha (Cajero)
            Route::post('admin/reports/inventory/entries', 'generateInventoryEntries')->name('ptventa.admin.reports.generate.inventory.entries'); // Realizar consulta de entradas de inventario por fechas recibidas (Administrador)
            Route::post('cashier/reports/inventory/entries', 'generateInventoryEntries')->name('ptventa.cashier.reports.generate.inventory.entries'); // Realizar consulta de entradas de inventario por fechas recibidas (Cajero)
            Route::post('admin/reports/inventory/entries/generatepdf', 'generateInventoryEntriesPDF')->name('ptventa.admin.reports.generate.entries.pdf'); // Generar PDF de entradas de inventario (Administrador)
            Route::post('cashier/reports/inventory/entries/generatepdf', 'generateInventoryEntriesPDF')->name('ptventa.cashier.reports.generate.entries.pdf'); // Generar PDF de entradas de inventario (Cajero)
            // Reportes de ventas
            Route::get('admin/reports/sales', 'showSalesForm')->name('ptventa.admin.reports.sales'); // Vista de consulta de ventas realizadas por fechas (Administrador)
            Route::get('cashier/reports/sales', 'showSalesForm')->name('ptventa.cashier.reports.sales'); // Vista de consulta de ventas realizadas por fechas (Cajero)
            Route::post('admin/reports/sales', 'generateSales')->name('ptventa.admin.reports.generate.sales'); // Realizar consulta de ventas realizadas por fechas recibidas (Administrador)
            Route::post('cashier/reports/sales', 'generateSales')->name('ptventa.cashier.reports.generate.sales'); // Realizar consulta de ventas realizadas por fechas recibidas (Cajero)
            Route::post('admin/reports/sales/generatepdf', 'generateSalesPDF')->name('ptventa.admin.reports.generate.sales.pdf'); // Generar PDF de ventas realizadas (Administrador)
            Route::post('cashier/reports/sales/generatepdf', 'generateSalesPDF')->name('ptventa.cashier.reports.generate.sales.pdf'); // Generar PDF de ventas realizadas (Cajero)
        });

        // Rutas para Ventas
        Route::controller(SaleController::class)->group(function(){
            Route::get('admin/sale/index', 'index')->name('ptventa.admin.sale.index'); // Vista principal de ventas realizadas en sesión de caja (Administrador)
            Route::get('cashier/sale/index', 'index')->name('ptventa.cashier.sale.index'); // Vista principal de ventas realizadas en sesión de caja (Cajero)
            Route::get('admin/sale/register', 'register')->name('ptventa.admin.sale.register'); // Formulario de registro de venta (Administrador)
            Route::get('cashier/sale/register', 'register')->name('ptventa.cashier.sale.register'); // Formulario de registro de venta (Cajero)
        });

        // Rutas para Elementos
        Route::controller(ElementController::class)->group(function(){
            Route::get('admin/element/index', 'index')->name('ptventa.admin.element.index'); // Vista principal de productos (Administrador)
            Route::get('element/edit/{element}', 'edit')->name('ptventa.admin.element.edit'); // Formulario para actualizar producto (Administrador)
            /* =================================================================================================================================================================================================== */
            Route::post('element/update/{element}', 'update')->name('ptventa.admin.element.update'); // Actualizar producto (Administrador)
            /* =================================================================================================================================================================================================== */
            Route::get('element/create', 'create')->name('ptventa.element.image.create');
            Route::post('element/store', 'store')->name('ptventa.element.image.store');

        });

        // Rutas para Caja
        Route::prefix('cash')->controller(CashController::class)->group(function(){
            Route::get('index', 'index')->name('ptventa.cash.index'); // Vista principal de caja
            Route::post('store', 'store')->name('ptventa.cash.store'); // Permite inicializar la primera caja de la aplicacion cuando no exita ninguna abierta
            Route::post('close', 'close')->name('ptventa.cash.close'); // Permite cerrar la caja y guardar los datos
        });

    });
});
