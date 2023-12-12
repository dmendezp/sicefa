<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\BIENESTAR\Http\Controllers\AssistancesFoodsController;

Route::get('/bienestar', function (Request $request) {
    return $request->user();
});

// Rutas relacionadas con el módulo BIENESTAR
Route::get('/bienestar/assistancefoodrecord', [AssistancesFoodsController::class, 'assistancefoodrecord']);
Route::get('/bienestar/food_assitances', [AssistancesFoodsController::class, 'food_assitances']);
Route::post('/bienestar/assistances', [AssistancesFoodsController::class, 'assistances']);

Route::middleware('auth:api')->group(function () {
        // Ruta protegida por autenticación
   
});
