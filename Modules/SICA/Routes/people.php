<?php
use Illuminate\Support\Facades\Route;
use Modules\SICA\Http\Controllers\people\PeopleController;
use Modules\SICA\Http\Controllers\people\BasicDataController;
use Modules\SICA\Http\Controllers\people\ConfigController;
use Modules\SICA\Http\Controllers\people\ApprenticeController;
use Modules\SICA\Http\Controllers\people\InstructorController;
use Modules\SICA\Http\Controllers\people\AttendanceController;
use Modules\SICA\Http\Controllers\people\ContractorController;
use Modules\SICA\Http\Controllers\people\EmployeeController;
use Modules\SICA\Http\Controllers\people\TempTablesController;
use Modules\SICA\Http\Controllers\SICAController;

Route::middleware(['lang'])->group(function(){

    Route::prefix('sica')->group(function() {

        // --------------  Rutas de Configuración ---------------------------------
        Route::get('admin/people/config', [ConfigController::class, 'config_index'])->name('sica.admin.people.config.index'); // Vista principal de parámetros para datos de personas (Administrador)
        Route::get('academic_coordinator/people/config', [ConfigController::class, 'config_index'])->name('sica.academic_coordinator.people.config.index'); // Vista principal de parámetros para datos de personas (Coordinador académico)
        // Rutas de EPS
        Route::get('admin/people/config/eps/create', [ConfigController::class, 'eps_create'])->name('sica.admin.people.config.eps.create'); // Formulario de registro de EPS (Administrador)
        Route::get('academic_coordinator/people/config/eps/create', [ConfigController::class, 'eps_create'])->name('sica.academic_coordinator.people.config.eps.create'); // Formulario de registro de EPS (Coordinador académico)
        Route::post('admin/people/config/eps/store', [ConfigController::class, 'eps_store'])->name('sica.admin.people.config.eps.store'); // Registrar EPS (Administrador)
        Route::post('academic_coordinator/people/config/eps/store', [ConfigController::class, 'eps_store'])->name('sica.academic_coordinator.people.config.eps.store'); // Registrar EPS (Coordinador académico)
        Route::get('admin/people/config/eps/edit/{id}', [ConfigController::class, 'eps_edit'])->name('sica.admin.people.config.eps.edit'); // Formulario de actualización de EPS (Administrador)
        Route::get('academic_coordinator/people/config/eps/edit/{id}', [ConfigController::class, 'eps_edit'])->name('sica.academic_coordinator.people.config.eps.edit'); // Formulario de actualización de EPS (Coordinador académico)
        Route::post('admin/people/config/eps/update', [ConfigController::class, 'eps_update'])->name('sica.admin.people.config.eps.update'); // Actualizar EPS (Administrador)
        Route::post('academic_coordinator/people/config/eps/update', [ConfigController::class, 'eps_update'])->name('sica.academic_coordinator.people.config.eps.update'); // Actualizar EPS (Coordinador académico)
        Route::get('admin/people/config/eps/delete/{id}', [ConfigController::class, 'eps_delete'])->name('sica.admin.people.config.eps.delete'); // Formulario de eliminación de EPS (Administrador)
        Route::get('academic_coordinator/people/config/eps/delete/{id}', [ConfigController::class, 'eps_delete'])->name('sica.academic_coordinator.people.config.eps.delete'); // Formulario de eliminación de EPS (Coordinador académico)
        Route::post('admin/people/config/eps/destroy', [ConfigController::class, 'epd_destroy'])->name('sica.admin.people.config.eps.destroy'); // Eliminar EPS (Administrador)
        Route::post('academic_coordinator/people/config/eps/destroy', [ConfigController::class, 'epd_destroy'])->name('sica.academic_coordinator.people.config.eps.destroy'); // Eliminar EPS (Coordinador académico)
        // Rutas de Grupo Poblacionales
        Route::get('admin/people/config/population/create', [ConfigController::class, 'population_groups_create'])->name('sica.admin.people.config.population.create'); // Formulario de registro de grupo poblacional (Administrador)
        Route::get('academic_coordinator/people/config/population/create', [ConfigController::class, 'population_groups_create'])->name('sica.academic_coordinator.people.config.population.create'); // Formulario de registro de grupo poblacional (Coordinador académico)
        Route::post('admin/people/config/population/store', [ConfigController::class, 'population_groups_store'])->name('sica.admin.people.config.population.store'); // Registrar grupo poblacional (Administrador)
        Route::post('academic_coordinator/people/config/population/store', [ConfigController::class, 'population_groups_store'])->name('sica.academic_coordinator.people.config.population.store'); // Registrar grupo poblacional (Coordinador académico)
        Route::get('admin/people/config/population/edit/{id}', [ConfigController::class, 'population_groups_edit'])->name('sica.admin.people.config.population.edit'); // Formulario de actualización de grupo poblacional (Administrador)
        Route::get('academic_coordinator/people/config/population/edit/{id}', [ConfigController::class, 'population_groups_edit'])->name('sica.academic_coordinator.people.config.population.edit'); // Formulario de actualización de grupo poblacional (Coordinador académico)
        Route::post('admin/people/config/population/update', [ConfigController::class, 'population_groups_update'])->name('sica.admin.people.config.population.update'); // Actualizar grupo poblacional (Administrador)
        Route::post('academic_coordinator/people/config/population/update', [ConfigController::class, 'population_groups_update'])->name('sica.academic_coordinator.people.config.population.update'); // Actualizar grupo poblacional (Coordinador académico)
        Route::get('admin/people/config/population/delete/{id}', [ConfigController::class, 'population_groups_delete'])->name('sica.admin.people.config.population.delete'); // Formulario para eliminar grupo poblacional (Administrador)
        Route::get('academic_coordinator/people/config/population/delete/{id}', [ConfigController::class, 'population_groups_delete'])->name('sica.academic_coordinator.people.config.population.delete'); // Formulario para eliminar grupo poblacional (Coordinador académico)
        Route::post('admin/people/config/population/destroy', [ConfigController::class, 'population_groups_destroy'])->name('sica.admin.people.config.population.destroy'); // Eliminar grupo poblacional (Administrador)
        Route::post('academic_coordinator/people/config/population/destroy', [ConfigController::class, 'population_groups_destroy'])->name('sica.academic_coordinator.people.config.population.destroy'); // Eliminar grupo poblacional (Coordinador académico)
        // Rutas de Eventos
        Route::get('admin/people/config/event/add', [ConfigController::class, 'events_create'])->name('sica.admin.people.config.events.create'); // Formulario de registro de evento (Administrador)
        Route::get('academic_coordinator/people/config/event/add', [ConfigController::class, 'events_create'])->name('sica.academic_coordinator.people.config.events.create'); // Formulario de registro de evento (Coordinador académico)
        Route::post('admin/people/config/event/store', [ConfigController::class, 'events_store'])->name('sica.admin.people.config.events.store'); // Registrar evento (Administrador)
        Route::post('academic_coordinator/people/config/event/store', [ConfigController::class, 'events_store'])->name('sica.academic_coordinator.people.config.events.store'); // Registrar evento (Coordinador académico)
        Route::get('admin/people/config/event/edit/{id}', [ConfigController::class, 'events_edit'])->name('sica.admin.people.config.events.edit'); // Formulario de actualización de evento (Administrador)
        Route::get('academic_coordinator/people/config/event/edit/{id}', [ConfigController::class, 'events_edit'])->name('sica.academic_coordinator.people.config.events.edit'); // Formulario de actualización de evento (Coordinador académico)
        Route::post('admin/people/config/event/update', [ConfigController::class, 'events_update'])->name('sica.admin.people.config.events.update'); // Actualizar evento (Administrador)
        Route::post('academic_coordinator/people/config/event/update', [ConfigController::class, 'events_update'])->name('sica.academic_coordinator.people.config.events.update'); // Actualizar evento (Coordinador académico)
        Route::get('admin/people/config/event/delete/{id}', [ConfigController::class, 'events_delete'])->name('sica.admin.people.config.events.delete'); // Formulario para eliminar evento (Administrador)
        Route::get('academic_coordinator/people/config/event/delete/{id}', [ConfigController::class, 'events_delete'])->name('sica.academic_coordinator.people.config.events.delete'); // Formulario para eliminar evento (Coordinador académico)
        Route::post('admin/people/config/event/destroy', [ConfigController::class, 'events_destroy'])->name('sica.admin.people.config.events.destroy'); // Eliminar evento (Administrador)
        Route::post('academic_coordinator/people/config/event/destroy', [ConfigController::class, 'events_destroy'])->name('sica.academic_coordinator.people.config.events.destroy'); // Eliminar evento (Coordinador académico)

        // --------------  Rutas de Datos Personales ---------------------------------
        Route::get('admin/people/personal_data', [PeopleController::class, 'personal_data_index'])->name('sica.admin.people.personal_data.index'); // Vista principal de datos personales (Administrador)
        Route::get('academic_coordinator/people/personal_data', [PeopleController::class, 'personal_data_index'])->name('sica.academic_coordinator.people.personal_data.index'); // Vista principal de datos personales (Coordinador académico)
        Route::post('admin/people/personal_data/search', [PeopleController::class, 'personal_data_search'])->name('sica.admin.people.personal_data.search'); // Buscar datos personales por número de documento (Administrador)
        Route::post('academic_coordinator/people/personal_data/search', [PeopleController::class, 'personal_data_search'])->name('sica.academic_coordinator.people.personal_data.search'); // Buscar datos personales por número de documento (Coordinador académico)
        Route::get('admin/people/personal_data/create/{doc}', [PeopleController::class, 'personal_data_create'])->name('sica.admin.people.personal_data.create'); // Formulario de registro de datos personales (Administrador)
        Route::get('academic_coordinator/people/personal_data/create/{doc}', [PeopleController::class, 'personal_data_create'])->name('sica.academic_coordinator.people.personal_data.create'); // Formulario de registro de datos personales (Coordinador académico)
        Route::post('admin/people/personal_data/store', [PeopleController::class, 'personal_data_store'])->name('sica.admin.people.personal_data.store'); // Registrar datos personales (Administrador)
        Route::post('academic_coordinator/people/personal_data/store', [PeopleController::class, 'personal_data_store'])->name('sica.academic_coordinator.people.personal_data.store'); // Registrar datos personales (Coordinador académico)
        Route::get('admin/people/personal_data/{person}/edit', [PeopleController::class, 'personal_data_edit'])->name('sica.admin.people.personal_data.edit'); // Formulario de actualización de datos personales (Administrador)
        Route::get('academic_coordinator/people/personal_data/{person}/edit', [PeopleController::class, 'personal_data_edit'])->name('sica.academic_coordinator.people.personal_data.edit'); // Formulario de actualización de datos personales (Coordinador académico)
        Route::put('admin/people/personal_data/{person}/update', [PeopleController::class, 'personal_data_update'])->name('sica.admin.people.personal_data.update'); // Actualizar datos personales (Administrador)
        Route::put('academic_coordinator/people/personal_data/{person}/update', [PeopleController::class, 'personal_data_update'])->name('sica.academic_coordinator.people.personal_data.update'); // Actualizar datos personales (Coordinador académico)
        Route::get('admin/people/personal_data/load_create',[TempTablesController::class, 'personal_data_load_create'])->name('sica.admin.people.personal_data.load.create'); // Formulario para carga de archivo con datos personales de personas (Administrador)
        Route::get('academic_coordinator/people/personal_data/load_create',[TempTablesController::class, 'personal_data_load_create'])->name('sica.academic_coordinator.people.personal_data.load.create'); // Formulario para carga de archivo con datos personales de personas (Coordinador académico)
        Route::post('admin/people/personal_data/load_store',[TempTablesController::class, 'personal_data_load_store'])->name('sica.admin.people.personal_data.load.store'); // Registro de datos personales a partir de un archivo (Administrador)
        Route::post('academic_coordinator/people/personal_data/load_store',[TempTablesController::class, 'personal_data_load_store'])->name('sica.academic_coordinator.people.personal_data.load.store'); // Registro de datos personales a partir de un archivo (academic_coordinator)

        // --------------  Rutas de Aprendices ---------------------------------
        Route::get('admin/people/apprentices', [ApprenticeController::class, 'index'])->name('sica.admin.people.apprentices.index'); // Vista principal para consultar aprendices por titulación (Administrador)
        Route::get('academic_coordinator/people/apprentices', [ApprenticeController::class, 'index'])->name('sica.academic_coordinator.people.apprentices.index'); // Vista principal para consultar aprendices por titulación (Coordinador académico)
        Route::post('admin/people/apprentices/search', [ApprenticeController::class, 'search'])->name('sica.admin.people.apprentices.search'); // Consultar aprendices por titulación (Administrador)
        Route::post('academic_coordinator/people/apprentices/search', [ApprenticeController::class, 'search'])->name('sica.academic_coordinator.people.apprentices.search'); // Consultar aprendices por titulación (Coordinador académico)
        Route::get('admin/people/apprentice/load_create',[TempTablesController::class, 'apprentices_load_create'])->name('sica.admin.people.apprentices.load.create'); // Formulario para carga de archivo con datos de aprendices (Administrador)
        Route::get('academic_coordinator/people/apprentice/load_create',[TempTablesController::class, 'apprentices_load_create'])->name('sica.academic_coordinator.people.apprentices.load.create'); // Formulario para carga de archivo con datos de aprendices (Coordiandor académico)
        Route::post('admin/people/apprentice/load_store',[TempTablesController::class, 'apprentices_load_store'])->name('sica.admin.people.apprentices.load.store'); // Registrar aprendices a partir de un archivo (Administrador)
        Route::post('academic_coordinator/people/apprentice/load_store',[TempTablesController::class, 'apprentices_load_store'])->name('sica.academic_coordinator.people.apprentices.load.store'); // Registrar aprendices a partir de un archivo (Coordinador académico)

        // --------------  Rutas de Instructores ---------------------------------
        Route::get('admin/people/instructors', [InstructorController::class, 'index'])->name('sica.admin.people.instructors.index'); // Vista principal de instructores (Administrador)
        Route::get('coordinator/people/instructors', [InstructorController::class, 'index'])->name('sica.academic_coordinator.people.instructors.index'); // Vista principal de instructores (Coordinador académico)

        // --------------  Rutas de Funcionarios ---------------------------------
        Route::get('admin/people/employees', [EmployeeController::class, 'index'])->name('sica.admin.people.employees.index'); // Vista principal de funcionarios (Administrador)
        Route::get('academic_coordinator/people/employees', [EmployeeController::class, 'index'])->name('sica.academic_coordinator.people.employees.index'); // Vista principal de funcionarios (Coordinador académico)
        Route::get('admin/employees/show/{employee}', [EmployeeController::class, 'showEmployee'])->name('sica.admin.people.employees.show'); // Detalles del funcionario (Administrador)

        // --------------  Rutas de Contratistas ---------------------------------
        Route::get('admin/people/contractors', [ContractorController::class, 'index'])->name('sica.admin.people.contractors.index'); // Vista pricipal de contratistas (Administrador)
        Route::get('academic_coordinator/people/contractors', [ContractorController::class, 'index'])->name('sica.academic_coordinator.people.contractors.index'); // Vista pricipal de contratistas (Coordinador académico)
        Route::get('admin/contractors/show/{contractor}', [ContractorController::class, 'showContractor'])->name('sica.admin.people.contractors.show'); // Detalles del contratista (Administrador)

        // --------------  Rutas de Asistencia a eventos ---------------------------------
        Route::get('admin/events_attendance_dashboard', [SICAController::class, 'attendance_dashboard'])->name('sica.admin.events_attendance_dashboard'); // Panel de control de asistencias a eventos (Administrador)
        Route::get('admin/people/events_attendance', [AttendanceController::class, 'index'])->name('sica.admin.people.events_attendance.index'); // Formulario de registro de asistencia a eventos (Administrador)
        Route::get('attendance/people/events_attendance', [AttendanceController::class, 'index'])->name('sica.attendance.people.events_attendance.index'); // Formulario de registro de asistencia a eventos (Asistencia)
        // Rutas de Datos Básicos para asistencia a eventos
        Route::get('admin/people/basic_data/search', [BasicDataController::class, 'search'])->name('sica.admin.people.basic_data.search'); // Buscar o registrar datos básicos de persona para registrar asistencia a evento (Administrador)
        Route::get('attendance/people/basic_data/search', [BasicDataController::class, 'search'])->name('sica.attendance.people.basic_data.search'); // Buscar o registrar datos básicos de persona para registrar asistencia a evento (Asistencia)
        Route::post('admin/people/basic_data/store', [BasicDataController::class, 'store'])->name('sica.admin.people.basic_data.store'); // Registrar datos básicos de personas y asistencia a evento (Administrador)
        Route::post('attendance/people/basic_data/store', [BasicDataController::class, 'store'])->name('sica.attendance.people.basic_data.store'); // Registrar datos básicos de personas y asistencia a evento (Asistencia)

    });

});
