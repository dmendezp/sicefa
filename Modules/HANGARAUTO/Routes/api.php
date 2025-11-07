<?php

use Illuminate\Http\Request;
use Modules\HANGARAUTO\Http\Controllers\AuthController;
use Modules\HANGARAUTO\Http\Controllers\ApiHangarController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/hangarauto/login',[AuthController::class,'login']);

Route::middleware('auth:api')->get('/hangarauto', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function(){
    Route::prefix('hangarauto')->group(function (){
        //API user
        Route::get('/solicitudes',[ApiHangarController::class,'solicitudes']);
        Route::get('/vehicletypes',[ApiHangarController::class,'vehicletype']);
        Route::post('/datevehicles', [ApiHangarController::class, 'datevehicles']);
        Route::get('/municipalities/{departamentoId}',[ApiHangarController::class,'municipalities']);
        Route::post('/registersolicitud', [ApiHangarController::class, 'registersolicitud']);
        Route::get('/logout',[AuthController::class,'logout']);
    });
});