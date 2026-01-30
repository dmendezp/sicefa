<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['lang'])->prefix('cafeto')->group(function () {

    /* ===================== HOME / PÁGINAS PÚBLICAS ===================== */
    Route::controller(CAFETOController::class)->group(function () {
        Route::get('index', 'index')->name('cefa.cafeto.index');
        Route::get('developers', 'devs')->name('cefa.cafeto.devs');
        Route::get('information', 'info')->name('cefa.cafeto.info');

        // HOME por rol (estos 3 deben existir para navbar/sidebar)
        Route::get('admin', 'admin')->name('cafeto.admin.index');

        // ✅ NUEVOS HOME POR ROL (vistas nuevas: cashier-index / instructor-index)
        Route::get('cashier', 'cashier')->name('cafeto.cashier.index');
        Route::get('instructor', 'instructor')->name('cafeto.instructor.index');

        Route::get('admin/configuration', 'configuration')->name('cafeto.admin.configuration.index');
        Route::get('cashier/configuration', 'configuration')->name('cafeto.cashier.configuration.index');
        Route::get('instructor/configuration', 'configuration')->name('cafeto.instructor.configuration.index');
    });

    /* ===================== INVENTARIO ===================== */
    Route::controller(InventoryController::class)->group(function () {

        // Index
        Route::get('admin/inventory/index', 'index')->name('cafeto.admin.inventory.index');
        Route::get('cashier/inventory/index', 'index')->name('cafeto.cashier.inventory.index');
        Route::get('instructor/inventory/index', 'index')->name('cafeto.instructor.inventory.index');

        // Create / Store (Entradas)
        Route::get('admin/inventory/create', 'create')->name('cafeto.admin.inventory.create');
        Route::get('cashier/inventory/create', 'create')->name('cafeto.cashier.inventory.create');
        Route::get('instructor/inventory/create', 'create')->name('cafeto.instructor.inventory.create');

        Route::post('admin/inventory/store', 'store')->name('cafeto.admin.inventory.store');
        Route::post('cashier/inventory/store', 'store')->name('cafeto.cashier.inventory.store');
        Route::post('instructor/inventory/store', 'store')->name('cafeto.instructor.inventory.store');

        // Estado / vencimientos
        Route::get('admin/inventory/status', 'status')->name('cafeto.admin.inventory.status');
        Route::get('cashier/inventory/status', 'status')->name('cafeto.cashier.inventory.status');
        Route::get('instructor/inventory/status', 'status')->name('cafeto.instructor.inventory.status');

        // Bajas
        Route::get('admin/inventory/low', 'low_create')->name('cafeto.admin.inventory.low');
        Route::get('cashier/inventory/low', 'low_create')->name('cafeto.cashier.inventory.low');
        Route::get('instructor/inventory/low', 'low_create')->name('cafeto.instructor.inventory.low');

        // Populares
        Route::post('admin/inventory/popular/{elementId}', 'togglePopular')->name('cafeto.admin.inventory.popular.toggle');
        Route::post('cashier/inventory/popular/{elementId}', 'togglePopular')->name('cafeto.cashier.inventory.popular.toggle');
        Route::post('instructor/inventory/popular/{elementId}', 'togglePopular')->name('cafeto.instructor.inventory.popular.toggle');

        // Reportes (vista)
        Route::get('admin/reports/index', 'reports')->name('cafeto.admin.reports.index');
        Route::get('cashier/reports/index', 'reports')->name('cafeto.cashier.reports.index');
        Route::get('instructor/reports/index', 'reports')->name('cafeto.instructor.reports.index');

        // Reporte inventario PDF
        Route::post('admin/reports/inventory/generatepdf', 'generateInventoryPDF')->name('cafeto.admin.reports.inventory.generate.pdf');
        Route::post('cashier/reports/inventory/generatepdf', 'generateInventoryPDF')->name('cafeto.cashier.reports.inventory.generate.pdf');
        Route::post('instructor/reports/inventory/generatepdf', 'generateInventoryPDF')->name('cafeto.instructor.reports.inventory.generate.pdf');

        // Entradas inventario (form + generar + pdf)
        Route::get('admin/reports/inventory/entries', 'showInventoryEntriesForm')->name('cafeto.admin.reports.inventory.entries');
        Route::get('cashier/reports/inventory/entries', 'showInventoryEntriesForm')->name('cafeto.cashier.reports.inventory.entries');
        Route::get('instructor/reports/inventory/entries', 'showInventoryEntriesForm')->name('cafeto.instructor.reports.inventory.entries');

        Route::post('admin/reports/inventory/entries', 'generateInventoryEntries')->name('cafeto.admin.reports.generate.inventory.entries');
        Route::post('cashier/reports/inventory/entries', 'generateInventoryEntries')->name('cafeto.cashier.reports.generate.inventory.entries');
        Route::post('instructor/reports/inventory/entries', 'generateInventoryEntries')->name('cafeto.instructor.reports.generate.inventory.entries');

        Route::post('admin/reports/inventory/entries/generatepdf', 'generateInventoryEntriesPDF')->name('cafeto.admin.reports.generate.entries.pdf');
        Route::post('cashier/reports/inventory/entries/generatepdf', 'generateInventoryEntriesPDF')->name('cafeto.cashier.reports.generate.entries.pdf');
        Route::post('instructor/reports/inventory/entries/generatepdf', 'generateInventoryEntriesPDF')->name('cafeto.instructor.reports.generate.entries.pdf');

        // Ventas (form + generar + pdf + productos pdf)
        Route::get('admin/reports/sales', 'showSalesForm')->name('cafeto.admin.reports.sales');
        Route::get('cashier/reports/sales', 'showSalesForm')->name('cafeto.cashier.reports.sales');
        Route::get('instructor/reports/sales', 'showSalesForm')->name('cafeto.instructor.reports.sales');

        Route::post('admin/reports/sales', 'generateSales')->name('cafeto.admin.reports.generate.sales');
        Route::post('cashier/reports/sales', 'generateSales')->name('cafeto.cashier.reports.generate.sales');
        Route::post('instructor/reports/sales', 'generateSales')->name('cafeto.instructor.reports.generate.sales');

        Route::post('admin/reports/sales/generatepdf', 'generateSalesPDF')->name('cafeto.admin.reports.generate.sales.pdf');
        Route::post('cashier/reports/sales/generatepdf', 'generateSalesPDF')->name('cafeto.cashier.reports.generate.sales.pdf');
        Route::post('instructor/reports/sales/generatepdf', 'generateSalesPDF')->name('cafeto.instructor.reports.generate.sales.pdf');

        Route::post('admin/reports/sales/products/generatepdf', 'generateSalesProductsPDF')->name('cafeto.admin.reports.generate.sales.products.pdf');
        Route::post('cashier/reports/sales/products/generatepdf', 'generateSalesProductsPDF')->name('cafeto.cashier.reports.generate.sales.products.pdf');
        Route::post('instructor/reports/sales/products/generatepdf', 'generateSalesProductsPDF')->name('cafeto.instructor.reports.generate.sales.products.pdf');

        // Show de comprobantes (entradas y bajas)
        Route::get('admin/entries/show/{movement}', 'show_entry')->name('cafeto.admin.movements.entries.show');
        Route::get('cashier/entries/show/{movement}', 'show_entry')->name('cafeto.cashier.movements.entries.show');
        Route::get('instructor/entries/show/{movement}', 'show_entry')->name('cafeto.instructor.movements.entries.show');

        Route::get('admin/low/show/{movement}', 'showLow')->name('cafeto.admin.movements.low.show');
        Route::get('cashier/low/show/{movement}', 'showLow')->name('cafeto.cashier.movements.low.show');
        Route::get('instructor/low/show/{movement}', 'showLow')->name('cafeto.instructor.movements.low.show');
    });

    /* ===================== VENTAS ===================== */
    Route::controller(SaleController::class)->group(function () {
        Route::get('admin/sale/index', 'index')->name('cafeto.admin.sale.index');
        Route::get('cashier/sale/index', 'index')->name('cafeto.cashier.sale.index');
        Route::get('instructor/sale/index', 'index')->name('cafeto.instructor.sale.index');

        Route::get('admin/sale/register', 'register')->name('cafeto.admin.sale.register');
        Route::get('cashier/sale/register', 'register')->name('cafeto.cashier.sale.register');
        Route::get('instructor/sale/register', 'register')->name('cafeto.instructor.sale.register');

        Route::post('admin/sale/store', 'store')->name('cafeto.admin.sale.store');
        Route::post('cashier/sale/store', 'store')->name('cafeto.cashier.sale.store');
        Route::post('instructor/sale/store', 'store')->name('cafeto.instructor.sale.store');

        Route::get('admin/sale/show/{movement}', 'show')->name('cafeto.admin.movements.sale.show');
        Route::get('cashier/sale/show/{movement}', 'show')->name('cafeto.cashier.movements.sale.show');
        Route::get('instructor/sale/show/{movement}', 'show')->name('cafeto.instructor.movements.sale.show');
    });

    /* ===================== ELEMENTOS ===================== */
    Route::controller(ElementController::class)->group(function () {

        // ADMIN
        Route::prefix('admin/element')->group(function () {
            Route::get('index', 'index')->name('cafeto.admin.element.index');
            Route::get('create', 'create')->name('cafeto.admin.element.create');
            Route::post('store', 'store')->name('cafeto.admin.element.store');
            Route::get('edit/{element_key}', 'edit')->name('cafeto.admin.element.edit');
            Route::match(['put','patch'], 'update/{element_key}', 'update')->name('cafeto.admin.element.update');
        });

        // CASHIER / INSTRUCTOR (reservado)
        Route::prefix('cashier/element')->group(function () { /* sin rutas */ });
        Route::prefix('instructor/element')->group(function () { /* sin rutas */ });
    });

    /* ===================== CAJA ===================== */
    Route::controller(CashController::class)->group(function () {
        Route::get('admin/cash/index', 'index')->name('cafeto.admin.cash.index');
        Route::get('cashier/cash/index', 'index')->name('cafeto.cashier.cash.index');
        Route::get('instructor/cash/index', 'index')->name('cafeto.instructor.cash.index');

        Route::post('admin/cash/store', 'store')->name('cafeto.admin.cash.store');
        Route::post('cashier/cash/store', 'store')->name('cafeto.cashier.cash.store');
        Route::post('instructor/cash/store', 'store')->name('cafeto.instructor.cash.store');

        Route::post('admin/cash/close', 'close')->name('cafeto.admin.cash.close');
        Route::post('cashier/cash/close', 'close')->name('cafeto.cashier.cash.close');
        Route::post('instructor/cash/close', 'close')->name('cafeto.instructor.cash.close');
    });

    /* ===================== MOVIMIENTOS ===================== */
    Route::controller(MovementController::class)->group(function () {
        Route::get('admin/movement/index', 'index')->name('cafeto.admin.movements.index');
        Route::get('cashier/movement/index', 'index')->name('cafeto.cashier.movements.index');
        Route::get('instructor/movement/index', 'index')->name('cafeto.instructor.movements.index');

        Route::post('admin/movement/consult', 'consult')->name('cafeto.admin.movements.consult');
        Route::post('cashier/movement/consult', 'consult')->name('cafeto.cashier.movements.consult');
        Route::post('instructor/movement/consult', 'consult')->name('cafeto.instructor.movements.consult');
    });

    /* ===================== FORMULACIONES ===================== */
    Route::controller(FormulationsController::class)->group(function () {

        // ADMIN
        Route::prefix('admin/formulations')->name('cafeto.admin.formulations.')->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('show/{formulation}', 'show')->name('show');
            Route::get('edit/{formulation}', 'edit')->name('edit');
            Route::match(['put','patch'], 'update/{formulation}', 'update')->name('update');
            Route::delete('delete/{formulation}', 'destroy')->name('destroy');
            Route::get('{formulation}/aprobar', 'approve')->name('approve');
            Route::post('{formulation}/aprobar', 'approveStore')->name('approve.store');
        });

        // INSTRUCTOR
        Route::prefix('instructor/formulations')->name('cafeto.instructor.formulations.')->group(function () {
            Route::get('index', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('store', 'store')->name('store');
            Route::get('show/{formulation}', 'show')->name('show');
            Route::get('edit/{formulation}', 'edit')->name('edit');
            Route::match(['put','patch'], 'update/{formulation}', 'update')->name('update');
            Route::delete('delete/{formulation}', 'destroy')->name('destroy');
            Route::get('{formulation}/aprobar', 'approve')->name('approve');
            Route::post('{formulation}/aprobar', 'approveStore')->name('approve.store');
        });

        // CASHIER
Route::prefix('cashier/formulations')->name('cafeto.cashier.formulations.')->group(function () {
    Route::get('index', 'index')->name('index');
    Route::get('create', 'create')->name('create');
    Route::post('store', 'store')->name('store');
    Route::get('show/{formulation}', 'show')->name('show');

    Route::get('edit/{formulation}', 'edit')->name('edit');
    Route::match(['put','patch'], 'update/{formulation}', 'update')->name('update');

    Route::delete('delete/{formulation}', 'destroy')->name('destroy');


        });
    });
});
