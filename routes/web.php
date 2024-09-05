<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Modules\SICA\Http\Controllers\security\UserController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Laravel\Socialite\Facades\Socialite;

Route::post('/register/usergoogle/', [UserController::class, 'storer_usergoogle'])->name('register.usergoogle'); /* Registrar usuarion por google */

Route::get('/user/register/', [UserController::class, 'user_register'])->name('cefa.user.register.index');
Route::get('/user/register/searchperson', [UserController::class, 'user_search_person'])->name('cefa.user.register.searchperson');
Route::post('/user/register/store', [UserController::class, 'user_register_store'])->name('cefa.user.register.store');

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
    Route::get('/password/change/index', [UserController::class, 'change'])->name('cefa.password.change.index'); /* Vista Cambio de Contraseña */
    Route::post('/password/change/', [UserController::class, 'changesave'])->name('cefa.password.change'); /* Cambio de Contraseña */


    Route::get('/login_google', function () {
        return Socialite::driver('google')->redirect();
    })->name('logingoogle');
     
    Route::get('/google-callback', function () {
        $user = Socialite::driver('google')->user();
        $userexist = User::where('email',$user->email)->first();
            if ($userexist) {
                Auth::login($userexist);
                $message = ['message'=>'Usuario logueado', 'typealert'=>'success'];
                return redirect(route('cefa.home'));
            } else {
                $data=['user'=>$user];
                return view('auth.logingoogle',$data);
            }
    });

    Route::prefix('filemanager')->group(function() {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });

    Route::get('/check-session', function () {
        if (auth()->check()) {
            return response()->json(['status' => 'active'], 200);
        }
    
        return response()->json(['status' => 'inactive'], 403);
    });
    

});

