<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['lang'])->group(function(){ //Middleware que permite la internacionalizacion

    Route::prefix('sigac')->group(function() {  // agrega el prefijo en la url (sicefa.test/sigac/...)
    
        // Rutas generales para el modulo SIGAC
        Route::controller(SIGACController::class)->group(function(){ // Agregar por única vez el controlodaar para posteriormente solo definir rutas con el formato (url, método_controlador)->name(nombre_de_ruta)
            Route::get('index', 'index')->name('cefa.sigac.index'); // Vista principal y pública de la aplicación.
            Route::get('information', 'info')->name('cefa.sigac.info'); // Vista mas info sobre SIGAC y pública de la aplicación (Pública)
            Route::get('developers', 'devs')->name('cefa.sigac.devs'); // Vista sobre desarrolladores y creditos sobre SIGAC y pública de la aplicación (Pública)
            Route::get('academic', 'academic_coordination_dashboard')->name('sigac.academic_coordination.dashboard'); // Panel de control de coordinación académica (Coordinación Académica)
            Route::get('instructors', 'instructor_dashboards')->name('sigac.instructor.dashboards'); // Panel de control del instructor (Instructor)
            Route::get('wellness', 'wellness_dashboard')->name('sigac.wellness.dashboard'); // Panel de control de bienestar (Bienestar)
            Route::get('apprentice', 'apprentice_dashboard')->name('sigac.apprentice.dashboard'); // Panel de control de aprendiz (Aprendiz)
        });
        
        // Rutas para la programacion de eventos y horarios
        Route::controller(ProgrammeController::class)->group(function(){
            Route::get('coordination/program', 'programming_schedules')->name('sigac.academic_coordination.programming_schedules.index'); // Programación de horarios (Coordinación Académica)
            Route::get('coordination/events', 'event_programming')->name('sigac.academic_coordination.event_programming.index'); // Programación de eventos (Coordinación Académica)
        });

        // Rutas para la visualiación de horarios
        Route::controller(ScheduleController::class)->group(function(){
            Route::get('instructor/schedule', 'schedule_instructor')->name('sigac.instructor.schedule_instructor.index'); // Visualización de horario asignado a instructor (Instructor)
            Route::get('instructor/titled', 'schedule_titled')->name('sigac.instructor.schedule_titled.index'); // Visualización de horario asignado a titulada (Instructor)
            Route::get('apprentice/schedule', 'schedule_apprentice')->name('sigac.apprentice.schedule_apprentice.index'); // Visualización de horario asignado al aprendiz (Aprendiz)
        });

        // Rutas para la administración de asistencias
        Route::controller(AttendanceController::class)->group(function(){
            Route::get('instructor/consult/excuses', 'consult_excuses')->name('sigac.instructor.attendance.excuses'); // Consultar excusas de aprendiz (Instructor)
            Route::get('instructor/consult/attendance', 'consult_attendance')->name('sigac.instructor.attendance.consult'); // Consultar asistencia por aprendiz o tituladas (Instructor)
            Route::get('instructor/register', 'index')->name('sigac.instructor.attendance.register'); // Registrar asistencia de aprendiz por titulada (Instructor)
            Route::get('wellness/consult/attendance', 'consult_attendance')->name('sigac.wellness.attendance.consult'); // Consultar asistencia por aprendiz o tituladas (Bienestar)
            Route::get('coordination/reports/attendance', 'reports_attendance')->name('sigac.academic_coordination.reports.attendance.index'); // Vista principal de la sección de reportes de asistencia (Coordinación Académica) 
            Route::get('instructor/reports/attendance', 'reports_attendance')->name('sigac.instructor.reports.attendance.index'); // Vista principal de la sección de reportes de asistencia (Instructor) 
            Route::get('wellness/reports/attendance', 'reports_attendance')->name('sigac.wellness.reports.attendance.index'); // Vista principal de la sección de reportes de asistencia (Bienestar) 
        });

        // Rutas para la administración de funcionalidades de aprendiz
        Route::controller(ApprenticeController::class)->group(function(){
            Route::get('apprentice/excuses', 'send_excuses')->name('sigac.apprentice.excuses.send'); // Enviar excusa para justificación de inasistencia (Aprendiz)
        });
    });
});

