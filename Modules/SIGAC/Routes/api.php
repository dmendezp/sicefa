<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\SIGAC\Http\Controllers\KeyController;
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


Route::post('/sigac/login_sicefa', [KeyController::class, 'login']);

Route::middleware('auth:api')->get('/sigac', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('sigac')->group(function (){
        Route::get('/instructor_program', [KeyController::class, 'search_instructor_program']);
        Route::post('/check_auth', [KeyController::class, 'check_authorization']);
        Route::post('/request_key', [KeyController::class, 'request_key_program']);
        Route::post('/return_key_program', [KeyController::class, 'return_key']);
        Route::get('/get_current_programs', [KeyController::class, 'get_current_program']);
        Route::get('/logout_sicefa', [KeyController::class, 'logout']);

    });
});

    

