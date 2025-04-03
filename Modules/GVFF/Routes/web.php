<?php

use Illuminate\Support\Facades\Route;

Route::prefix('gvff')->group(function() {
    Route::get('/index', 'GVFFController@index')->name('cefa.gvff.index');
});
