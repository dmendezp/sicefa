<?php
use Illuminate\Support\Facades\Route;
use Modules\SICA\Http\Controllers\academy\AcademyController;

Route::middleware(['lang'])->group(function(){
    /* RUTAS PARA EL ROL DE ADMINISTRADOR */
    Route::prefix('sica/admin')->group(function() {
        // ------------- Rutas de Academy -------------
        Route::prefix('academy')->group(function(){
            // ------------ Rutas de Trimestres ------------------
            Route::get('/quarters', [AcademyController::class, 'quarters'])->name('sica.admin.academy.quarters');
            // ------------- Rutas de Programas
            Route::get('/curriculums', [AcademyController::class, 'curriculums'])->name('sica.admin.academy.curriculums');

            // ------------- Rutas de Titulaciones
            Route::get('/courses', [AcademyController::class, 'courses'])->name('sica.admin.academy.courses');

            // ------------Rutas de lineas-----------
            //Listar
            Route::get('/lines', [AcademyController::class, 'lines'])->name('sica.admin.academy.lines');

            //Agregar
            Route::get('/line/create', [AcademyController::class, 'createLine'])->name('sica.admin.academy.line.create');
            Route::post('/line/store', [AcademyController::class, 'storeLine'])->name('sica.admin.academy.line.store');

            //Editar
            Route::get('/line/edit/{id}', [AcademyController::class, 'editLine'])->name('sica.admin.academy.line.edit');
            Route::post('/line/edit', [AcademyController::class, 'updateLine'])->name('sica.admin.academy.line.update');

            // Eliminar
            Route::get('/line/delete/{id}', [AcademyController::class, 'deleteLine'])->name('sica.admin.academy.line.delete');
            Route::post('/line/delete/', [AcademyController::class, 'destroyLine'])->name('sica.admin.academy.line.destroy');

            // ------------- Rutas de Redes ----------------------
            //Listar
            Route::get('/network', [AcademyController::class, 'networks'])->name('sica.admin.academy.networks');

            //Agregar
            Route::get('/network/create', [AcademyController::class, 'createNetwork'])->name('sica.admin.academy.network.create');
            Route::post('/network/store', [AcademyController::class, 'storeNetwork'])->name('sica.admin.academy.network.store');

            //Editar
            Route::get('/network/edit/{id}', [AcademyController::class, 'editNetwork'])->name('sica.admin.academy.network.edit');
            Route::post('/network/update/', [AcademyController::class, 'updateNetwork'])->name('sica.admin.academy.network.update');
        });
    });

}); 