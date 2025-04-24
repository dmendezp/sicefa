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
Route::middleware(['lang'])->group(function(){
    Route::prefix('lombrisoft')->group(function() {
        Route::get('/index', 'LOMBRISOFTController@index')->name('cefa.lombrisoft.index');
        Route::get('/admin/welcome', 'LOMBRISOFTController@admin')->name('lombrisoft.admin.welcome');
        Route::get('/welcome', 'LOMBRISOFTController@welcome')->name('lombrisoft.welcome');
        Route::get('/intern/paneli', 'LOMBRISOFTController@intern')->name('lombrisoft.intern.paneli');
});
});