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
use Modules\DICSENA\Http\Controllers\HomeController;
/*use*/
use Modules\DICSENA\Http\Controllers\GuidePostsController;
use Modules\DICSENA\Http\Controllers\GlossariesController;
use Modules\DICSENA\Http\Controllers\TranslatesController; 
Route::prefix('dicsena')->group(function() {
    Route::get('/', 'DICSENAController@index');
    Route::get('/index', [HomeController::class, 'index'])->name('cefa.dicsena.home.index');
    /*rutas de carpetas*/
    // routes/web.php
    Route::get('/guideposts', 'GuidepostsController@index')->name('cefa.dicsena.guideposts');
    Route::get('/glossaries', 'GlossariesController@index')->name('cefa.dicsena.glossaries');
    Route::get('/homeins', 'HomeinsController@index')->name('cefa.dicsena.homeins');


});
