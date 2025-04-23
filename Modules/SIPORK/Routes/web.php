<?php
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware(['lang'])->group(function () {
    Route::prefix('sipork')->group(function () {
        Route::get('/index', 'SIPORKController@index')->name('cefa.sipork.index');
        Route::get('/admin/welcome', 'SIPORKController@admin')->name('sipork.admin.welcome');
        Route::get('/modules', 'SIPORKController@modules')->name('sipork.modules');

        Route::get('/liderDeUnidad/panelLider', 'SIPORKController@liderDeUnidad')->name('sipork.liderDeUnidad.panelLider');
        Route::get('/aprendiz/panelAprendiz', 'SIPORKController@aprendiz')->name('sipork.aprendiz.panelAprendiz');
        
        });
    
    });

// rutas para las funciones de los cerdos
Route::middleware(['auth'])->group(function () {
        Route::prefix('sipork')->group(function () {
            Route::get('/pigs', 'PigController@index')->name('sipork.admin.sipork.pigs.index');
            Route::get('/pigs/create', 'PigController@create')->name('sipork.admin.sipork.pigs.create');
            Route::get('/pigs/{id}/edit', 'PigController@edit')->name('sipork.pigs.edit');
            Route::get('/pigs/{id}', 'PigController@show')->name('sipork.pigs.show');
            Route::post('/pigs/store', 'PigController@store')->name('sipork.pigs.store');
            Route::put('/pigs/{id}', 'PigController@update')->name('sipork.pigs.update');
            Route::delete('/pigs/{id}', 'PigController@destroy')->name('sipork.pigs.destroy');
            Route::get('/set-language/{locale}', 'LanguageController@setLanguage')->name('sipork.setLanguage');
            
        });
    });
