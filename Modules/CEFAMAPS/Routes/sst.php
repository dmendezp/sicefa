<?php

use Illuminate\Support\Facades\Route;
use Modules\CEFAMAPS\Http\Controllers\sst\SSTController;

Route::middleware(['lang'])->group(function(){

    Route::prefix('cefamaps')->group(function() {
        Route::get('/sst/index', [SSTController::class, 'index'])->name('cefamaps.sst.index');
        Route::get('/sst/evacuation', [SSTController::class, 'evacuation'])->name('cefamaps.sst.evacuation');
    });

});