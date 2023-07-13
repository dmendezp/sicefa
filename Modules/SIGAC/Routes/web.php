<?php

use Illuminate\Support\Facades\Route;
use Modules\SIGAC\Http\Controllers\AttendanceController;

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

Route::middleware(['lang'])->group(function(){ //Middleware que permite la internacionalizacion

    Route::prefix('sigac')->group(function() {  // agrega el prefijo en la url (sicefa.test/ptventa/...)
    
        // Rutas generales para el modulo SIGAC
        Route::controller(SIGACController::class)->group(function(){ // Agregar por única vez el controlodaar para posteriormente solo definir rutas con el formato (url, método_controlador)->name(nombre_de_ruta)
            Route::get('index', 'index')->name('cefa.sigac.index'); // Vista principal y pública de la aplicación.
        });
        
        Route::prefix('attendance')->group(function(){
            Route::get('/register', [AttendanceController::class, 'index'])->name('cefa.sigac.attendance.register'); // Vista principal.
            Route::get('/consult', [AttendanceController::class, 'consultAttendance'])->name('cefa.sigac.attendance.consult'); // Vista principal.
        });
    
        // Rutas para ....
        //Route::prefix('\Coloca el nombre del grupo\')->group(function(){
            //Route::get('ruta en el navegador', 'metódo del controlador')->name('sigac.element. ...'); // Descripción de la ruta (debes tener en encuenta registrar el permiso en los seeders y sincronizarlos con el rol desde lo seeders)
        //});
    
    });

});

