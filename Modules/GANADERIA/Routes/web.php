<?php
use Illuminate\Support\Facades\Route;
use Modules\GANADERIA\Http\Controllers\GANADERIAController;


    Route::prefix('ganaderia')->group(function() {
        Route::get('/index', 'GANADERIAController@index');
    });

