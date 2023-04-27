<?php
use Illuminate\Support\Facades\Route;
use Modules\SICA\Http\Controllers\academy\AcademyController;

Route::middleware(['lang'])->group(function(){

    Route::prefix('sica')->group(function() {

        Route::get('/admin/academy/quarters', [AcademyController::class, 'quarters'])->name('sica.admin.academy.quarters');
        Route::get('/admin/academy/curriculums', [AcademyController::class, 'curriculums'])->name('sica.admin.academy.curriculums');
        Route::get('/admin/academy/network', [AcademyController::class, 'networks'])->name('sica.admin.academy.networks');
        Route::get('/admin/academy/courses', [AcademyController::class, 'courses'])->name('sica.admin.academy.courses');

        /* ------------Rutas de lineas----------- */
        //Listar
        Route::get('/admin/academy/lines', [AcademyController::class, 'lines'])->name('sica.admin.academy.lines');

        //Agregar
        Route::get('/admin/line/create', [AcademyController::class, 'createLine'])->name('sica.admin.academy.line.create'); //Solicitud GET que tenga esta URL se manejará a través de esta ruta.
        Route::post('/admin/line/store', [AcademyController::class, 'storeLine'])->name('sica.admin.academy.line.store');

        //Editar
        Route::get('/admin/line/edit/{id}', [AcademyController::class, 'editLine'])->name('sica.admin.academy.line.edit');
        Route::post('/admin/line/edit', [AcademyController::class, 'updateLine'])->name('sica.admin.academy.line.update');

         // Eliminar
         Route::get('/admin/line/delete/{id}', [AcademyController::class, 'deleteLine'])->name('sica.admin.academy.line.delete');
         Route::post('/admin/line/delete/', [AcademyController::class, 'destroyLine'])->name('sica.admin.academy.line.destroy');

    });

}); 