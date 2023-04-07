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

Route::prefix('cafeto')->group(function(){ //Agrega el prefijo en la url (sicefa.test/cafeto/...).
    Route::controller(CAFETOController::class)->group(function(){ //Agrega por única vez el controlador, para que seguidamente sea solo.
        Route::get('index', 'index')->name('cefa.cafeto.home.index'); 
        Route::get('productos', 'productos')->name('cefa.cafeto.home.productos');
        Route::get('inventario', 'inventario')->name('cefa.cafeto.home.inventario');
        Route::get('ventas', 'ventas')->name('cefa.cafeto.home.ventas'); //Vista principal y pública de la aplicación.
    });
});
