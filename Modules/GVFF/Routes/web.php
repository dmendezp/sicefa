<?php

use Illuminate\Support\Facades\Route;

<<<<<<< HEAD

Route::middleware(['lang'])->group(function(){
Route::prefix('gvff')->group(function() {
    Route::get('/index', 'GVFFController@index')->name('cefa.gvff.index');
    Route::get('/admin/welcome', 'GVFFController@admin')->name('gvff.admin.welcome');
});
});
=======
Route::prefix('gvff')->group(function() {
    Route::get('/index', 'GVFFController@index')->name('cefa.gvff.index');
});
>>>>>>> 27ad373a888877dd7dc3c1e308cdf0244659f34c
