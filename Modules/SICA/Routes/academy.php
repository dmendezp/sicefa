<?php
use Illuminate\Support\Facades\Route;
use Modules\SICA\Http\Controllers\academy\AcademyController;

Route::middleware(['lang'])->group(function(){

    Route::prefix('sica/')->group(function() {

        // --------------  Rutas de Trimestres ---------------------------------
        Route::get('admin/academy/quarters', [AcademyController::class, 'quarters'])->name('sica.admin.academy.quarters');

        // --------------  Rutas de Días Festivos ---------------------------------
        Route::get('admin/academy/holidays', [AcademyController::class, 'holidays_index'])->name('sica.admin.academy.holidays.index'); // Listados de días festivos disponibles (Administrador)
        Route::post('admin/academy/holidays/store', [AcademyController::class, 'holidays_store'])->name('sica.admin.academy.holidays.store'); // Registrar día festivo (Administrador)
        Route::get('admin/academy/holidays/edit/{holiday}', [AcademyController::class, 'holidays_edit'])->name('sica.admin.academy.holidays.edit'); // Formulario para actualizar día festivo (Administrador)
        Route::post('admin/academy/holidays/update/{holiday}', [AcademyController::class, 'holidays_update'])->name('sica.admin.academy.holidays.update'); // Actualizar día festivo (Administrador)
        Route::delete('admin/academy/holidays/destroy/{holiday}', [AcademyController::class, 'holidays_destroy'])->name('sica.admin.academy.holidays.destroy'); // Eliminar día festivo (Administrador)

        // ------------Rutas de lineas-----------
        Route::get('admin/academy/lines', [AcademyController::class, 'lines'])->name('sica.admin.academy.lines');
        Route::get('admin/academy/line/create', [AcademyController::class, 'createLine'])->name('sica.admin.academy.line.create');
        Route::post('admin/academy/line/store', [AcademyController::class, 'storeLine'])->name('sica.admin.academy.line.store');
        Route::get('admin/academy/line/edit/{id}', [AcademyController::class, 'editLine'])->name('sica.admin.academy.line.edit');
        Route::post('admin/academy/line/edit', [AcademyController::class, 'updateLine'])->name('sica.admin.academy.line.update');
        Route::get('admin/academy/line/delete/{id}', [AcademyController::class, 'deleteLine'])->name('sica.admin.academy.line.delete');
        Route::post('admin/academy/line/delete/', [AcademyController::class, 'destroyLine'])->name('sica.admin.academy.line.destroy');

        // ------------- Rutas de Redes ----------------------
        Route::get('admin/academy/network', [AcademyController::class, 'networks'])->name('sica.admin.academy.networks');
        Route::get('admin/academy/network/create', [AcademyController::class, 'createNetwork'])->name('sica.admin.academy.network.create');
        Route::post('admin/academy/network/store', [AcademyController::class, 'storeNetwork'])->name('sica.admin.academy.network.store');
        Route::get('admin/academy/network/edit/{id}', [AcademyController::class, 'editNetwork'])->name('sica.admin.academy.network.edit');
        Route::post('admin/academy/network/update/', [AcademyController::class, 'updateNetwork'])->name('sica.admin.academy.network.update');
        Route::get('admin/academy/network/delete/{id}', [AcademyController::class, 'deleteNetwork'])->name('sica.admin.academy.network.delete');
        Route::post('admin/academy/network/delete/', [AcademyController::class, 'destroyNetwork'])->name('sica.admin.academy.network.destroy');

        // ------------- Rutas de Programas de Formación ---------------------
        Route::get('admin/academy/programs', [AcademyController::class, 'programs'])->name('sica.admin.academy.programs');
        Route::get('admin/academy/program/create', [AcademyController::class, 'createProgram'])->name('sica.admin.academy.program.create');
        Route::post('admin/academy/program/store', [AcademyController::class, 'storeProgram'])->name('sica.admin.academy.program.store');
        Route::get('admin/academy/program/edit/{id}', [AcademyController::class, 'editProgram'])->name('sica.admin.academy.program.edit');
        Route::post('admin/academy/program/update/', [AcademyController::class, 'updateProgram'])->name('sica.admin.academy.program.update');
        Route::get('admin/academy/program/delete/{id}', [AcademyController::class, 'deleteProgram'])->name('sica.admin.academy.program.delete');
        Route::post('admin/academy/program/delete/', [AcademyController::class, 'destroyProgram'])->name('sica.admin.academy.program.destroy');

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
