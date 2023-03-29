<?php
use Illuminate\Support\Facades\Route;
use Modules\GANADERIA\Http\Controllers\inventory\InventoryController;

Route::middleware(['lang'])->group(function(){

    Route::prefix('ganaderia')->group(function() {

        Route::get('/admin/inventory/warehouses', [InventoryController::class, 'warehouses'])->name('ganaderia.admin.inventory.warehouses');

        Route::get('/admin/inventory/elements', [InventoryController::class, 'elements'])->name('ganaderia.admin.inventory.elements');

        Route::get('/admin/inventory/transactions', [InventoryController::class, 'transactions'])->name('ganaderia.admin.inventory.transactions');

        Route::get('/admin/inventory/inventory', [InventoryController::class, 'inventory'])->name('ganaderia.admin.inventory.inventory');   
          
    });  

}); 