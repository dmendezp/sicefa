<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['lang'])->group(function () { // Middleware para la internacionalización (manejo de idiomas) y verficación de permisos y roles
    Route::prefix('tilabs')->group(function() {  // Agrega el prefijo en la url (sicefa.test/tilabs/...)

        // Rutas generales para el modulo TILABS
        Route::controller(TILABSController::class)->group(function(){ // Agregar por única vez el controlodaar para posteriormente solo definir rutas con el formato (url, método_controlador)->name(nombre_de_ruta)
            Route::get('/index', 'index')->name('cefa.tilabs.index'); // Vista principal y pública de la aplicación (Pública)
            Route::get('/developers', 'developers')->name('cefa.tilabs.developers'); // Vista de creditos y desarrolladores, pública de la aplicación (Pública)
            Route::get('/about', 'about')->name('cefa.tilabs.about'); // Vista mas info sobre PTVENTA y pública de la aplicación (Pública)
            
            Route::get('/dashboard', 'dashboard')->name('tilabs.admin.dashboard');
            Route::get('/labs', 'labs')->name('tilabs.admin.labs');
            Route::get('/inventory', 'inventory')->name('tilabs.admin.inventory');
            Route::get('/loan', 'loan')->name('tilabs.admin.loan');
            Route::get('/return', 'return')->name('tilabs.admin.return');
            Route::get('/transactions', 'transactions')->name('tilabs.admin.transactions');
        });
    });
});
