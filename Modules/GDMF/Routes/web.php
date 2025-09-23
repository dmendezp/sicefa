<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['lang'])->group(function () { //Middleware que permite la internacionalizacion

    Route::prefix('gdmf')->group(function () {  // agrega el prefijo en la url (sicefa.test/gdmf/...)

        // RUTAS GENERALES
        Route::controller(GDMFController::class)->group(function () { // Agregar por única vez el controlodaar para posteriormente solo definir rutas con el formato (url, método_controlador)->name(nombre_de_ruta)
            Route::get('index', 'index')->name('cefa.gdmf.index'); // Vista principal y pública de la aplicación.
            Route::get('information', 'info')->name('cefa.gdmf.info'); // Vista mas info sobre gdmf y pública de la aplicación (Pública)
            Route::get('developers', 'devs')->name('cefa.gdmf.devs'); // Vista sobre desarrolladores y creditos sobre gdmf y pública de la aplicación (Pública)
            Route::get('academic_coordination', 'academic_coordination_dashboard')->name('gdmf.academic_coordination.dashboard'); // Panel de control de coordinación académica (Coordinación Académica)
            Route::get('instructor', 'instructor_dashboard')->name('gdmf.instructor.dashboard'); // Panel de control del instructor (Instructor)
        });

        // RUTAS PLANEACION CURRICULAR
        Route::controller(CurriculumPlanningController::class)->group(function () {

            // ---------------- Proyecto Formatrivo ---------------------------
            Route::get('academic_coordination/curriculum_planning/training_project/index', 'training_project_index')->name('gdmf.academic_coordination.curriculum_planning.training_project.index'); // Vista proyectos formativos y cursos (Coordinación Académica)
            Route::get('academic_coordination/curriculum_planning/training_project/quarterlie/index/{training_project_id}/{course_id}', 'training_project_quarterlie_index')->name('gdmf.academic_coordination.curriculum_planning.training_project.quarterlie.index'); // Vista trimestralización del curso (Coordinación Académica)
            Route::post('academic_coordination/curriculum_planning/training_project/store', 'training_project_store')->name('gdmf.academic_coordination.curriculum_planning.training_project.store'); // Registrar proyecto formativo (Coordinación Académica)
            Route::post('academic_coordination/curriculum_planning/training_project/update', 'training_project_update')->name('gdmf.academic_coordination.curriculum_planning.training_project.update'); // Actualizar proyecto formativo (Coordinación Académica)
            Route::delete('academic_coordination/curriculum_planning/training_project/destroy/{id}', 'training_project_destroy')->name('gdmf.academic_coordination.curriculum_planning.training_project.destroy'); // Eliminar proyecto formativo (Coordinación Académica)
            Route::post('academic_coordination/curriculum_planning/training_project/budget/store', 'training_project_budget_store')->name('gdmf.academic_coordination.curriculum_planning.training_project.budget.store'); // Vista proyectos formativos y cursos (Coordinación Académica)
            // Curso x Proyecto formativo
            Route::get('academic_coordination/curriculum_planning/course_trainig_project/course_training_project_index', 'course_training_project_index')->name('gdmf.academic_coordination.curriculum_planning.course_trainig_project.index'); // Vista asociacion de curso por proyecto formativo (Coordinación Académica)
            Route::post('academic_coordination/curriculum_planning/course_trainig_project/table', 'course_training_project_table')->name('gdmf.academic_coordination.curriculum_planning.course_trainig_project.table'); // Consulta de los cursos por proyecto formativo (Coordinación Académica)
            Route::post('academic_coordination/curriculum_planning/course_trainig_project/course_training_project_store', 'course_training_project_store')->name('gdmf.academic_coordination.curriculum_planning.course_trainig_project.store'); // Asociar curso al proyecto formativo (Coordinación Académica)
            Route::delete('academic_coordination/curriculum_planning/course_trainig_project/course_training_project_destroy/{training_project_id}/{course_id}', 'course_training_project_destroy')->name('gdmf.academic_coordination.curriculum_planning.course_trainig_project.destroy'); // Eliminar asociacion del curso con el proyecto formativo (Coordinación Académica)
        });

        // RUTAS ASIGNACION DE MATERIALES
        Route::controller(TrainingMaterialController::class)->group(function () {

            // Asignacion de materiales
            Route::get('academic_coordination/curriculum_planning/manage_materials/index', 'index')->name('gdmf.academic_coordination.curriculum_planning.manage_materials.index'); // Vista asociacion de materiales (Coordinación Académica)
            Route::post('academic_coordination/curriculum_planning/manage_materials/store', 'store')->name('gdmf.academic_coordination.curriculum_planning.manage_materials.store'); // Asociar materiales al proyecto formativo (Coordinación Académica)
            Route::delete('academic_coordination/curriculum_planning/manage_materials/destroy/{id}', 'destroy')->name('gdmf.academic_coordination.curriculum_planning.manage_materials.destroy'); // Eliminar asociacion de materiales con el proyecto formativo (Coordinación Académica)
        });

        // RUTAS PRESUPUESTO ANUAL
        Route::controller(AnnualBudgetController::class)->group(function () {

            // ---------------- Proyecto Formatrivo ---------------------------
            Route::get('academic_coordination/annual_budget/index', 'index')->name('gdmf.academic_coordination.annual_budget.index'); // Vista proyectos formativos y cursos (Coordinación Académica)
            Route::post('academic_coordination/annual_budget/store', 'store')->name('gdmf.academic_coordination.annual_budget.store'); // Vista trimestralización del curso (Coordinación Académica)
            Route::put('academic_coordination/annual_budget/update/{id}', 'update')->name('gdmf.academic_coordination.annual_budget.update'); // Registrar proyecto formativo (Coordinación Académica)
            Route::delete('academic_coordination/annual_budget/destroy/{id}', 'destroy')->name('gdmf.academic_coordination.annual_budget.destroy'); // Eliminar proyecto formativo (Coordinación Académica)
        });

        // RUTAS PRESUPUESTO ANUAL
        Route::controller(MaterialRequestController::class)->group(function () {

            // ---------------- Proyecto Formatrivo ---------------------------
            Route::get('instructor/material_request/index', 'index')->name('gdmf.instructor.material_request.index'); // Vista proyectos formativos y cursos (Coordinación Académica)
            Route::post('instructor/material_request/store', 'store')->name('gdmf.instructor.material_request.store'); // Vista trimestralización del curso (Coordinación Académica)
            Route::get('instructor/material_request/project_info/{courseId}', 'getProjectInfo')->name('gdmf.instructor.material_request.project_info'); // Registrar proyecto formativo (Coordinación Académica)
            Route::get('academic_coordination/material_request/report', 'report')->name('gdmf.academic_coordination.material_request.report'); // Vista proyectos formativos y cursos (Coordinación Académica)
        });

        // RUTAS PRESUPUESTO ANUAL
        Route::controller(PurchaseController::class)->group(function () {

            // ---------------- Proyecto Formatrivo ---------------------------
            Route::get('academic_coordination/purchase/index', 'index')->name('gdmf.academic_coordination.purchase.index'); // Vista proyectos formativos y cursos (Coordinación Académica)
            Route::post('academic_coordination/purchase/store', 'store')->name('gdmf.academic_coordination.purchase.store'); // Vista trimestralización del curso (Coordinación Académica)
            Route::get('academic_coordination/purchase/report', 'report')->name('gdmf.academic_coordination.purchase.report'); // Vista proyectos formativos y cursos (Coordinación Académica)
            Route::get('academic_coordination/purchase/report/{id}', 'report_show')->name('gdmf.academic_coordination.purchase.report_show'); // Vista proyectos formativos y cursos (Coordinación Académica)
            Route::get('academic_coordination/purchase/failures/{hash}', 'failures')->name('gdmf.academic_coordination.purchase.failure');
            Route::get('academic_coordination/purchase/history_failure', 'history_failure')->name('gdmf.academic_coordination.purchase.history_failure');
        });
    });
});
