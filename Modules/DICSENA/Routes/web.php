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
        Route::get('/menu', 'MenuController@index')->name('dicsena.instructor.menu');
        /*rutas de crud glosary*/
        Route::get('/glossary', 'GlossaryController@index')->name('dicsena.instructor.glossary.index');
        Route::get('/glossary/create', 'GlossaryController@create')->name('dicsena.instructor.glossary.create');
        Route::post('/glossary/store', 'GlossaryController@store')->name('dicsena.instructor.glossary.store');
        Route::get('/glossary/edit/{glossary}', 'GlossaryController@edit')->name('dicsena.instructor.glossary.edit');
        Route::delete('/glossary/destroy/{glossary}', 'GlossaryController@destroy')->name('dicsena.instructor.destroy');
        Route::put('/glossary/update/{glossary}', 'GlossaryController@update')->name('dicsena.instructor.glossary.update');
        //routes crudguide
        Route::get('gloss/search', 'GlossController@search')->name('cefa.dicsena.glossary.search');

        Route::get('/guidepost', 'GuidepostController@index')->name('dicsena.instructor.guidepost.index');
        Route::get('/guidepost/create', 'GuidepostController@create')->name('dicsena.instructor.guidepost.create');
        Route::post('/guidepost/store', 'GuidepostController@store')->name('dicsena.instructor.guidepost.store');
        Route::get('/guidepost/{id}/edit', 'GuidepostController@edit')->name('dicsena.instructor.guidepost.edit');
        Route::put('/guidepost/update/{id}', 'GuidepostController@update')->name('dicsena.instructor.guidepost.update');
        Route::delete('/guidepost/destroy/{id}', 'GuidepostController@destroy')->name('dicsena.instructor.guidepost.destroy');
    });
});
