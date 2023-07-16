<?php

use Illuminate\Support\Facades\Route;
use Modules\CEFAMAPS\Http\Controllers\sst\SSTController;

Route::middleware(['lang'])->group(function(){

    Route::prefix('cefamaps')->group(function() {
        Route::get('/sst/index', [SSTController::class, 'index'])->name('cefamaps.sst.index');
        Route::get('/sst/evacuation', [SSTController::class, 'evacuation'])->name('cefamaps.sst.evacuation');
        Route::get('/sst/Extintores', [SSTController::class, 'Extintores'])->name('cefamaps.sst.Extintores');
        Route::get('/sst/healt', [SSTController::class, 'healt'])->name('cefamaps.sst.healt');
        Route::get('/sst/videos', [SSTController::class, 'videos'])->name('cefamaps.sst.videos');
    });

});