<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Modules\SIGAC\Http\Controllers\AuthController;
use Modules\SIGAC\Http\Controllers\ApprenticesController;
use Modules\SIGAC\Http\Controllers\AssistancesController;
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

Route::middleware('auth:api')->get('/sigac', function (Request $request) {
    return $request->user();
});


Route::post('/SIGAC/register',[AuthController::class,'register'] );
Route::post('/SIGAC/login',[AuthController::class,'login'] );
Route::post('/SIGAC/user',[AuthController::class,'user'] );
Route::post('/SIGAC/logout',[AuthController::class,'logout'] );

Route::get('/SIGAC/apprentice', [ApprenticesController::class, 'searchApprentices']);
Route::post('/SIGAC/apprentice', [ApprenticesController::class, 'searchApprentices']);
Route::post('/SIGAC/assistence', [AssistancesController::class, 'store']);
