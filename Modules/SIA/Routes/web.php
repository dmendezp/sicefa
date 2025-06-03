<?php

use Illuminate\Support\Facades\Route;
use Modules\SIA\Http\Controllers\SIAController;
use Modules\SIA\Http\Controllers\Admin\DashboardController;
use Modules\SIA\Http\Controllers\ApprenticeResearcherController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Agrupar rutas bajo el prefijo 'sia' sin middleware global para permitir acceso público
Route::prefix('sia')->group(function () {
    // Ruta principal del módulo SIA (pública, sin autenticación requerida)
    Route::get('/', function () {
        return view('sia::index');
    })->name('sia.home');

    // Ruta adicional para /sia/index (pública)
    Route::get('/index', function () {
        return view('sia::index');
    })->name('sia.index');

    // Ruta para información o desarrolladores (pública)
    Route::get('/developers', [SIAController::class, 'developers'])->name('sia.developers');

    // Rutas para administradores (protegidas con autenticación y permisos)
    Route::prefix('admin')->middleware(['auth', 'permission:sia.admin.index'])->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('sia.admin.dashboard');
    });

    // Rutas para gestión de aprendices investigadores (protegidas con autenticación y rol)
    Route::prefix('apprentice_researchers')->name('sia.apprentice_researchers.')->middleware(['auth', 'role:sia.admin'])->group(function () {
        Route::get('/', [ApprenticeResearcherController::class, 'index'])->name('index');
        Route::get('/create', [ApprenticeResearcherController::class, 'create'])->name('create');
        Route::post('/', [ApprenticeResearcherController::class, 'store'])->name('store');
        Route::get('/{id}', [ApprenticeResearcherController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [ApprenticeResearcherController::class, 'edit'])->name('edit');
        Route::put('/{id}', [ApprenticeResearcherController::class, 'update'])->name('update');
        Route::delete('/{id}', [ApprenticeResearcherController::class, 'destroy'])->name('destroy');
    });
});