<?php
use Illuminate\Support\Facades\Route;
use Modules\SICA\Http\Controllers\SICAController;

Route::middleware(['lang'])->group(function(){

    Route::prefix('tilabs')->group(function() {
        Route::get('/index', 'TILABSController@index')->name('cefa.tilabs.index');
        Route::get('/labs', 'TILABSController@labs')->name('cefa.tilabs.labs');
        Route::get('/inventory', 'TILABSController@inventory')->name('cefa.tilabs.inventory');
        Route::get('/developers', 'TILABSController@developers')->name('cefa.tilabs.developers');
        
        Route::prefix('admin')->group(function() {
            Route::get('/dashboard', 'TILABSController@dashboard')->name('tilabs.admin.dashboard');
            Route::get('/loan', 'TILABSController@loan')->name('tilabs.admin.loan');
            Route::get('/return', 'TILABSController@return')->name('tilabs.admin.return');
            Route::get('/transactions', 'TILABSController@transactions')->name('tilabs.admin.transactions');
        });
    });

});

