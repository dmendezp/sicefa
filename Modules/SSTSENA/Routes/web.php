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

Route::prefix('SSTSENA')->group(function() {
    Route::get('/index', 'SSTSENAController@index')->name('cefa.sstsena.index');
});