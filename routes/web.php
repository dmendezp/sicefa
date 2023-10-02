<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;


Route::middleware(['lang'])->group(function(){

    Auth::routes();
    //Auth::routes(["register" => false]);

    Route::get('lang/{lang}', function($lang) {
        session(['lang'=>$lang]);
        return Redirect::back();
    })->where(['lang'=>'es|en']);

    Route::get('/', [HomeController::class, 'welcome'])->name('cefa.welcome');
    Route::get('/developers', [HomeController::class, 'developers'])->name('cefa.developers');
    Route::get('/home', [HomeController::class, 'index'])->name('cefa.home');

    Route::prefix('filemanager')->group(function() {
     \UniSharp\LaravelFilemanager\Lfm::routes();
 });

});

