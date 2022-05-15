<?php
use Illuminate\Support\Facades\Route;
use Modules\SICA\Http\Controllers\inventory\InventoryController;

Route::middleware(['lang'])->group(function(){

    Route::prefix('sica')->group(function() {

        Route::get('/admin/inventory/warehouses', [InventoryController::class, 'warehouses'])->name('sica.admin.inventory.warehouses');

        Route::get('/admin/inventory/elements', [InventoryController::class, 'elements'])->name('sica.admin.inventory.elements');

        Route::get('/admin/inventory/transactions', [InventoryController::class, 'transactions'])->name('sica.admin.inventory.transactions');

        Route::get('/admin/inventory/inventory', [InventoryController::class, 'inventory'])->name('sica.admin.inventory.inventory');   
             
    });  

}); 