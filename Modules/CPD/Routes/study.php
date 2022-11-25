<?php
use Illuminate\Support\Facades\Route;
use Modules\CPD\Http\Controllers\StudyController;

Route::middleware(['lang'])->group(function(){
    Route::prefix('cpd')->group(function() {

    // Studies
        Route::get('/admin/study/index', [StudyController::class, 'index'])->name('cefa.cpd.admin.study.index');
        // Add
        Route::get('/admin/study/add', [StudyController::class, 'addGet'])->name('cefa.cpd.admin.study.add');
        Route::post('/admin/study/add', [StudyController::class, 'addPost'])->name('cefa.cpd.admin.study.add');
        // Update
        Route::get('/admin/study/update', [StudyController::class, 'updateGet'])->name('cefa.cpd.admin.study.update');
        Route::post('/admin/study/update', [StudyController::class, 'updatePost'])->name('cefa.cpd.admin.study.update');


    });
});
