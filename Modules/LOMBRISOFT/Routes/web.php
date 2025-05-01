<?php

use Modules\LOMBRISOFT\Http\Controllers\WormBedController;

Route::middleware(['lang'])->prefix('lombrisoft')->group(function() {
    // Rutas principales
    Route::get('/index', 'LOMBRISOFTController@index')->name('cefa.lombrisoft.index');
    Route::get('/admin/welcome', 'LOMBRISOFTController@admin')->name('lombrisoft.admin.welcome');
    Route::get('/welcome', 'LOMBRISOFTController@welcome')->name('lombrisoft.welcome');
    Route::get('/intern/paneli', 'LOMBRISOFTController@intern')->name('lombrisoft.intern.paneli');

    // Rutas para gestión de camas
    Route::get('/admin/camas', [WormBedController::class, 'index'])
        ->name('lombrisoft.admin.camas.index');

    Route::get('/admin/camas/crear', [WormBedController::class, 'create'])
        ->name('lombrisoft.admin.camas.create');

    Route::post('/admin/camas', [WormBedController::class, 'store'])
        ->name('lombrisoft.admin.camas.store');

    Route::get('/admin/camas/{id}', [WormBedController::class, 'show'])
        ->name('lombrisoft.admin.camas.show');

    Route::get('/admin/camas/{id}/editar', [WormBedController::class, 'edit'])
        ->name('lombrisoft.admin.camas.edit');

    Route::put('/admin/camas/{id}', [WormBedController::class, 'update'])
        ->name('lombrisoft.admin.camas.update');

    Route::delete('/admin/camas/{id}', [WormBedController::class, 'destroy'])
        ->name('lombrisoft.admin.camas.destroy');
});