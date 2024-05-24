<?php

Route::middleware(['lang'])->group(function(){
    Route::prefix('pqrs')->group(function() {
        Route::get('/index', 'PQRSController@index')->name('cefa.pqrs.home.index');

        Route::controller(TrackingController::class)->group(function () {
            Route::get('/tracking/index', 'index')->name('pqrs.tracking.index');
            Route::get('/tracking/searchOfficial', 'searchOfficial')->name('pqrs.tracking.searchOfficial');
            Route::get('/tracking/create', 'create')->name('pqrs.tracking.create');
            Route::post('/tracking/store', 'store')->name('pqrs.tracking.store');
        });

        Route::controller(AnswerController::class)->group(function () {
            Route::get('/official/answer/index', 'index')->name('pqrs.official.answer.index');
            Route::get('/official/answer/viewMail', 'viewMail')->name('pqrs.official.answer.viewMail');
            Route::post('/official/answer/store', 'store')->name('pqrs.official.answer.store');
            Route::get('/official/answer/searchOfficial', 'searchOfficial')->name('pqrs.official.answer.searchOfficial');
            Route::post('/official/answer/reasign', 'reasign')->name('pqrs.official.answer.reasign');
            Route::post('/official/answer/email', 'email')->name('pqrs.official.answer.email');

        });
    });
});
