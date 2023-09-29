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
        Route::delete('admin/academy/holidays/destroy/{holiday}', [AcademyController::class, 'holidays_destroy'])->name('sica.admin.academy.holidays.destroy'); // Eliminar día festivo (Administrador)
        Route::delete('academic_coordinator/academy/holidays/destroy/{holiday}', [AcademyController::class, 'holidays_destroy'])->name('sica.academic_coordinator.academy.holidays.destroy'); // Eliminar día festivo (Coordinador académico)

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
        Route::delete('admin/academy/quarters/destroy/{quarter}', [AcademyController::class, 'quarters_destroy'])->name('sica.admin.academy.quarters.destroy'); // Eliminar trimestre (Administrador)
        Route::delete('academic_coordinator/academy/quarters/destroy/{quarter}', [AcademyController::class, 'quarters_destroy'])->name('sica.academic_coordinator.academy.quarters.destroy'); // Eliminar trimestre (Coordinador académico)

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

        // ------------Rutas de Líneas tecnologicas-----------
        // ===========================================================================================================================================================================================================
        Route::get('admin/academy/lines', [AcademyController::class, 'lines_index'])->name('sica.admin.academy.lines.index');
        // ===========================================================================================================================================================================================================
        Route::get('admin/academy/lines/create', [AcademyController::class, 'lines_create'])->name('sica.admin.academy.lines.create');
        Route::post('admin/academy/lines/store', [AcademyController::class, 'lines_store'])->name('sica.admin.academy.lines.store');
        Route::get('admin/academy/lines/edit/{id}', [AcademyController::class, 'lines_edit'])->name('sica.admin.academy.lines.edit');
        Route::post('admin/academy/lines/edit', [AcademyController::class, 'lines_update'])->name('sica.admin.academy.lines.update');
        Route::get('admin/academy/lines/delete/{id}', [AcademyController::class, 'lines_delete'])->name('sica.admin.academy.lines.delete');
        Route::post('admin/academy/lines/delete/', [AcademyController::class, 'lines_destroy'])->name('sica.admin.academy.lines.destroy');

        // ------------- Rutas de Redes ----------------------
        Route::get('admin/academy/networks', [AcademyController::class, 'networks_index'])->name('sica.admin.academy.networks.index');
        Route::get('admin/academy/networks/create', [AcademyController::class, 'networks_create'])->name('sica.admin.academy.networks.create');
        Route::post('admin/academy/networks/store', [AcademyController::class, 'networks_store'])->name('sica.admin.academy.networks.store');
        Route::get('admin/academy/networks/edit/{id}', [AcademyController::class, 'networks_edit'])->name('sica.admin.academy.networks.edit');
        Route::post('admin/academy/networks/update/', [AcademyController::class, 'networks_update'])->name('sica.admin.academy.networks.update');
        Route::get('admin/academy/networks/delete/{id}', [AcademyController::class, 'networks_delete'])->name('sica.admin.academy.networks.delete');
        Route::post('admin/academy/networks/destroy/', [AcademyController::class, 'networks_destroy'])->name('sica.admin.academy.networks.destroy');

        // ------------- Rutas de Cursos ------------------------------
        Route::get('admin/academy/courses', [AcademyController::class, 'courses'])->name('sica.admin.academy.courses');
        Route::get('admin/academy/course/create', [AcademyController::class, 'createCourse'])->name('sica.admin.academy.course.create');
        Route::post('admin/academy/course/store', [AcademyController::class, 'storeCourse'])->name('sica.admin.academy.course.store');
        Route::get('admin/academy/course/edit/{id}', [AcademyController::class, 'editCourse'])->name('sica.admin.academy.course.edit');
        Route::post('admin/academy/course/update/', [AcademyController::class, 'updateCourse'])->name('sica.admin.academy.course.update');
        Route::get('admin/academy/course/delete/{id}', [AcademyController::class, 'deleteCourse'])->name('sica.admin.academy.course.delete');
        Route::post('admin/academy/course/delete/', [AcademyController::class, 'destroyCourse'])->name('sica.admin.academy.course.destroy');

    });

});
