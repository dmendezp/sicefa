<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['lang'])->group(function(){ // Middleware para la internzación (manejo de idiomas) y verficación de permisos y roles
    Route::prefix('sica')->group(function() { // Agrega el prefijo en la url (sicefa.test/ptventa/...)

        // Rutas generales del módulo SICA
        Route::controller(SICAController::class)->group(function(){ // Agregar por única vez el controlodaar para posteriormente solo definir rutas con el formato (url, método_controlador)->name(nombre_de_ruta)
            Route::get('index', 'index')->name('cefa.sica.home.index'); /* Página pricipal de la aplicación SICA (Pública) */
            Route::get('developers', 'developers')->name('cefa.sica.home.developers'); /* Página de información sobre desarrolladores (Pública) */
            Route::get('contact', 'contact')->name('cefa.sica.home.contact'); /* Página de contacto (Pública) */
            Route::get('admin', 'admin_dashboard')->name('sica.admin.dashboard'); /* Panel de control del administrador (Administrador) */
            Route::get('academic_coordinator', 'academic_coordinator_dashboard')->name('sica.academic_coordinator.dashboard'); /* Panel de control del coordinador académico (Coordinador acádemico) */
            Route::get('attendance', 'attendance_dashboard')->name('sica.attendance.dashboard'); /* Panel de control de asistencias a eventos (Asistencia) */
            Route::get('unitmanager', 'unitmanager_dashboard')->name('sica.unitmanager.dashboard'); /* Panel de control gestor de unidades (Gestor Unidades) */
        });

    });
});
