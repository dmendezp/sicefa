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
Route::middleware(['lang'])->group(function () {
    Route::prefix('sg')->group(function () {
        Route::get('/index', 'SGController@index')->name('cefa.sg.index');
        Route::get('/admin/welcome', 'SGController@admin')->name('cefa.admin.welcome');
    });
});
