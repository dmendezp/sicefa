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
    Route::prefix('ptventa')->group(function() {  // Agrega el prefijo en la url (sicefa.test/ptventa/...)

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
            Route::get('admin/inventory/low', 'low_create')->name('ptventa.admin.inventory.low'); // Formulario de registro de bajas de inventario (Administrador)
            Route::get('cashier/inventory/low', 'low_create')->name('ptventa.cashier.inventory.low'); // Formulario de registro de bajas de inventario (Cajero)

            //--------------------Rutas para reportes--------------------
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
            Route::get('admin/entries/show/{movement}', 'show_entry')->name('ptventa.admin.movements.entries.show'); // Ver detalle de movimiento interno (Administrador)
            Route::get('cashier/entries/show/{movement}', 'show_entry')->name('ptventa.cashier.movements.entries.show'); // Ver detalle de movimiento interno (Cajero)
            // Reportes de bajas
            Route::get('admin/low/show/{movement}', 'showLow')->name('ptventa.admin.movements.low.show'); // Ver detalle de baja (Administrador)
            Route::get('cashier/low/show/{movement}', 'showLow')->name('ptventa.cashier.movements.low.show'); // Ver detalle de baja (Cajero)
            // Reportes de Productos
            Route::get('admin/reports/products/generatepdf', 'generateProductsPDF')->name('ptventa.admin.reports.products.generate.pdf'); // Generar PDF de productos actual (Administrador)
            Route::get('cashier/reports/products/generatepdf', 'generateProductsPDF')->name('ptventa.cashier.reports.products.generate.pdf'); // Generar PDF de productos actual (Cajero)
        });

        // Rutas para Ventas
        Route::controller(SaleController::class)->group(function(){
            Route::get('admin/sale/index', 'index')->name('ptventa.admin.sale.index'); // Vista principal de ventas realizadas en sesión de caja (Administrador)
            Route::get('cashier/sale/index', 'index')->name('ptventa.cashier.sale.index'); // Vista principal de ventas realizadas en sesión de caja (Cajero)
            Route::get('admin/sale/register', 'register')->name('ptventa.admin.sale.register'); // Formulario de registro de venta (Administrador)
            Route::get('cashier/sale/register', 'register')->name('ptventa.cashier.sale.register'); // Formulario de registro de venta (Cajero)
            /* Registrar permiso (ptventa.admin-cashier.generate.sale); Registrar venta (Administrador y Cajero) <Función Livewire> */
            Route::get('admin/sale/show/{movement}', 'show')->name('ptventa.admin.movements.sale.show'); // Ver detalle de venta (Administrador)
            Route::get('cashier/sale/show/{movement}', 'show')->name('ptventa.cashier.movements.sale.show'); // Ver detalle de venta (Cajero)
        });

        // Rutas para Elementos
        Route::controller(ElementController::class)->group(function(){
            Route::get('admin/element/index', 'index')->name('ptventa.admin.element.index'); // Vista principal de productos (Administrador)
            Route::get('admin/element/edit/{element}', 'edit')->name('ptventa.admin.element.edit'); // Formulario para actualizar producto (Administrador)
            Route::post('admin/element/update/{element}', 'update')->name('ptventa.admin.element.update'); // Actualizar producto (Administrador)
            Route::get('admin/element/create', 'create')->name('ptventa.admin.element.create'); // Formulario de registro de producto (Administrador)
            Route::post('admin/element/store', 'store')->name('ptventa.admin.element.store'); // Registrar producto (Administrador)

        });

        // Rutas para Caja
        Route::controller(CashController::class)->group(function(){
            Route::get('admin/cash/index', 'index')->name('ptventa.admin.cash.index'); // Vista principal de sesión de caja activa e historico de sesiones de caja (Administrador)
            Route::get('cashier/cash/index', 'index')->name('ptventa.cashier.cash.index'); // Vista principal de sesión de caja activa e historico de sesiones de caja (Cajero)
            Route::post('admin/cash/store', 'store')->name('ptventa.admin.cash.store'); // Registrar caja cuando no hay ninguna activa (Administrador)
            Route::post('cashier/cash/store', 'store')->name('ptventa.cashier.cash.store'); // Registrar caja cuando no hay ninguna activa (Cajero)
            Route::post('admin/cash/close', 'close')->name('ptventa.admin.cash.close'); // Cerrar sesión de caja (Administrador)
            Route::post('cashier/cash/close', 'close')->name('ptventa.cashier.cash.close'); // Cerrar sesión de caja (Cajero)
        });

        // Rutas para movements ó historico de cajas
        Route::controller(MovementController::class)->group(function(){
            Route::get('admin/movement/index', 'index')->name('ptventa.admin.movements.index'); // Vista principal de historico de movimientos (Administrador)
            Route::get('cashier/movement/index', 'index')->name('ptventa.cashier.movements.index'); // Vista principal de historico de movimientos (Cajero)
            Route::post('admin/movement/consult', 'consult')->name('ptventa.admin.movements.consult'); // Consultar movimientos por fecha y actor (Administrador)
            Route::post('cashier/movement/consult', 'consult')->name('ptventa.cashier.movements.consult'); // Consultar movimientos por fecha y actor (Cajero)
        });

    });
});
