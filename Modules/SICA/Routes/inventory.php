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
            //  Listar
            Route::get('index', [ParameterController::class, 'index'])->name('sica.admin.inventory.parameters.index'); // Vista de tablas de parámetros

            // Agregar
            Route::get('/category/add', [ParameterController::class, 'addCategoryGet'])->name('sica.admin.inventory.parameters.category.add'); //Solicitud GET que tenga esta URL se manejará a través de esta ruta.
            Route::post('/category/add', [ParameterController::class, 'addCategoryPost'])->name('sica.admin.inventory.parameters.category.add');

            // Agregar de measurementUnit
            Route::get('/measurementUnit/add', [ParameterController::class, 'addmeasurementUnitGet'])->name('sica.admin.inventory.parameters.measurementUnit.add'); //Solicitud GET que tenga esta URL se manejará a través de esta ruta.
            Route::post('/measurementUnit/add', [ParameterController::class, 'addmeasurementUnitPost'])->name('sica.admin.inventory.parameters.measurementUnit.add');

            // Editar
            Route::get('/category/edit/{id}', [ParameterController::class, 'editCategoryGet'])->name('sica.admin.inventory.parameters.category.edit');
            Route::post('/category/edit', [ParameterController::class, 'editCategoryPost'])->name('sica.admin.inventory.parameters.category.edit');

            // Editar de measurementUnit
            Route::get('/measurementUnit/edit/{id}', [ParameterController::class, 'editmeasurementUnitGet'])->name('sica.admin.inventory.parameters.measurementUnit.edit');
            Route::post('/measurementUnit/edit', [ParameterController::class, 'editmeasurementUnitPost'])->name('sica.admin.inventory.parameters.measurementUnit.edit');

            // Eliminar
            Route::get('/category/delete/{id}', [ParameterController::class, 'deleteCategoryGet'])->name('sica.admin.inventory.parameters.category.delete');
            Route::post('/category/delete/', [ParameterController::class, 'deleteCategoryPost'])->name('sica.admin.inventory.parameters.category.delete');
            
            // Eliminar de measurementUnit
            Route::get('/measurementUnit/delete/{id}', [ParameterController::class, 'deletemeasurementUnitGet'])->name('sica.admin.inventory.parameters.measurementUnit.delete');
            Route::post('/measurementUnit/delete/', [ParameterController::class, 'deletemeasurementUnitPost'])->name('sica.admin.inventory.parameters.measurementUnit.delete');
            // --------------  Rutas de Categorías ---------------------------------
            /* Route::prefix('category')->group(function () {
                //Route::get('create', [ParameterController::class, 'create'])->name('sica.admin.inventory.parameters.category.create'); // Formulario de registro de categoría
                // ...
            }); */

            // Listar de measurementUnit
            Route::get('index', [ParameterController::class, 'index'])->name('sica.admin.inventory.parameters.index'); // Vista de tablas de parámetros

            //-------------------------Rutas de Tipo de Compra----------------------//
            //Agregar
            Route::get('/kindOfPurchase/add', [ParameterController::class, 'addKindOfPurchaseGet'])->name('sica.admin.inventory.parameters.kindOfPurchase.add'); 
            Route::post('/kindOfPurchase/add', [ParameterController::class, 'addKindOfPurchasePost'])->name('sica.admin.inventory.parameters.kindOfPurchase.add');

            //Editar
            Route::get('/kindOfPurchase/edit/{id}', [ParameterController::class, 'editKindOfPurchaseGet'])->name('sica.admin.inventory.parameters.kindOfPurchase.edit');
            Route::post('/kindOfPurchase/edit', [ParameterController::class, 'editKindOfPurchasePost'])->name('sica.admin.inventory.parameters.kindOfPurchase.edit');

            //Eliminar
            Route::get('/kindOfPurchase/delete/{id}', [ParameterController::class, 'deleteKindOfPurchaseGet'])->name('sica.admin.inventory.parameters.kindOfPurchase.delete');
            Route::post('/kindOfPurchase/delete/', [ParameterController::class, 'deleteKindOfPurchasePost'])->name('sica.admin.inventory.parameters.kindOfPurchase.delete');

            
        });
    });
});
