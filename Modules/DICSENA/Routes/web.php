<?php

use Illuminate\Support\Facades\Route;
use Modules\DICSENA\Http\Controllers\HomeController;
use Modules\DICSENA\Http\Controllers\GuidepostsController;
use Modules\DICSENA\Http\Controllers\GlossaryController;
use Modules\DICSENA\Http\Controllers\PostsController;
use Modules\DICSENA\Http\Controllers\GlossController;


Route::middleware(['lang'])->group(function () {
    Route::prefix('dicsena')->group(function () {
        Route::get('/', 'DICSENAController@index');
        Route::get('/index', [HomeController::class, 'index'])->name('cefa.dicsena.home.index');
        Route::get('/guide', 'GuideController@index')->name('cefa.dicsena.guide');
        Route::get('/gloss', 'GlossController@index')->name('cefa.dicsena.gloss');
        Route::get('/menu', 'MenuController@index')->name('cefa.dicsena.menu');
        /*rutas de crud glosary*/
        Route::get('/glossary', 'GlossaryController@index')->name('cefa.dicsena.glossary.index');
        Route::get('/glossary/create', 'GlossaryController@create')->name('cefa.dicsena.glossary.create');
        Route::post('/glossary/store', 'GlossaryController@store')->name('cefa.dicsena.glossary.store');
        Route::get('/glossary/edit/{glossary}', 'GlossaryController@edit')->name('cefa.dicsena.glossary.edit');
        Route::delete('/glossary/destroy/{glossary}', 'GlossaryController@destroy')->name('cefa.dicsena.destroy');
        Route::put('/glossary/update/{glossary}', 'GlossaryController@update')->name('cefa.dicsena.glossary.update');
        //routes crudguide
        Route::get('gloss/search', 'GlossController@search')->name('cefa.dicsena.glossary.search');

        Route::get('/guidepost', 'GuidepostsController@index')->name('cefa.dicsena.guidepost.index');
        Route::get('/guidepost/create', 'GuidepostsController@create')->name('cefa.dicsena.guidepost.create');
        Route::post('/guidepost/store', 'GuidepostsController@store')->name('cefa.dicsena.guidepost.store');
        Route::get('/guidepost/{id}/edit', 'GuidepostsController@edit')->name('cefa.dicsena.guidepost.edit');
        Route::put('/guidepost/update/{id}', 'GuidepostController@update')->name('cefa.dicsena.guidepost.update');
        Route::delete('/guidepost/destroy/{id}', 'GuidepostController@destroy')->name('cefa.dicsena.guidepost.destroy');
    });
});
