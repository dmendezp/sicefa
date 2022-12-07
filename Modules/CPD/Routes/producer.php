<?php
use Illuminate\Support\Facades\Route;
use Modules\CPD\Http\Controllers\ProducerController;

Route::middleware(['lang'])->group(function(){
    Route::prefix('cpd')->group(function() {

    // Producers
        Route::get('/admin/producer/index', [ProducerController::class, 'index'])->name('cpd.admin.producer.index');
        // Create
        Route::get('/admin/producer/create', [ProducerController::class, 'create'])->name('cpd.admin.producer.create');
        /* Route::post('/admin/producer/add', [ProducerController::class, 'add'])->name('cpd.admin.producer.add'); */
        // Update
        /* Route::get('/admin/producer/update/{id}', [ProducerController::class, 'updateGet'])->name('cpd.admin.producer.update');
        Route::post('/admin/producer/update', [ProducerController::class, 'updatePost'])->name('cpd.admin.producer.update'); */
        // Detail
        /* Route::get('/admin/producer/detail/{id}', [ProducerController::class, 'detailGet'])->name('cpd.admin.producer.detail'); */
        // Delete
        /* Route::get('/admin/producer/delete/{id}', [ProducerController::class, 'deleteGet'])->name('cpd.admin.producer.delete');
        Route::post('/admin/producer/delete', [ProducerController::class, 'deletePost'])->name('cpd.admin.producer.delete'); */

    });
});
