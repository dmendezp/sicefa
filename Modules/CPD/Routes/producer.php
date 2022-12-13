<?php
use Illuminate\Support\Facades\Route;
use Modules\CPD\Http\Controllers\ProducerController;

Route::middleware(['lang'])->group(function(){
    Route::prefix('cpd')->group(function() {

    // Producers
        Route::get('/admin/producer/index', [ProducerController::class, 'index'])->name('cpd.admin.producer.index');
        // Create
        Route::get('/admin/producer/create', [ProducerController::class, 'create'])->name('cpd.admin.producer.create');
        Route::post('/admin/producer/store', [ProducerController::class, 'store'])->name('cpd.admin.producer.store');
        // Update
        Route::get('/admin/producer/edit/{id}', [ProducerController::class, 'edit'])->name('cpd.admin.producer.edit');
        Route::post('/admin/producer/update', [ProducerController::class, 'update'])->name('cpd.admin.producer.update');
        // Delete
        Route::get('/admin/producer/delete/{id}', [ProducerController::class, 'delete'])->name('cpd.admin.producer.delete');
        Route::post('/admin/producer/destroy', [ProducerController::class, 'destroy'])->name('cpd.admin.producer.destroy');

    });
});
