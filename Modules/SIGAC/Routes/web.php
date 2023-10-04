<?php

use Illuminate\Support\Facades\Route;
use Modules\SIGAC\Http\Controllers\AttendanceController;
use Modules\SIGAC\Http\Controllers\InstructorController;
use Modules\SIGAC\Http\Controllers\ScheduleController;

Route::middleware(['lang'])->group(function(){ //Middleware que permite la internacionalizacion

    Route::prefix('sigac')->group(function() {  // agrega el prefijo en la url (sicefa.test/ptventa/...)
    
        // Rutas generales para el modulo SIGAC
        Route::controller(SIGACController::class)->group(function(){ // Agregar por única vez el controlodaar para posteriormente solo definir rutas con el formato (url, método_controlador)->name(nombre_de_ruta)
            Route::get('index', 'index')->name('cefa.sigac.index'); // Vista principal y pública de la aplicación.
            Route::get('information', 'info')->name('cefa.sigac.info'); // Vista mas info sobre SIGAC y pública de la aplicación (Pública)
            Route::get('academic', 'academic_coordination_dashboard')->name('sigac.academic_coordination.dashboard'); // Panel de control de coordinación académica (Coordinación Académica)
            Route::get('instructor', 'instructor_dashboard')->name('sigac.instructor.dashboard'); // Panel de control del instructor (Instructor)
            Route::get('wellness', 'wellness_dashboard')->name('sigac.wellness.dashboard'); // Panel de control de bienestar (Bienestar)
        });
        
        Route::prefix('instructor')->group(function(){
            Route::get('/index', [InstructorController::class, 'index'])->name('cefa.sigac.instructor.index'); // Vista principal.
        });

        Route::prefix('attendance')->group(function(){
            Route::get('/register', [AttendanceController::class, 'index'])->name('cefa.sigac.attendance.register'); // Vista principal.
            Route::get('/consult', [AttendanceController::class, 'consultAttendance'])->name('cefa.sigac.attendance.consult'); // Vista de consulta de asistencia.
        });

        Route::prefix('schedule')->group(function(){
            Route::get('/instructor', [ScheduleController::class, 'scheduleInstructor'])->name('cefa.sigac.scheduleInstructor.index'); // Vista principal.
            Route::get('/apprentice', [ScheduleController::class, 'scheduleApprentice'])->name('cefa.sigac.scheduleApprentice.index'); // Vista principal.
            Route::get('/program', [ScheduleController::class, 'scheduleProgramInstructor'])->name('cefa.sigac.scheduleProgramInstructor.index'); // Vista principal.
            Route::get('/environment', [ScheduleController::class, 'scheduleProgramEnvironment'])->name('cefa.sigac.scheduleProgramEnvironment.index'); // Vista principal.
        });

        Route::prefix('reports')->group(function(){
            Route::get('/index', [AttendanceController::class, 'reportsAttendance'])->name('cefa.sigac.attendanceReports.index'); // Vista principal.
        });
    
        // Rutas para ....
        //Route::prefix('\Coloca el nombre del grupo\')->group(function(){
            //Route::get('ruta en el navegador', 'metódo del controlador')->name('sigac.element. ...'); // Descripción de la ruta (debes tener en encuenta registrar el permiso en los seeders y sincronizarlos con el rol desde lo seeders)
        //});
    
    });

});

