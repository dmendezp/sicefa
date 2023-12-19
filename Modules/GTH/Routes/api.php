<?php

use Illuminate\Http\Request;

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
use Modules\GTH\Http\Controllers\ContractApiController;

Route::post('/gth/login',[ContractApiController::class,'login']);
Route::get('/gth/user',[ContractApiController::class,'user']);
Route::middleware('auth:api')->get('/gth', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function(){
    Route::prefix('gth')->group(function (){

        //API user
        Route::get('/getperson/{id}',[ContractApiController::class,'getPersonData']);
        Route::post('/registercontract',[ContractApiController::class,'register']);
        Route::get('/getopstions',[ContractApiController::class,'getopstions']);
        Route::get('/logout',[ContractApiController::class,'logout']);
        

    });
});