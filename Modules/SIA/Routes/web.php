<?php
use Illuminate\Support\Facades\Route;

Route::prefix('sia')->middleware(['lang'])->group(function () {
    Route::controller(SIAController::class)->group(function () {
        Route::get('index', 'index')->name('cefa.sia.index');
        Route::get('developers', 'devs')->name('cefa.sia.devs');
        Route::get('information', 'info')->name('cefa.sia.info');
        Route::get('admin', 'admin')->name('sia.admin.index');
    });
});