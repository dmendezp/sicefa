<?php

use Illuminate\Support\Facades\Route;

Route::middleware(['lang'])->group(function () {
    Route::prefix('gvff')->group(function () {
        
        Route::get('/index', 'GVFFController@index')->name('gvff.index');
        Route::get('/admin/welcome', 'GVFFController@admin')->name('gvff.admin.welcome');
        Route::get('/users', 'GVFFController@users')->name('gvff.welcome');
    });
});