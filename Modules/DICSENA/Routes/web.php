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
/*FORM*/
use Modules\DICSENA\Http\Controllers\FgloController;
use Modules\DICSENA\Http\Controllers\FguiController; 
use Modules\DICSENA\Http\Controllers\VguiController;
use Modules\DICSENA\Http\Controllers\VgloController;
Route::prefix('dicsena')->group(function() {
    Route::get('/', 'DICSENAController@index');
    Route::get('/index', [HomeController::class, 'index'])->name('cefa.dicsena.home.index');
    /*rutas de carpetas*/
    // routes/web.php
    Route::get('/guideposts', 'GuidepostsController@index')->name('cefa.dicsena.guideposts');
    Route::get('/glossaries', 'GlossariesController@index')->name('cefa.dicsena.glossaries');
    Route::get('/homeins', 'HomeinsController@index')->name('cefa.dicsena.homeins');
    /* rutas de formularios y vistas de instructor*/ 
    Route::get('/formglo', 'FgloController@index')->name('cefa.dicsena.glosary.formglo');
    Route::get('/vistaglo','VgloController@index')->name('cefa.dicsena.glosary.vistaglo');
    Route::get('/formgui', 'FguiController@index')->name('cefa.dicsena.guide.formgui');
    Route::get('/vistagui','VguiController@index')->name('cefa.dicsena.guide.vistagui');

});
