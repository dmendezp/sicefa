<?php
use illuminate\Support\Facades\Route;

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
    Route::prefix('gdf')->group(function () {
        Route::get('/index', 'GDFController@index')->name('cefa.gdf.index');
        Route::get('/admin/welcome', 'GDFController@admin')->name('cefa.admin.welcome');
    });
});

