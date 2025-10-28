<?php

use Illuminate\Support\Facades\Route;




Route::middleware(['lang'])->group(function () {
    Route::prefix('cafeto')->group(function () {
        // Rutas generales para el módulo CAFETO
        Route::controller(CAFETOController::class)->group(function () {
            Route::get('index', 'index')->name('cefa.cafeto.index');
            Route::get('developers', 'devs')->name('cefa.cafeto.devs');
            Route::get('information', 'info')->name('cefa.cafeto.info');
            Route::get('admin', 'admin')->name('cafeto.admin.index');
            Route::get('cashier', 'cashier')->name('cafeto.cashier.index');
            Route::get('instructor', 'instructor')->name('cafeto.instructor.index');
            Route::get('admin/configuration', 'configuration')->name('cafeto.admin.configuration.index');
            Route::get('cashier/configuration', 'configuration')->name('cafeto.cashier.configuration.index');
        });

        // Rutas para Inventario
        Route::controller(InventoryController::class)->group(function () {
            Route::get('admin/inventory/index', 'index')->name('cafeto.admin.inventory.index');
            Route::get('cashier/inventory/index', 'index')->name('cafeto.cashier.inventory.index');
            Route::get('admin/inventory/create', 'create')->name('cafeto.admin.inventory.create');
            Route::get('cashier/inventory/create', 'create')->name('cafeto.cashier.inventory.create');
            Route::get('admin/inventory/status', 'status')->name('cafeto.admin.inventory.status');
            Route::get('cashier/inventory/status', 'status')->name('cafeto.cashier.inventory.status');
            Route::get('admin/inventory/low', 'low_create')->name('cafeto.admin.inventory.low');
            Route::get('cashier/inventory/low', 'low_create')->name('cafeto.cashier.inventory.low');

            // Reportes
            Route::get('admin/reports/index', 'reports')->name('cafeto.admin.reports.index');
            Route::get('cashier/reports/index', 'reports')->name('cafeto.cashier.reports.index');
            Route::post('admin/reports/inventory/generatepdf', 'generateInventoryPDF')->name('cafeto.admin.reports.inventory.generate.pdf');
            Route::post('cashier/reports/inventory/generatepdf', 'generateInventoryPDF')->name('cafeto.cashier.reports.inventory.generate.pdf');
            Route::get('admin/reports/inventory/entries', 'showInventoryEntriesForm')->name('cafeto.admin.reports.inventory.entries');
            Route::get('cashier/reports/inventory/entries', 'showInventoryEntriesForm')->name('cafeto.cashier.reports.inventory.entries');
            Route::post('admin/reports/inventory/entries', 'generateInventoryEntries')->name('cafeto.admin.reports.generate.inventory.entries');
            Route::post('cashier/reports/inventory/entries', 'generateInventoryEntries')->name('cafeto.cashier.reports.generate.inventory.entries');
            Route::post('admin/reports/inventory/entries/generatepdf', 'generateInventoryEntriesPDF')->name('cafeto.admin.reports.generate.entries.pdf');
            Route::post('cashier/reports/inventory/entries/generatepdf', 'generateInventoryEntriesPDF')->name('cafeto.cashier.reports.generate.entries.pdf');
            Route::get('admin/reports/sales', 'showSalesForm')->name('cafeto.admin.reports.sales');
            Route::get('cashier/reports/sales', 'showSalesForm')->name('cafeto.cashier.reports.sales');
            Route::post('admin/reports/sales', 'generateSales')->name('cafeto.admin.reports.generate.sales');
            Route::post('cashier/reports/sales', 'generateSales')->name('cafeto.cashier.reports.generate.sales');
            Route::post('admin/reports/sales/generatepdf', 'generateSalesPDF')->name('cafeto.admin.reports.generate.sales.pdf');
            Route::post('cashier/reports/sales/generatepdf', 'generateSalesPDF')->name('cafeto.cashier.reports.generate.sales.pdf');
            Route::get('admin/entries/show/{movement}', 'show_entry')->name('cafeto.admin.movements.entries.show');
            Route::get('cashier/entries/show/{movement}', 'show_entry')->name('cafeto.cashier.movements.entries.show');
            Route::get('admin/low/show/{movement}', 'showLow')->name('cafeto.admin.movements.low.show');
            Route::get('cashier/low/show/{movement}', 'showLow')->name('cafeto.cashier.movements.low.show');
        });

        // Rutas para Ventas
        Route::controller(SaleController::class)->group(function () {
            Route::get('admin/sale/index', 'index')->name('cafeto.admin.sale.index');
            Route::get('cashier/sale/index', 'index')->name('cafeto.cashier.sale.index');
            Route::get('admin/sale/register', 'register')->name('cafeto.admin.sale.register');
            Route::get('cashier/sale/register', 'register')->name('cafeto.cashier.sale.register');
            Route::get('admin/sale/show/{movement}', 'show')->name('cafeto.admin.movements.sale.show');
            Route::get('cashier/sale/show/{movement}', 'show')->name('cafeto.cashier.movements.sale.show');
        });

        // Rutas para Elementos
        Route::controller(ElementController::class)->group(function () {
            Route::get('admin/element/index', 'index')->name('cafeto.admin.element.index');
            Route::get('admin/element/edit/{element}', 'edit')->name('cafeto.admin.element.edit');
            Route::post('admin/element/update/{element}', 'update')->name('cafeto.admin.element.update');
            Route::get('admin/element/create', 'create')->name('cafeto.admin.element.create');
            Route::post('admin/element/store', 'store')->name('cafeto.admin.element.store');
        });

        // Rutas para Caja
        Route::controller(CashController::class)->group(function () {
            Route::get('admin/cash/index', 'index')->name('cafeto.admin.cash.index');
            Route::get('cashier/cash/index', 'index')->name('cafeto.cashier.cash.index');
            Route::post('admin/cash/store', 'store')->name('cafeto.admin.cash.store');
            Route::post('cashier/cash/store', 'store')->name('cafeto.cashier.cash.store');
            Route::post('admin/cash/close', 'close')->name('cafeto.admin.cash.close');
            Route::post('cashier/cash/close', 'close')->name('cafeto.cashier.cash.close');
        });

        // Rutas para Movimientos
        Route::controller(MovementController::class)->group(function () {
            Route::get('admin/movement/index', 'index')->name('cafeto.admin.movements.index');
            Route::get('cashier/movement/index', 'index')->name('cafeto.cashier.movements.index');
            Route::post('admin/movement/consult', 'consult')->name('cafeto.admin.movements.consult');
            Route::post('cashier/movement/consult', 'consult')->name('cafeto.cashier.movements.consult');
        });

        // // Rutas para Recetas
        // Route::controller(RecipesController::class)->group(function () {
        //     Route::get('admin/recipes/index', 'index')->name('cafeto.admin.recipes.index');
        //     Route::get('cashier/recipes/index', 'index')->name('cafeto.cashier.recipes.index');
        //     Route::get('admin/recipes/create', 'create')->name('cafeto.admin.recipes.create');
        //     Route::get('cashier/recipes/create', 'create')->name('cafeto.cashier.recipes.create');
        //     Route::get('admin/recipes/details', 'details')->name('cafeto.admin.recipes.details');
        //     Route::get('cashier/recipes/details', 'details')->name('cafeto.cashier.recipes.details');
        // });

        // Rutas para Formulaciones
        Route::controller(FormulationsController::class)->group(function () {
            // Admin routes (full CRUD)
            Route::get('admin/formulations/index', 'index')->name('cafeto.admin.formulations.index');
            Route::get('admin/formulations/create', 'create')->name('cafeto.admin.formulations.create');
            Route::post('admin/formulations/store', 'store')->name('cafeto.admin.formulations.store');
            Route::get('admin/formulations/edit/{formulation}', 'edit')->name('cafeto.admin.formulations.edit');
            Route::post('admin/formulations/update/{formulation}', 'update')->name('cafeto.admin.formulations.update');
            Route::post('admin/formulations/approve/{formulation}', 'approve')->name('cafeto.admin.formulations.approve');
            Route::delete('admin/formulations/delete/{formulation}', 'destroy')->name('cafeto.admin.formulations.destroy');
            Route::get('admin/formulations/show/{formulation}', 'show')->name('cafeto.admin.formulations.show');

            // Instructor routes (full CRUD)
            Route::get('instructor/formulations/index', 'index')->name('cafeto.instructor.formulations.index');
            Route::get('instructor/formulations/create', 'create')->name('cafeto.instructor.formulations.create');
            Route::post('instructor/formulations/store', 'store')->name('cafeto.instructor.formulations.store');
            Route::get('instructor/formulations/edit/{formulation}', 'edit')->name('cafeto.instructor.formulations.edit');
            Route::post('instructor/formulations/update/{formulation}', 'update')->name('cafeto.instructor.formulations.update');
            Route::post('instructor/formulations/approve/{formulation}', 'approve')->name('cafeto.instructor.formulations.approve');
            Route::delete('instructor/formulations/delete/{formulation}', 'destroy')->name('cafeto.instructor.formulations.destroy');
            Route::get('instructor/formulations/show/{formulation}', 'show')->name('cafeto.instructor.formulations.show');

            // Cashier routes (create and view own formulations)
            Route::get('cashier/formulations/index', 'index')->name('cafeto.cashier.formulations.index');
            Route::get('cashier/formulations/create', 'create')->name('cafeto.cashier.formulations.create');
            Route::post('cashier/formulations/store', 'store')->name('cafeto.cashier.formulations.store');
            Route::get('cashier/formulations/show/{formulation}', 'show')->name('cafeto.cashier.formulations.show');
        });
    });
});