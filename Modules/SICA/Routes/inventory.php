<?php

use Illuminate\Support\Facades\Route;
use Modules\SICA\Http\Controllers\inventory\InventoryController;
use Modules\SICA\Http\Controllers\inventory\ParameterController;

Route::middleware(['lang'])->prefix('sica/admin')->group(function() {

    // --------------  Rutas de Parámetros ---------------------------------
    Route::prefix('parameters')->group(function() {
        // ====================================================================================================================================================================================================================================================================
        Route::get('index', [ParameterController::class, 'index'])->name('sica.admin.inventory.parameters.index'); // Vista principal de parámetros para inventario (Administrador)
        // ====================================================================================================================================================================================================================================================================
        // Rutas de categorías
        Route::get('category/create', [ParameterController::class, 'createCategory'])->name('sica.admin.inventory.parameters.category.create');
        Route::post('category/store', [ParameterController::class, 'storeCategory'])->name('sica.admin.inventory.parameters.category.store');
        Route::get('category/edit/{id}', [ParameterController::class, 'editCategory'])->name('sica.admin.inventory.parameters.category.edit');
        Route::post('category/edit', [ParameterController::class, 'updateCategory'])->name('sica.admin.inventory.parameters.category.update');
        Route::get('category/delete/{id}', [ParameterController::class, 'deleteCategory'])->name('sica.admin.inventory.parameters.category.delete');
        Route::post('category/delete/', [ParameterController::class, 'destroyCategory'])->name('sica.admin.inventory.parameters.category.destroy');
        // Rutas de Unidades de medida
        Route::get('measurementUnit/create', [ParameterController::class, 'createMeasurementUnit'])->name('sica.admin.inventory.parameters.measurementUnit.create');
        Route::post('measurementUnit/store', [ParameterController::class, 'storeMeasurementUnit'])->name('sica.admin.inventory.parameters.measurementUnit.store');
        Route::get('measurementUnit/edit/{id}', [ParameterController::class, 'editMeasurementUnit'])->name('sica.admin.inventory.parameters.measurementUnit.edit');
        Route::post('measurementUnit/edit', [ParameterController::class, 'updateMeasurementUnit'])->name('sica.admin.inventory.parameters.measurementUnit.update');
        Route::get('measurementUnit/delete/{id}', [ParameterController::class, 'deletemeasurementUnit'])->name('sica.admin.inventory.parameters.measurementUnit.delete');
        Route::post('measurementUnit/delete/', [ParameterController::class, 'destroymeasurementUnit'])->name('sica.admin.inventory.parameters.measurementUnit.destroy');
        // Rutas de Tipos de compra
        Route::get('kindOfPurchase/create', [ParameterController::class, 'createKindOfPurchase'])->name('sica.admin.inventory.parameters.kindOfPurchase.create');
        Route::post('kindOfPurchase/add', [ParameterController::class, 'storeKindOfPurchase'])->name('sica.admin.inventory.parameters.kindOfPurchase.store');
        Route::get('kindOfPurchase/edit/{id}', [ParameterController::class, 'editKindOfPurchase'])->name('sica.admin.inventory.parameters.kindOfPurchase.edit');
        Route::post('kindOfPurchase/edit', [ParameterController::class, 'updateKindOfPurchase'])->name('sica.admin.inventory.parameters.kindOfPurchase.update');
        Route::get('kindOfPurchase/delete/{id}', [ParameterController::class, 'deleteKindOfPurchase'])->name('sica.admin.inventory.parameters.kindOfPurchase.delete');
        Route::post('kindOfPurchase/delete/', [ParameterController::class, 'destroyKindOfPurchase'])->name('sica.admin.inventory.parameters.kindOfPurchase.destroy');
        // Rutas de Tipos de movimiento
        Route::get('movement_type/create', [ParameterController::class, 'createMovementType'])->name('sica.admin.inventory.parameters.movement_type.create');
        Route::post('movement_type/add', [ParameterController::class, 'storeMovementType'])->name('sica.admin.inventory.parameters.movement_type.store');
        Route::get('movement_type/edit/{id}', [ParameterController::class, 'editMovementType'])->name('sica.admin.inventory.parameters.movement_type.edit');
        Route::post('movement_type/edit', [ParameterController::class, 'updateMovementType'])->name('sica.admin.inventory.parameters.movement_type.update');
        Route::get('movement_type/delete/{id}', [ParameterController::class, 'deleteMovementType'])->name('sica.admin.inventory.parameters.movement_type.delete');
        Route::post('movement_type/delete/', [ParameterController::class, 'destroyMovementType'])->name('sica.admin.inventory.parameters.movement_type.destroy');
    });

});


Route::middleware(['lang'])->group(function(){
    /* RUTAS PARA EL ROL DE ADMINISTRADOR */
    Route::prefix('sica/admin')->group(function() {
        // --------------  Rutas de Inventario ---------------------------------
        Route::prefix('inventory')->group(function(){ // Agregar por única vez el controlodaar para posteriormente solo definir rutas con el formato (url, método_controlador)->name(nombre_de_ruta)
            // --------------  Rutas de Bodegas ---------------------------------
            Route::get('warehouse', [InventoryController::class,  'warehouse_index'])->name('sica.admin.inventory.warehouse.index'); // Lista de bodegas disponibles (Administrador)
            Route::get('warehouse/create', [InventoryController::class,  'warehouse_create'])->name('sica.admin.inventory.warehouse.create'); // Formulario de registro de bodega (Administrador)
            Route::post('warehouse/store', [InventoryController::class,  'warehouse_store'])->name('sica.admin.inventory.warehouse.store'); // Registrar bodega (Administrador)
            Route::get('warehouse/edit/{warehouse}', [InventoryController::class,  'warehouse_edit'])->name('sica.admin.inventory.warehouse.edit'); // Ver bodega a  actualizar (Administrador)
            Route::post('warehouse/update/{warehouse}', [InventoryController::class,  'warehouse_update'])->name('sica.admin.inventory.warehouse.update'); // Actualizar bodega (Administrador)
            Route::get('warehouse/destroy/{warehouse}', [InventoryController::class,  'warehouse_destroy'])->name('sica.admin.inventory.warehouse.destroy'); // Eliminar bodega (Administrador)
            Route::get('warehouse/delete/{id}', [InventoryController::class, 'warehouse_delete'])->name('sica.admin.inventory.warehouse.delete'); // Formulario de eliminacion de bodega (Administrador)
            Route::post('warehouse/destroy/', [InventoryController::class, 'warehouse_destroy'])->name('sica.admin.inventory.warehouse.destroy'); // Eliminar bodega (Administrador)

            // --------------  Rutas de Elementos ---------------------------------
            Route::get('elements', [InventoryController::class,  'elements'])->name('sica.admin.inventory.elements'); // Lista de bodegas
            Route::get('elements/create', [InventoryController::class, 'createElement'])->name('sica.admin.inventory.elements.create');
            Route::get('/elements/edit/{element}', [InventoryController::class, 'editElement'])->name('sica.admin.inventory.elements.edit');
            Route::get('/elements/show/{element}', [InventoryController::class, 'showElement'])->name('sica.admin.inventory.elements.show');
            Route::post('/elements/store', [InventoryController::class, 'storeElement'])->name('sica.admin.inventory.elements.store');
            Route::get('/elements/delete/{id}', [InventoryController::class, 'deleteElement'])->name('sica.admin.inventory.elements.delete');
            Route::post('/elements/delete/', [InventoryController::class, 'destroyElement'])->name('sica.admin.inventory.elements.destroy');



            // --------------  Rutas de Transacciones ---------------------------------
            Route::get('transactions', [InventoryController::class,  'transactions'])->name('sica.admin.inventory.transactions'); // Lista de transacciones

            // --------------  Rutas de Inventario ---------------------------------
            Route::get('inventory', [InventoryController::class,  'inventory'])->name('sica.admin.inventory.inventory'); // Lista de inventario
            Route::post('inventory/filter', [InventoryController::class,  'inventory_filter'])->name('sica.admin.inventory.inventories.filter'); // Lista de inventario
        });


    });
});


