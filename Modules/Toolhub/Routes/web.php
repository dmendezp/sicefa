<?php



Route::middleware(['lang'])->group(function(){
    Route::prefix('toolhub')->group(function() {
        Route::get('/index', 'ToolhubController@index')->name('cefa.toolhub.index');
        Route::get('/admin/welcome', 'ToolhubController@admin')->name('toolhub.admin.welcome');


        //rol superadmin
        Route::get('/index', 'ToolhubController@index')->name('cefa.toolhub.index');
        Route::get('/superadmin/welcomesuper', 'ToolhubController@superadmin')->name('toolhub.superadmin.welcomesuper');
        
    });

    Route::controller(ToolController::class)->group(function () {
        Route::get('/admin/admin/indextools', 'index')->name('toolhub.admin.admin.indextools');
        Route::post('/admin/admin/indextools', 'store')->name('toolhub.admin.admin.store');
        Route::put('/admin/admin/indextools/{id}', 'update')->name('toolhub.admin.admin.update');
        Route::delete('/admin/admin/indextools/{id}', 'destroy')->name('toolhub.admin.admin.destroy');

        
    }
    );
});