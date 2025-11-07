<?php

use Illuminate\Http\Request;
use Modules\AGROCEFA\Http\Controllers\AuthController;
use Modules\AGROCEFA\Http\Controllers\ApiController;
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
Route::post('/agrocefa/login',[AuthController::class,'login']);

Route::middleware('auth:api')->get('/agrocefa', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function(){
    Route::prefix('agrocefa')->group(function (){

        //API user
        Route::get('/unidades',[ApiController::class,'unit']);
        Route::get('/lotes/{id}',[ApiController::class,'lotes']);
        Route::get('/cultivos/{id}',[ApiController::class,'cultivos']);
        Route::get('/balance/{id}',[ApiController::class,'balance']);
        Route::get('/logout',[AuthController::class,'logout']);
        

    });
});