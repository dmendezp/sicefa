<?php

use Illuminate\Support\Facades\Route;


Route::middleware(['lang'])->group(function(){


    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/designners', function () {
        return view('designners');
    });

    Route::get('lang/{lang}', function($lang) {
        session(['lang'=>$lang]);
        return Redirect::back();
    })->where(['lang'=>'es|en']);

    Auth::routes();

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

}); 