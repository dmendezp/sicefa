<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::prefix('bienestar')->group(function() {
    Route::get('/', 'BIENESTARController@index');
});



Route::prefix('/bienestar')->group(function() {
    Route::get('/APEalimentacion', 'BIENESTARController@APEalimentacion')->name('bienestar.APEalimentacion');
});

Route::prefix('/bienestar')->group(function() {
    Route::get('/APEinterno', 'BIENESTARController@APEinterno')->name('bienestar.APEinterno');
});

Route::prefix('/bienestar')->group(function() {
    Route::get('/APEsena', 'BIENESTARController@APEsena')->name('bienestar.APEsena');
});
Route::prefix('/bienestar')->group(function() {
    Route::get('/APEtransporte', 'BIENESTARController@APEtransporte')->name('bienestar.APEtransporte');
});
Route::prefix('/bienestar')->group(function() {
    Route::get('/HISeventos', 'BIENESTARController@HISeventos')->name('bienestar.HISeventos');
});
Route::prefix('/bienestar')->group(function() {
    Route::get('/home', 'BIENESTARController@home')->name('bienestar.home');
});
Route::prefix('/bienestar')->group(function() {
    Route::get('/LIDretorant', 'BIENESTARController@LIDretorant')->name('bienestar.LIDretorant');
});
Route::prefix('/bienestar')->group(function() {
    Route::get('/LIDrutas', 'BIENESTARController@LIDrutas')->name('bienestar.LIDrutas');
});
Route::prefix('/bienestar')->group(function() {
    Route::get('/SCANrestorant', 'BIENESTARController@SCANrestorant')->name('bienestar.SCANrestorant');
});
Route::prefix('/bienestar')->group(function() {
    Route::get('/SCANrutas', 'BIENESTARController@SCANrutas')->name('bienestar.SCANrutas');
});
Route::prefix('/bienestar')->group(function() {
    Route::get('/APEformulario', 'BIENESTARController@APEformulario')->name('bienestar.APEformulario');
});