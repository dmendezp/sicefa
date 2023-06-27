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
        });

        // --------------  Rutas de Parámetros ---------------------------------
        Route::prefix('inventory/parameters')->group(function () {
            //  Listar
            Route::get('index', [ParameterController::class, 'index'])->name('sica.admin.inventory.parameters.index'); // Vista de tablas de parámetros
            //-------------------------Rutas de Categorias----------------------//
            // Agregar
            Route::get('/category/create', [ParameterController::class, 'createCategory'])->name('sica.admin.inventory.parameters.category.create'); //Solicitud GET que tenga esta URL se manejará a través de esta ruta.
            Route::post('/category/store', [ParameterController::class, 'storeCategory'])->name('sica.admin.inventory.parameters.category.store');

            // Editar
            Route::get('/category/edit/{id}', [ParameterController::class, 'editCategory'])->name('sica.admin.inventory.parameters.category.edit');
            Route::post('/category/edit', [ParameterController::class, 'updateCategory'])->name('sica.admin.inventory.parameters.category.update');
        
            // Eliminar
            Route::get('/category/delete/{id}', [ParameterController::class, 'deleteCategory'])->name('sica.admin.inventory.parameters.category.delete');
            Route::post('/category/delete/', [ParameterController::class, 'destroyCategory'])->name('sica.admin.inventory.parameters.category.destroy');

            //-------------------------Rutas de Unidades de Medida----------------------//
            // Agregar de measurementUnit
            Route::get('/measurementUnit/create', [ParameterController::class, 'createMeasurementUnit'])->name('sica.admin.inventory.parameters.measurementUnit.create'); //Solicitud GET que tenga esta URL se manejará a través de esta ruta.
            Route::post('/measurementUnit/store', [ParameterController::class, 'storeMeasurementUnit'])->name('sica.admin.inventory.parameters.measurementUnit.store');

            // Editar de measurementUnit
            Route::get('/measurementUnit/edit/{id}', [ParameterController::class, 'editMeasurementUnit'])->name('sica.admin.inventory.parameters.measurementUnit.edit');
            Route::post('/measurementUnit/edit', [ParameterController::class, 'updateMeasurementUnit'])->name('sica.admin.inventory.parameters.measurementUnit.update');
            
            // Eliminar de measurementUnit
            Route::get('/measurementUnit/delete/{id}', [ParameterController::class, 'deletemeasurementUnit'])->name('sica.admin.inventory.parameters.measurementUnit.delete');
            Route::post('/measurementUnit/delete/', [ParameterController::class, 'destroymeasurementUnit'])->name('sica.admin.inventory.parameters.measurementUnit.destroy');

            //-------------------------Rutas de Tipo de Compra----------------------//
            //Agregar
            Route::get('/kindOfPurchase/create', [ParameterController::class, 'createKindOfPurchase'])->name('sica.admin.inventory.parameters.kindOfPurchase.create'); 
            Route::post('/kindOfPurchase/add', [ParameterController::class, 'storeKindOfPurchase'])->name('sica.admin.inventory.parameters.kindOfPurchase.store');

            //Editar
            Route::get('/kindOfPurchase/edit/{id}', [ParameterController::class, 'editKindOfPurchase'])->name('sica.admin.inventory.parameters.kindOfPurchase.edit');
            Route::post('/kindOfPurchase/edit', [ParameterController::class, 'updateKindOfPurchase'])->name('sica.admin.inventory.parameters.kindOfPurchase.update');

            //Eliminar
            Route::get('/kindOfPurchase/delete/{id}', [ParameterController::class, 'deleteKindOfPurchase'])->name('sica.admin.inventory.parameters.kindOfPurchase.delete');
            Route::post('/kindOfPurchase/delete/', [ParameterController::class, 'destroyKindOfPurchase'])->name('sica.admin.inventory.parameters.kindOfPurchase.destroy');

        });
    });
});


