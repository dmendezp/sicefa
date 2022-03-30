<?php
use Illuminate\Support\Facades\Route;
use Modules\SICA\Http\Controllers\security\AppController;

Route::middleware(['lang'])->group(function(){

    Route::prefix('sica')->group(function() {

        Route::get('/admin/security/apps', [AppController::class, 'index'])->name('sica.admin.security.apps');

        Route::get('/admin/security/roles', [SecurityController::class, 'roles'])->name('sica.admin.security.roles');

        Route::get('/admin/security/users', [SecurityController::class, 'users'])->name('sica.admin.security.users');
    
    });  

}); 