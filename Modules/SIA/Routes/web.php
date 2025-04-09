<?php
use Modules\SIA\Http\Controllers\SIAController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aquí puedes registrar las rutas web para tu aplicación. Estas rutas
| son cargadas por el RouteServiceProvider dentro de un grupo que
| contiene el middleware "web". ¡Crea algo grandioso!
|
*/
Route::prefix('sia')->group(function() {
    Route::get('/', 'SIAController@index');
});

Route::middleware(['lang'])->prefix('sia')->group(function () {
    // Ruta principal del módulo SIA
    Route::get('/index', [SIAController::class, 'index'])->name('cefa.sia.index');

    // Ruta para la vista de administrador
    Route::get('/admin/..', [SIAController::class, 'admin'])->name('cefa.sia...');
});
