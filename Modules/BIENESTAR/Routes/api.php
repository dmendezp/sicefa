<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\BIENESTAR\Http\Controllers\AuthController;
use Modules\BIENESTAR\Http\Controllers\TransportationAssistancesController;
use Modules\BIENESTAR\Http\Controllers\AssistancesFoodsController;

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

Route::middleware('auth:api')->get('/bienestar', function (Request $request) {
    return $request->user();
});
Route::post('/Api/login', [AuthController::class, 'login']);
Route::post('/Api/logout', [AuthController::class, 'logout']);
Route::get('/Api/transportation_asistance',[TransportationAssistancesController::class, 'AssistancesTransport']);
Route::get('/Api/saveAttendance',[TransportationAssistancesController::class, 'SaveAttendance']);
// Rutas relacionadas con el módulo BIENESTAR
Route::get('/Api/FoodAssistances', [AssistancesFoodsController::class, 'FoodAssistances']);
Route::get('/Api/RegisterAssistances', [AssistancesFoodsController::class, 'RegisterAssistances']);