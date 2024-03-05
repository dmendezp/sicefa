<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Modules\SICA\Http\Controllers\security\UserController;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

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

    // --------------  Ruta Cambio de Contraseña ---------------------------------
    Route::get('/password/change/index', [UserController::class, 'change'])->name('password.change.index'); /* Vista Cambio de Contraseña */
    Route::post('/password/change/', [UserController::class, 'changesave'])->name('password.change'); /* Cambio de Contraseña */


    Route::get('/login_google', function () {
        return Socialite::driver('google')->redirect();
    });
     
    Route::get('/auth/callback', function () {
        $user = Socialite::driver('google')->user();
     
        // $user->token
    });

    Route::prefix('filemanager')->group(function() {
     \UniSharp\LaravelFilemanager\Lfm::routes();
 });

});

