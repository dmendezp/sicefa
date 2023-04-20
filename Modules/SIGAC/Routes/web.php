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

Route::prefix('sigac')->group(function() {  // agrega el prefijo en la url (sicefa.test/ptventa/...)

    // Rutas generales para el modulo PTVENTA
    Route::controller(SIGACController::class)->group(function(){ // Agregar por única vez el controlodaar para posteriormente solo definir rutas con el formato (url, método_controlador)->name(nombre_de_ruta)
        Route::get('index', 'index')->name('cefa.sigac.index'); // Vista principal y pública de la aplicación.
    });

    // Rutas para ....
    //Route::prefix('element')->controller(...Controller::class)->group(function(){
        //Route::get('ruta en el navegador', 'metódo del controlador')->name('sigac.element. ...'); // Descripción de la ruta (debes tener en encuenta registrar el permiso en los seeders y sincronizarlos con el rol desde lo seeders)
    //});

});
