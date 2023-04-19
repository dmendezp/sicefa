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

Route::prefix('ptventa')->group(function() {  // agrega el prefijo en la url (sicefa.test/ptventa/...)

    // Rutas generales para el modulo PTVENTA
    Route::controller(PTVENTAController::class)->group(function(){ // Agregar por única vez el controlodaar para posteriormente solo definir rutas con el formato (url, método_controlador)->name(nombre_de_ruta)
        Route::get('index', 'index')->name('cefa.ptventa.index'); // Vista principal y pública de la aplicación.
        Route::get('sales', 'indexSales')->name('cefa.ptventa.indexSales'); // Vista principal de ventas y pública de la aplicación.
        Route::get('products', 'indexProducts')->name('cefa.ptventa.indexProducts'); // Vista principal de productos y pública de la aplicación.
        Route::get('inventory', 'indexInventory')->name('cefa.ptventa.indexInventory');
    });

    // Rutas para elementos
    Route::prefix('images')->controller(ElementController::class)->group(function(){
        Route::get('gallery', 'gallery')->name('ptventa.admin.element.gallery'); // Vista temporal para el desarrollo de la galería de imágenes
        Route::get('index', 'index')->name('ptventa.admin.element.index'); // Vista principal de elementos para administrar imagenes
        Route::get('/edit/{element}', 'edit')->name('ptventa.admin.element.edit');
        Route::post('/update/{element}', 'update')->name('ptventa.admin.element.update');
        Route::post('crop-image-upload-ajax', 'cropImageUploadAjax');
    });
    
    //Rutas para Inventory
    Route::prefix('inventory')->controller(InventoryController::class)->group(function(){
        Route::get('inventory', 'create')->name('ptventa.admin.inventory.create'); // Vista para agrgar producto
        
    });


});
