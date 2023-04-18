<?php

use Illuminate\Support\Facades\Route;
use Modules\SICA\Http\Controllers\inventory\InventoryController;
use Modules\SICA\Http\Controllers\inventory\ParameterController;

Route::middleware(['lang'])->group(function(){
    /* RUTAS PARA EL ROL DE ADMINISTRADOR */
    Route::prefix('sica/admin')->group(function() {
        // --------------  Rutas de Inventario ---------------------------------
        Route::prefix('inventory')->group(function(){ // Agregar por única vez el controlodaar para posteriormente solo definir rutas con el formato (url, método_controlador)->name(nombre_de_ruta)
            // --------------  Rutas de Bodegas ---------------------------------
            Route::get('warehouses', [InventoryController::class,  'warehouses'])->name('sica.admin.inventory.warehouses'); // Lista de bodegas

            // --------------  Rutas de Elementos ---------------------------------
            Route::get('elements', [InventoryController::class,  'elements'])->name('sica.admin.inventory.elements'); // Lista de bodegas

            // --------------  Rutas de Transacciones ---------------------------------
            Route::get('transactions', [InventoryController::class,  'transactions'])->name('sica.admin.inventory.transactions'); // Lista de transacciones

            // --------------  Rutas de Inventario ---------------------------------
            Route::get('inventory', [InventoryController::class,  'inventory'])->name('sica.admin.inventory.inventory'); // Lista de inventario
        });

        // --------------  Rutas de Parámetros ---------------------------------
        Route::prefix('inventory/parameters')->group(function () {
            Route::get('index', [ParameterController::class, 'index'])->name('sica.admin.inventory.parameters.index'); // Vista de tablas de parámetros

            // Edit
            Route::get('/admin/inventory/parameters/category/edit/{id}', [ParameterController::class, 'editCategoryGet'])->name('sica.admin.inventory.parameters.category.edit');
            Route::post('/admin/inventory/parameters/category/edit', [ParameterController::class, 'editCategoryPost'])->name('sica.admin.inventory.parameters.category.edit');

            // --------------  Rutas de Categorías ---------------------------------
            /* Route::prefix('category')->group(function () {
                //Route::get('create', [ParameterController::class, 'create'])->name('sica.admin.inventory.parameters.category.create'); // Formulario de registro de categoría
                // ...
            }); */

        });
    });
});
