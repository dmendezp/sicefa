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
use Illuminate\Support\Facades\Route;

Route::middleware(['lang'])->group(function(){
    Route::prefix('senaapicola')->group(function () {
        Route::get('/index', 'SENAAPICOLAController@index')->name('cefa.senaapicola.index');
        Route::get('/admin/welcome', 'SENAAPICOLAController@admin')->name('senaapicola.admin.welcome');
        Route::get('/intern/welcome', 'SENAAPICOLAController@intern')->name('senaapicola.intern.panelpas');

});
});
