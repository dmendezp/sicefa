<?php
use Illuminate\Support\Facades\Route;
use Modules\SICA\Http\Controllers\academy\AcademyController;

Route::middleware(['lang'])->group(function(){

    Route::prefix('sica/')->group(function() {

        // --------------  Rutas de Días Festivos ---------------------------------
        Route::get('admin/academy/holidays', [AcademyController::class, 'holidays_index'])->name('sica.admin.academy.holidays.index'); // Listado de días festivos registrados (Administrador)
        Route::get('academic_coordinator/academy/holidays', [AcademyController::class, 'holidays_index'])->name('sica.academic_coordinator.academy.holidays.index'); // Listado de días festivos registrados (Coordinador académico)
        Route::post('admin/academy/holidays/store', [AcademyController::class, 'holidays_store'])->name('sica.admin.academy.holidays.store'); // Registrar día festivo (Administrador)
        Route::post('academic_coordinator/academy/holidays/store', [AcademyController::class, 'holidays_store'])->name('sica.academic_coordinator.academy.holidays.store'); // Registrar día festivo (Coordinador académico)
        Route::get('admin/academy/holidays/edit/{holiday}', [AcademyController::class, 'holidays_edit'])->name('sica.admin.academy.holidays.edit'); // Formulario para actualizar día festivo (Administrador)
        Route::get('academic_coordinator/academy/holidays/edit/{holiday}', [AcademyController::class, 'holidays_edit'])->name('sica.academic_coordinator.academy.holidays.edit'); // Formulario para actualizar día festivo (Coordinador académico)
        Route::post('admin/academy/holidays/update/{holiday}', [AcademyController::class, 'holidays_update'])->name('sica.admin.academy.holidays.update'); // Actualizar día festivo (Administrador)
        Route::post('academic_coordinator/academy/holidays/update/{holiday}', [AcademyController::class, 'holidays_update'])->name('sica.academic_coordinator.academy.holidays.update'); // Actualizar día festivo (Coordinador académico)
        Route::get('academic_coordinator/academy/holidays/delete/{id}', [AcademyController::class, 'holidays_delete'])->name('sica.academic_coordinator.academy.holidays.delete'); // Formulario de eliminacion del dia festivo (Coordinador académico)
        Route::post('academic_coordinator/academy/holidays/destroy', [AcademyController::class, 'holidays_destroy'])->name('sica.academic_coordinator.academy.holidays.destroy'); // Eliminar dia festivo (Coordinador académico)

        // --------------  Rutas de Trimestres ---------------------------------
        Route::get('admin/academy/quarters', [AcademyController::class, 'quarters_index'])->name('sica.admin.academy.quarters.index'); // Listado de trimestres registrados (Administrador)
        Route::get('academic_coordinator/academy/quarters', [AcademyController::class, 'quarters_index'])->name('sica.academic_coordinator.academy.quarters.index'); // Listado de trimestres registrados (Cooridnador académico)
        Route::get('admin/academy/quarters/create', [AcademyController::class, 'quarters_create'])->name('sica.admin.academy.quarters.create'); // Formulario de registro de trimestre (Administrador)
        Route::get('academic_coordinator/academy/quarters/create', [AcademyController::class, 'quarters_create'])->name('sica.academic_coordinator.academy.quarters.create'); // Formulario de registro de trimestre (Coordinador académico)
        Route::post('admin/academy/quarters/store', [AcademyController::class, 'quarters_store'])->name('sica.admin.academy.quarters.store'); // Registrar trimestre (Administrador)
        Route::post('academic_coordinator/academy/quarters/store', [AcademyController::class, 'quarters_store'])->name('sica.academic_coordinator.academy.quarters.store'); // Registrar trimestre (Coordinador académico)
        Route::get('admin/academy/quarters/edit/{quarter}', [AcademyController::class, 'quarters_edit'])->name('sica.admin.academy.quarters.edit'); // Formulario de actualización de trimestre (Administrador)
        Route::get('academic_coordinator/academy/quarters/edit/{quarter}', [AcademyController::class, 'quarters_edit'])->name('sica.academic_coordinator.academy.quarters.edit'); // Formulario de actualización de trimestre (Coordinador académico)
        Route::post('admin/academy/quarters/update/{quarter}', [AcademyController::class, 'quarters_update'])->name('sica.admin.academy.quarters.update'); // Actualizar trimestre (Administrador)
        Route::post('academic_coordinator/academy/quarters/update/{quarter}', [AcademyController::class, 'quarters_update'])->name('sica.academic_coordinator.academy.quarters.update'); // Actualizar trimestre (Coordinador académico)
        Route::get('academic_coordinator/academy/quarters/delete/{id}', [AcademyController::class, 'quarters_delete'])->name('sica.academic_coordinator.academy.quarters.delete'); // Formulario de eliminacion del trimestre (Coordinador académico)
        Route::get('admin/academy/quarters/delete/{id}', [AcademyController::class, 'quarters_delete'])->name('sica.admin.academy.quarters.delete'); // Formulario de eliminacion del trimestre (Coordinador académico)
        Route::post('academic_coordinator/academy/quarters/destroy', [AcademyController::class, 'quarters_destroy'])->name('sica.academic_coordinator.academy.quarters.destroy'); // Eliminar trimestre (Coordinador académico)
        Route::post('admin/academy/quarters/destroy', [AcademyController::class, 'quarters_destroy'])->name('sica.admin.academy.quarters.destroy'); // Eliminar trimestre (Coordinador académico)

        // ------------- Rutas de Programas de Formación ---------------------
        Route::get('admin/academy/programs', [AcademyController::class, 'programs_index'])->name('sica.admin.academy.programs.index'); // Listado de programas de formación registrados (Administrador)
        Route::get('academic_coordinator/academy/programs', [AcademyController::class, 'programs_index'])->name('sica.academic_coordinator.academy.programs.index'); // Listado de programas de formación registrados (Coordinador académico)
        Route::get('admin/academy/programs/create', [AcademyController::class, 'programs_create'])->name('sica.admin.academy.programs.create'); // Formulario de registro de programa de formación (Administrador)
        Route::get('academic_coordinator/academy/programs/create', [AcademyController::class, 'programs_create'])->name('sica.academic_coordinator.academy.programs.create'); // Formulario de registro de programa de formación (Coordinador académico)
        Route::post('admin/academy/programs/store', [AcademyController::class, 'programs_store'])->name('sica.admin.academy.programs.store'); // Registrar programa de formación (Administrador)
        Route::post('academic_coordinator/academy/programs/store', [AcademyController::class, 'programs_store'])->name('sica.academic_coordinator.academy.programs.store'); // Registrar programa de formación (Coordinador académico)
        Route::get('admin/academy/programs/edit/{id}', [AcademyController::class, 'programs_edit'])->name('sica.admin.academy.programs.edit'); // Formulario para de actualización de formación (Administrador)
        Route::get('academic_coordinator/academy/programs/edit/{id}', [AcademyController::class, 'programs_edit'])->name('sica.academic_coordinator.academy.programs.edit'); // Formulario para de actualización de formación (Coordinador académico)
        Route::post('admin/academy/programs/update/', [AcademyController::class, 'programs_update'])->name('sica.admin.academy.programs.update'); // Actualizar programa de formación (Administrador)
        Route::post('academic_coordinator/academy/programs/update/', [AcademyController::class, 'programs_update'])->name('sica.academic_coordinator.academy.programs.update'); // Actualizar programa de formación (Coordinador académico)
        Route::get('admin/academy/programs/delete/{id}', [AcademyController::class, 'programs_delete'])->name('sica.admin.academy.programs.delete'); // Formulario de eliminación de programa de formación (Administrador)
        Route::get('academic_coordinator/academy/programs/delete/{id}', [AcademyController::class, 'programs_delete'])->name('sica.academic_coordinator.academy.programs.delete'); // Formulario de eliminación de programa de formación (Coordinador académico)
        Route::post('admin/academy/programs/delete/', [AcademyController::class, 'programs_destroy'])->name('sica.admin.academy.programs.destroy'); // Eliminar programa de formación (Administrador)
        Route::post('academic_coordinator/academy/programs/delete/', [AcademyController::class, 'programs_destroy'])->name('sica.academic_coordinator.academy.programs.destroy'); // Eliminar programa de formación (Coordinador académico)

        // ------------- Rutas de Redes de conocimiento ----------------------
        Route::get('admin/academy/knowledge/networks', [AcademyController::class, 'knowledgenetworks_index'])->name('sica.admin.academy.knowledge.networks.index'); // Listado de redes de conocimiento registrados (Administrador)
        Route::get('academic_coordinator/academy/knowledge/networks', [AcademyController::class, 'knowledgenetworks_index'])->name('sica.academic_coordinator.academy.knowledge.networks.index'); // Listado de redes de conocimiento registrados (Coordinador académico)
        Route::get('admin/academy/knowledge/networks/create', [AcademyController::class, 'knowledgenetworks_create'])->name('sica.admin.academy.knowledge.networks.create'); // Formulario de registro de red de conocimiento (Administrador)
        Route::get('academic_coordinator/academy/knowledge/networks/create', [AcademyController::class, 'knowledgenetworks_create'])->name('sica.academic_coordinator.academy.knowledge.networks.create'); // Formulario de registro de red de conocimiento (Coordinador académico)
        Route::post('admin/academy/knowledge/networks/store', [AcademyController::class, 'knowledgenetworks_store'])->name('sica.admin.academy.knowledge.networks.store'); // Registrar red de conocimiento (Administrador)
        Route::post('academic_coordinator/academy/knowledge/networks/store', [AcademyController::class, 'knowledgenetworks_store'])->name('sica.academic_coordinator.academy.knowledge.networks.store'); // Registrar red de conocimiento (Coordinador académico)
        Route::get('admin/academy/knowledge/networks/edit/{id}', [AcademyController::class, 'knowledgenetworks_edit'])->name('sica.admin.academy.knowledge.networks.edit'); // Formulario de actualización de red de conocimiento (Administrador)
        Route::get('academic_coordinator/academy/knowledge/networks/edit/{id}', [AcademyController::class, 'knowledgenetworks_edit'])->name('sica.academic_coordinator.academy.knowledge.networks.edit'); // Formulario de actualización de red de conocimiento (Coordinador académico)
        Route::post('admin/academy/knowledge/networks/update/', [AcademyController::class, 'knowledgenetworks_update'])->name('sica.admin.academy.knowledge.networks.update'); // Actualizar red de conocimiento (Administrador)
        Route::post('academic_coordinator/academy/knowledge/networks/update/', [AcademyController::class, 'knowledgenetworks_update'])->name('sica.academic_coordinator.academy.knowledge.networks.update'); // Actualizar red de conocimiento (Coordinador académico)
        Route::get('admin/academy/knowledge/networks/delete/{id}', [AcademyController::class, 'knowledgenetworks_delete'])->name('sica.admin.academy.knowledge.networks.delete'); // Formulario de eliminación de red de conocimiento (Administrador)
        Route::get('academic_coordinator/academy/knowledge/networks/delete/{id}', [AcademyController::class, 'knowledgenetworks_delete'])->name('sica.academic_coordinator.academy.knowledge.networks.delete'); // Formulario de eliminación de red de conocimiento (Coordinador académico)
        Route::post('admin/academy/knowledge/networks/destroy/', [AcademyController::class, 'knowledgenetworks_destroy'])->name('sica.admin.academy.knowledge.networks.destroy'); // Eliminar red de conocimiento (Administrador)
        Route::post('academic_coordinator/academy/knowledge/networks/destroy/', [AcademyController::class, 'knowledgenetworks_destroy'])->name('sica.academic_coordinator.academy.knowledge.networks.destroy'); // Eliminar red de conocimiento (Coordinador académico)

        // ------------- Rutas de Redes tecnológicas ----------------------
        Route::get('admin/academy/networks', [AcademyController::class, 'networks_index'])->name('sica.admin.academy.networks.index'); // Listado de redes tecnológicas registrados (Administrador)
        Route::get('academic_coordinator/academy/networks', [AcademyController::class, 'networks_index'])->name('sica.academic_coordinator.academy.networks.index'); // Listado de redes tecnológicas registrados (Coordinador académico)
        Route::get('admin/academy/networks/create', [AcademyController::class, 'networks_create'])->name('sica.admin.academy.networks.create'); // Formulario de registro de red tecnológica (Administrador)
        Route::get('academic_coordinator/academy/networks/create', [AcademyController::class, 'networks_create'])->name('sica.academic_coordinator.academy.networks.create'); // Formulario de registro de red tecnológica (Coordinador académico)
        Route::post('admin/academy/networks/store', [AcademyController::class, 'networks_store'])->name('sica.admin.academy.networks.store'); // Registrar red tecnológica (Administrador)
        Route::post('academic_coordinator/academy/networks/store', [AcademyController::class, 'networks_store'])->name('sica.academic_coordinator.academy.networks.store'); // Registrar red tecnológica (Coordinador académico)
        Route::get('admin/academy/networks/edit/{id}', [AcademyController::class, 'networks_edit'])->name('sica.admin.academy.networks.edit'); // Formulario de actualización de red tecnológica (Administrador)
        Route::get('academic_coordinator/academy/networks/edit/{id}', [AcademyController::class, 'networks_edit'])->name('sica.academic_coordinator.academy.networks.edit'); // Formulario de actualización de red tecnológica (Coordinador académico)
        Route::post('admin/academy/networks/update/', [AcademyController::class, 'networks_update'])->name('sica.admin.academy.networks.update'); // Actualizar red tecnológica (Administrador)
        Route::post('academic_coordinator/academy/networks/update/', [AcademyController::class, 'networks_update'])->name('sica.academic_coordinator.academy.networks.update'); // Actualizar red tecnológica (Coordinador académico)
        Route::get('admin/academy/networks/delete/{id}', [AcademyController::class, 'networks_delete'])->name('sica.admin.academy.networks.delete'); // Formulario de eliminación de red tecnológica (Administrador)
        Route::get('academic_coordinator/academy/networks/delete/{id}', [AcademyController::class, 'networks_delete'])->name('sica.academic_coordinator.academy.networks.delete'); // Formulario de eliminación de red tecnológica (Coordinador académico)
        Route::post('admin/academy/networks/destroy/', [AcademyController::class, 'networks_destroy'])->name('sica.admin.academy.networks.destroy'); // Eliminar red tecnológica (Administrador)
        Route::post('academic_coordinator/academy/networks/destroy/', [AcademyController::class, 'networks_destroy'])->name('sica.academic_coordinator.academy.networks.destroy'); // Eliminar red tecnológica (Coordinador académico)

        // ------------Rutas de Líneas tecnologicas-----------
        Route::get('admin/academy/lines', [AcademyController::class, 'lines_index'])->name('sica.admin.academy.lines.index'); // Listado de líneas tecnológicas registradas (Administrador)
        Route::get('academic_coordinator/academy/lines', [AcademyController::class, 'lines_index'])->name('sica.academic_coordinator.academy.lines.index'); // Listado de líneas tecnológicas registradas (Coordinador académico)
        Route::get('admin/academy/lines/create', [AcademyController::class, 'lines_create'])->name('sica.admin.academy.lines.create'); // Formulario de registro de línea tecnológica (Administrador)
        Route::get('academic_coordinator/academy/lines/create', [AcademyController::class, 'lines_create'])->name('sica.academic_coordinator.academy.lines.create'); // Formulario de registro de línea tecnológica (Coordinador académico)
        Route::post('admin/academy/lines/store', [AcademyController::class, 'lines_store'])->name('sica.admin.academy.lines.store'); // Registrar línea tecnológica (Administrador)
        Route::post('academic_coordinator/academy/lines/store', [AcademyController::class, 'lines_store'])->name('sica.academic_coordinator.academy.lines.store'); // Registrar línea tecnológica (Coordinador académico)
        Route::get('admin/academy/lines/edit/{id}', [AcademyController::class, 'lines_edit'])->name('sica.admin.academy.lines.edit'); // Formulario de actualización de línea tecnológica (Administrador)
        Route::get('academic_coordinator/academy/lines/edit/{id}', [AcademyController::class, 'lines_edit'])->name('sica.academic_coordinator.academy.lines.edit'); // Formulario de actualización de línea tecnológica (Coordinador académico)
        Route::post('admin/academy/lines/update', [AcademyController::class, 'lines_update'])->name('sica.admin.academy.lines.update'); // Actualizar línea tecnológica (Administrador)
        Route::post('academic_coordinator/academy/lines/update', [AcademyController::class, 'lines_update'])->name('sica.academic_coordinator.academy.lines.update'); // Actualizar línea tecnológica (Coordinador académico)
        Route::get('admin/academy/lines/delete/{id}', [AcademyController::class, 'lines_delete'])->name('sica.admin.academy.lines.delete'); // Formulario de eliminación de línea tecnológica (Administrador)
        Route::get('academic_coordinator/academy/lines/delete/{id}', [AcademyController::class, 'lines_delete'])->name('sica.academic_coordinator.academy.lines.delete'); // Formulario de eliminación de línea tecnológica (Coordinador académico)
        Route::post('admin/academy/lines/destroy', [AcademyController::class, 'lines_destroy'])->name('sica.admin.academy.lines.destroy'); // Eliminar línea tecnológica (Administrador)
        Route::post('academic_coordinator/academy/lines/destroy', [AcademyController::class, 'lines_destroy'])->name('sica.academic_coordinator.academy.lines.destroy'); // Eliminar línea tecnológica (Coordinador académico)

        // ------------- Rutas de Cursos ------------------------------
        Route::get('admin/academy/courses', [AcademyController::class, 'courses_index'])->name('sica.admin.academy.courses.index'); // Listado de cursos registrados (Administador)
        Route::get('academic_coordinator/academy/courses', [AcademyController::class, 'courses_index'])->name('sica.academic_coordinator.academy.courses.index'); // Listado de cursos registrados (Coordinador académico)
        Route::get('admin/academy/course/create', [AcademyController::class, 'courses_create'])->name('sica.admin.academy.courses.create'); // Formulario de registro de curso (Administrador)
        Route::get('academic_coordinator/academy/course/create', [AcademyController::class, 'courses_create'])->name('sica.academic_coordinator.academy.courses.create'); // Formulario de registro de curso (Coordinador académico)
        Route::post('admin/academy/course/store', [AcademyController::class, 'courses_store'])->name('sica.admin.academy.courses.store'); // Registrar curso (Administrador)
        Route::post('academic_coordinator/academy/course/store', [AcademyController::class, 'courses_store'])->name('sica.academic_coordinator.academy.courses.store'); // Registrar curso (Coordinador académico)
        Route::get('admin/academy/course/edit/{id}', [AcademyController::class, 'courses_edit'])->name('sica.admin.academy.courses.edit'); // Formulario de actualización de curso (Administrador)
        Route::get('academic_coordinator/academy/course/edit/{id}', [AcademyController::class, 'courses_edit'])->name('sica.academic_coordinator.academy.courses.edit'); // Formulario de actualización de curso (Coordinador académico)
        Route::post('admin/academy/course/update/', [AcademyController::class, 'courses_update'])->name('sica.admin.academy.courses.update'); // Actualizar curso (Administrador)
        Route::post('academic_coordinator/academy/course/update/', [AcademyController::class, 'courses_update'])->name('sica.academic_coordinator.academy.courses.update'); // Actualizar curso (Coordinador académico)
        Route::get('admin/academy/course/delete/{id}', [AcademyController::class, 'courses_delete'])->name('sica.admin.academy.courses.delete'); // Formulario de eliminación de curso (Administrador)
        Route::get('academic_coordinator/academy/course/delete/{id}', [AcademyController::class, 'courses_delete'])->name('sica.academic_coordinator.academy.courses.delete'); // Formulario de eliminación de curso (Coordinador académico)
        Route::post('admin/academy/course/delete/', [AcademyController::class, 'course_destroy'])->name('sica.admin.academy.courses.destroy'); // Eliminar curso (Administrador)
        Route::post('academic_coordinator/academy/course/delete/', [AcademyController::class, 'course_destroy'])->name('sica.academic_coordinator.academy.courses.destroy'); // Eliminar curso (Coordinador académico)

    });

});
