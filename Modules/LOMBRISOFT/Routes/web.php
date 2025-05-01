<?php

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
use Modules\LOMBRISOFT\Http\Controllers\WormBedController;

Route::middleware(['lang'])->prefix('lombrisoft')->group(function() {
    Route::get('/index', 'LOMBRISOFTController@index')->name('cefa.lombrisoft.index');
    Route::get('/admin/welcome', 'LOMBRISOFTController@admin')->name('lombrisoft.admin.welcome');
    Route::get('/welcome', 'LOMBRISOFTController@welcome')->name('lombrisoft.welcome');
    Route::get('/intern/paneli', 'LOMBRISOFTController@intern')->name('lombrisoft.intern.paneli');

    // Ruta para listar camas
    Route::get('/admin/camas', [WormBedController::class, 'index'])
        ->name('lombrisoft.admin.camas');

    // Crear cama
    Route::get('/admin/camas/create', [WormBedController::class, 'create'])
        ->name('camas.create')
        ->middleware('can:lombrisoft.admin.camas.create');
    Route::post('/admin/camas', [WormBedController::class, 'store'])
        ->name('camas.store')
        ->middleware('can:lombrisoft.admin.camas.create');

    // Editar y actualizar cama
    Route::get('/admin/camas/{id}/edit', [WormBedController::class, 'edit'])
        ->name('camas.edit')
        ->middleware('can:lombrisoft.admin.camas.edit');
    Route::put('/admin/camas/{id}', [WormBedController::class, 'update'])
        ->name('camas.update')
        ->middleware('can:lombrisoft.admin.camas.update');

    // Eliminar cama
    Route::delete('/admin/camas/{id}', [WormBedController::class, 'destroy'])
        ->name('camas.destroy')
        ->middleware('can:lombrisoft.admin.camas.destroy');
});
