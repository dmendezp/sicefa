<?php



Route::middleware(['lang'])->group(function(){
    Route::prefix('toolhub')->group(function() {
        Route::get('/index', 'ToolhubController@index')->name('cefa.toolhub.index');
        Route::get('/admin/welcome', 'ToolhubController@admin')->name('toolhub.admin.welcome');
        
    });
});