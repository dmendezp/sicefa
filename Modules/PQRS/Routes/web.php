<?php

Route::middleware(['lang'])->group(function(){
    Route::prefix('pqrs')->group(function() {
        Route::get('/index', 'PQRSController@index')->name('cefa.pqrs.home.index');
        Route::get('/developers', 'PQRSController@developers')->name('cefa.pqrs.home.developers');
        Route::get('/manual', 'PQRSController@manual')->name('cefa.pqrs.home.manual');

        Route::controller(TrackingController::class)->group(function () {
            Route::get('/tracking/type_pqrs_index', 'type_pqrs_index')->name('pqrs.tracking.type_pqrs_index');
            Route::post('/tracking/type_pqrs_store', 'type_pqrs_store')->name('pqrs.tracking.type_pqrs_store');
            Route::delete('/tracking/type_pqrs_delete/{id}', 'type_pqrs_delete')->name('pqrs.tracking.type_pqrs_delete');
            Route::get('/tracking/index', 'index')->name('pqrs.tracking.index');
            Route::post('/tracking/search', 'search')->name('pqrs.tracking.search');
            Route::get('/tracking/searchOfficial', 'searchOfficial')->name('pqrs.tracking.searchOfficial');
            Route::get('/tracking/create', 'create')->name('pqrs.tracking.create');
            Route::post('/tracking/store', 'store')->name('pqrs.tracking.store');
            Route::get('/tracking/excel', 'create_excel')->name('pqrs.tracking.excel');
            Route::post('/tracking/excel/store_excel_regional', 'store_excel_regional')->name('pqrs.tracking.excel.store_excel_regional');
            Route::post('/tracking/excel/store_excel_centro', 'store_excel_centro')->name('pqrs.tracking.excel.store_excel_centro');
            Route::post('/tracking/email', 'email')->name('pqrs.tracking.email');
            Route::post('/tracking/answer/store', 'answer_store')->name('pqrs.tracking.answer.store');
        });

        Route::controller(AnswerController::class)->group(function () {
            Route::get('/official/answer/index', 'index')->name('pqrs.official.answer.index');
            Route::post('/official/answer/store', 'store')->name('pqrs.official.answer.store');
            Route::get('/official/answer/searchOfficial', 'searchOfficial')->name('pqrs.official.answer.searchOfficial');
            Route::post('/official/answer/reasign', 'reasign')->name('pqrs.official.answer.reasign');
        });
    });
});
