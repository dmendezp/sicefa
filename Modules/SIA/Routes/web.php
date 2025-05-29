<?php

use Illuminate\Support\Facades\Route;
use Modules\SIA\Http\Controllers\SIAController;
use Modules\SIA\Http\Controllers\ApprenticeResearcherController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aquí puedes registrar las rutas web para tu aplicación. Estas rutas
| son cargadas por el RouteServiceProvider dentro de un grupo que
| contiene el middleware "web".
|
*/

Route::middleware(['lang'])->prefix('sia')->group(function () {
    Route::get('/', function () {
        return view('sia::index');
    })->name('sia.home')->name('home');
});
    // Ruta para la vista de administrador
    Route::get('/admin', [SIAController::class, 'admin'])->name('sia.admin');
});

Route::prefix('apprentice_researchers')->name('sia.apprentice_researchers.')->middleware(['auth', 'role:administrator'])->group(function () {
    Route::get('/', [ApprenticeResearcherController::class, 'index'])->name('index');
    Route::get('/create', [ApprenticeResearcherController::class, 'create'])->name('create');
    Route::post('/', [ApprenticeResearcherController::class, 'store'])->name('store');
    Route::get('/{id}', [ApprenticeResearcherController::class, 'show'])->name('show');
    Route::get('/{id}/edit', [ApprenticeResearcherController::class, 'edit'])->name('edit');
    Route::put('/{id}', [ApprenticeResearcherController::class, 'update'])->name('update');
    Route::delete('/{id}', [ApprenticeResearcherController::class, 'destroy'])->name('destroy');
});