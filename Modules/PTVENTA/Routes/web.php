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
        Route::get('sales', 'indexSales')->name('cefa.ptventa.indexSales'); // Vista principal y pública de la aplicación.
        Route::get('products', 'indexProducts')->name('cefa.ptventa.indexProducts'); // Vista principal y pública de la aplicación.
    });

    // Rutas para elementos
    Route::prefix('images')->controller(ElementController::class)->group(function(){ 
        Route::get('index', 'index')->name('ptventa.admin.element.index'); // Vista principal de elementos para administrar imagenes
        Route::get('/edit/{element}', 'edit')->name('ptventa.admin.element.edit');
        Route::post('/update/{element}', 'update')->name('ptventa.admin.element.update');
    });

});
