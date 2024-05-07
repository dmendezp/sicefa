<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['lang'])->group(function () {  // Middleware para la internzación (manejo de idiomas) y verficación de permisos y roles
    Route::prefix('cafeto')->group(function () { //Agrega el prefijo en la url (sicefa.test/cafeto/...).

        // Rutas generales para el módulo CAFETO
        Route::controller(CAFETOController::class)->group(function () { //Agrega por única vez el controlador, para que seguidamente sea solo.
            Route::get('index', 'index')->name('cefa.cafeto.index'); // Vista principal y pública de la aplicación (Pública)
            Route::get('developers', 'devs')->name('cefa.cafeto.devs'); // Vista de creditos y desarrolladores, pública de la aplicación (Pública)
            Route::get('information', 'info')->name('cefa.cafeto.info'); // Vista mas info sobre cafeto y pública de la aplicación (Pública)
            Route::get('admin', 'admin')->name('cafeto.admin.index'); // Vista principal del Administrador (Administrador)
            Route::get('cashier', 'cashier')->name('cafeto.cashier.index'); // Vista principal del Cajero (Cajero)
            Route::get('admin/configuration', 'configuration')->name('cafeto.admin.configuration.index'); // Vista de configuracion, como generar un ticket o factura de prueba y verificar la conexion de la impresora, etc. (Administrador)
            Route::get('cashier/configuration', 'configuration')->name('cafeto.cashier.configuration.index'); // Vista de configuracion, como generar un ticket o factura de prueba y verificar la conexion de la impresora, etc. (Cajero)
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

            //--------------------Rutas para reportes--------------------
            Route::get('admin/reports/index', 'reports')->name('cafeto.admin.reports.index'); // Vista principal de la sección de reportes (Administrador)
            Route::get('cashier/reports/index', 'reports')->name('cafeto.cashier.reports.index'); // Vista principal de la sección de reportes (Cajero)
            // Reportes de inventario
            Route::post('admin/reports/inventory/generatepdf', 'generateInventoryPDF')->name('cafeto.admin.reports.inventory.generate.pdf'); // Generar PDF del inventario actual (Administrador)
            Route::post('cashier/reports/inventory/generatepdf', 'generateInventoryPDF')->name('cafeto.cashier.reports.inventory.generate.pdf'); // Generar PDF del inventario actual (Cajero)
            // Reportes de entrada de inventario - Ruta para mostrar el formulario
            Route::get('admin/reports/inventory/entries', 'showInventoryEntriesForm')->name('cafeto.admin.reports.inventory.entries'); // Vista de consulta de entradas de inventario por fecha (Administrador)
            Route::get('cashier/reports/inventory/entries', 'showInventoryEntriesForm')->name('cafeto.cashier.reports.inventory.entries'); // Vista de consulta de entradas de inventario por fecha (Cajero)
            Route::post('admin/reports/inventory/entries', 'generateInventoryEntries')->name('cafeto.admin.reports.generate.inventory.entries'); // Realizar consulta de entradas de inventario por fechas recibidas (Administrador)
            Route::post('cashier/reports/inventory/entries', 'generateInventoryEntries')->name('cafeto.cashier.reports.generate.inventory.entries'); // Realizar consulta de entradas de inventario por fechas recibidas (Cajero)
            Route::post('admin/reports/inventory/entries/generatepdf', 'generateInventoryEntriesPDF')->name('cafeto.admin.reports.generate.entries.pdf'); // Generar PDF de entradas de inventario (Administrador)
            Route::post('cashier/reports/inventory/entries/generatepdf', 'generateInventoryEntriesPDF')->name('cafeto.cashier.reports.generate.entries.pdf'); // Generar PDF de entradas de inventario (Cajero)
            // Reportes de ventas
            Route::get('admin/reports/sales', 'showSalesForm')->name('cafeto.admin.reports.sales'); // Vista de consulta de ventas realizadas por fechas (Administrador)
            Route::get('cashier/reports/sales', 'showSalesForm')->name('cafeto.cashier.reports.sales'); // Vista de consulta de ventas realizadas por fechas (Cajero)
            Route::post('admin/reports/sales', 'generateSales')->name('cafeto.admin.reports.generate.sales'); // Realizar consulta de ventas realizadas por fechas recibidas (Administrador)
            Route::post('cashier/reports/sales', 'generateSales')->name('cafeto.cashier.reports.generate.sales'); // Realizar consulta de ventas realizadas por fechas recibidas (Cajero)
            Route::post('admin/reports/sales/generatepdf', 'generateSalesPDF')->name('cafeto.admin.reports.generate.sales.pdf'); // Generar PDF de ventas realizadas (Administrador)
            Route::post('cashier/reports/sales/generatepdf', 'generateSalesPDF')->name('cafeto.cashier.reports.generate.sales.pdf'); // Generar PDF de ventas realizadas (Cajero)
            Route::get('admin/entries/show/{movement}', 'show_entry')->name('cafeto.admin.movements.entries.show'); // Ver detalle de movimiento interno (Administrador)
            Route::get('cashier/entries/show/{movement}', 'show_entry')->name('cafeto.cashier.movements.entries.show'); // Ver detalle de movimiento interno (Cajero)
            // Reportes de bajas
            Route::get('admin/low/show/{movement}', 'showLow')->name('cafeto.admin.movements.low.show'); // Ver detalle de baja (Administrador)
            Route::get('cashier/low/show/{movement}', 'showLow')->name('cafeto.cashier.movements.low.show'); // Ver detalle de baja (Cajero)
        });

        // Rutas para ventas
        Route::controller(SaleController::class)->group(function () {
            Route::get('admin/sale/index', 'index')->name('cafeto.admin.sale.index'); // Vista principal de ventas realizadas en sesión de caja (Administrador)
            Route::get('cashier/sale/index', 'index')->name('cafeto.cashier.sale.index'); // Vista principal de ventas realizadas en sesión de caja (Cajero)
            Route::get('admin/sale/register', 'register')->name('cafeto.admin.sale.register'); // Formulario de registro de venta (Administrador)
            Route::get('cashier/sale/register', 'register')->name('cafeto.cashier.sale.register'); // Formulario de registro de venta (Cajero)
            /* Registrar permiso (cafeto.admin-cashier.generate.sale); Registrar venta (Administrador y Cajero) <Función Livewire> */
            Route::get('admin/sale/show/{movement}', 'show')->name('cafeto.admin.movements.sale.show'); // Ver detalle de venta (Administrador)
            Route::get('cashier/sale/show/{movement}', 'show')->name('cafeto.cashier.movements.sale.show'); // Ver detalle de venta (Cajero)
        });

        // Rutas para Elementos
        Route::controller(ElementController::class)->group(function () {
            Route::get('admin/element/index', 'index')->name('cafeto.admin.element.index'); // Vista principal de productos (Administrador)
            Route::get('admin/element/edit/{element}', 'edit')->name('cafeto.admin.element.edit'); // Formulario para actualizar producto (Administrador)
            Route::post('admin/element/update/{element}', 'update')->name('cafeto.admin.element.update'); // Actualizar producto (Administrador)
            Route::get('admin/element/create', 'create')->name('cafeto.admin.element.create'); // Formulario de registro de producto (Administrador)
            Route::post('admin/element/store', 'store')->name('cafeto.admin.element.store'); // Registrar producto (Administrador)
        });

        // Rutas para Caja
        Route::controller(CashController::class)->group(function () {
            Route::get('admin/cash/index', 'index')->name('cafeto.admin.cash.index'); // Vista principal de sesión de caja activa e historico de sesiones de caja (Administrador)
            Route::get('cashier/cash/index', 'index')->name('cafeto.cashier.cash.index'); // Vista principal de sesión de caja activa e historico de sesiones de caja (Cajero)
            Route::post('admin/cash/store', 'store')->name('cafeto.admin.cash.store'); // Registrar caja cuando no hay ninguna activa (Administrador)
            Route::post('cashier/cash/store', 'store')->name('cafeto.cashier.cash.store'); // Registrar caja cuando no hay ninguna activa (Cajero)
            Route::post('admin/cash/close', 'close')->name('cafeto.admin.cash.close'); // Cerrar sesión de caja (Administrador)
            Route::post('cashier/cash/close', 'close')->name('cafeto.cashier.cash.close'); // Cerrar sesión de caja (Cajero)
        });

        // Rutas para movements ó historico de cajas
        Route::controller(MovementController::class)->group(function () {
            Route::get('admin/movement/index', 'index')->name('cafeto.admin.movements.index'); // Vista principal de historico de movimientos (Administrador)
            Route::get('cashier/movement/index', 'index')->name('cafeto.cashier.movements.index'); // Vista principal de historico de movimientos (Cajero)
            Route::post('admin/movement/consult', 'consult')->name('cafeto.admin.movements.consult'); // Consultar movimientos por fecha y actor (Administrador)
            Route::post('cashier/movement/consult', 'consult')->name('cafeto.cashier.movements.consult'); // Consultar movimientos por fecha y actor (Cajero)
        });

        // Rutas para recipes
        Route::controller(RecipesController::class)->group(function () {
            Route::get('admin/recipes/index', 'index')->name('cafeto.admin.recipes.index'); // Vista principal de recetas (Administrador)
            Route::get('cashier/recipes/index', 'index')->name('cafeto.cashier.recipes.index'); // Vista principal de recetas (Cajero)
            Route::get('admin/recipes/create', 'create')->name('cafeto.admin.recipes.create'); // Vista de creación de recetas (Administrador)
            Route::get('cashier/recipes/create', 'create')->name('cafeto.cashier.recipes.create'); // Vista de creación de recetas (Cajero)
            Route::get('admin/recipes/details', 'details')->name('cafeto.admin.recipes.details'); // Vista detalles de una receta (Administrador)
            Route::get('cashier/recipes/details', 'details')->name('cafeto.cashier.recipes.details'); // Vista detalles de una receta (Cajero)
        });
    });
});
