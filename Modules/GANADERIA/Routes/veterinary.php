<?php
use Illuminate\Support\Facades\Route;
use Modules\GANADERIA\Http\Controllers\veterinary\VeterinaryController;

/* Route::middleware(['lang'])->group(function(){ */
  Route::prefix('ganaderia')->group(function() {
    Route::get('/admin/vet/index',[VeterinaryController::class, 'index'])->name('ganaderia.admin.vet.index');
    Route::get('/admin/vet/register',[VeterinaryController::class, 'register'])->name('ganaderia.admin.vet.register');
    Route::get('/admin/vet/add',[VeterinaryController::class, 'add'])->name('ganaderia.admin.vet.register.add');
    Route::post('/admin/vet/add',[VeterinaryController::class, 'addpost'])->name('ganaderia.admin.vet.addpost');
    Route::get('/admin/vet/edit/{id}',[VeterinaryController::class, 'edit'])->name('ganaderia.admin.vet.register.edit');
    Route::post('/admin/vet/edit',[VeterinaryController::class, 'editpost'])->name('ganaderia.admin.vet.editpost');
    Route::get('/admin/search/{document}',[VeterinaryController::class, 'search'])->name('ganaderia.admin.search');
  });
/* }); */
  /*
  ganaderia.admin.vet
  */