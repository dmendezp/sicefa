<?php
use Illuminate\Support\Facades\Route;
use Modules\CPD\Http\Controllers\StudyController;

Route::middleware(['lang'])->group(function(){
    Route::prefix('cpd')->group(function() {

    // Studies
        Route::get('/admin/study/index', [StudyController::class, 'index'])->name('cpd.admin.study.index');
        // Add
        Route::get('/admin/study/create', [StudyController::class, 'create'])->name('cpd.admin.study.create');
        Route::post('/admin/study/store', [StudyController::class, 'store'])->name('cpd.admin.study.store');
        // Update
        Route::get('/admin/study/edit/{id}', [StudyController::class, 'edit'])->name('cpd.admin.study.edit');
        Route::post('/admin/study/update', [StudyController::class, 'update'])->name('cpd.admin.study.update');
        // show
        Route::get('/admin/study/show/{id}', [StudyController::class, 'show'])->name('cpd.admin.study.show');
        // Delete
        Route::get('/admin/study/delete/{id}', [StudyController::class, 'delete'])->name('cpd.admin.study.delete');
        Route::post('/admin/study/destroy', [StudyController::class, 'destroy'])->name('cpd.admin.study.destroy');

    });
});
