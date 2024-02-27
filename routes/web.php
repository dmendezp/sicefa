<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

/* To fingerprint */
use App\Http\Controllers\DpfpApi\UserRestApiController;
use App\Http\Controllers\DpfpApi\TempFingerprintController;


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

    // Ruta Home del paquete finger print
    Route::get('/home_dpfp', function () {
        return view('dpfp_views/home_dpfp');
    });
    //Rutas para interactuar con el plugin
    Route::get('/users/verify-users', [UserRestApiController::class, 'verify_users'])->name('verify-users');
    Route::get('/users', [UserRestApiController::class, 'users_list'])->name('users_list');
    Route::get("/users/{person}/finger-list", [UserRestApiController::class, "fingerList"])->name("finger-list");
    Route::post('/active_sensor_read', [TempFingerprintController::class, 'store_read']);
    Route::post('/active_sensor_enroll', [TempFingerprintController::class, 'store_enroll']);
    Route::get("/get-finger/{person}", [UserRestApiController::class, "get_finger"])->name("get_finger");
    ///
    Route::post('/document/search', [UserRestApiController::class, 'document_search'])->name('document_search');


});

