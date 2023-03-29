<?php
use Illuminate\Support\Facades\Route;
use Modules\GANADERIA\Http\Controllers\security\SecurityController;
use Modules\GANADERIA\Http\Controllers\security\UserController;

Route::middleware(['lang'])->group(function(){

    Route::prefix('ganaderia')->group(function() {

        Route::get('/admin/security/apps', [SecurityController::class, 'apps'])->name('ganaderia.admin.security.apps');

        Route::get('/admin/security/roles', [SecurityController::class, 'roles'])->name('ganaderia.admin.security.roles');
        Route::get('/admin/security/permissions', [SecurityController::class, 'permissions'])->name('ganaderia.admin.security.permissions');
        Route::get('/admin/security/responsibilities', [SecurityController::class, 'responsibilities'])->name('ganaderia.admin.security.responsibilities');

        Route::get('/admin/security/users', [SecurityController::class, 'users'])->name('ganaderia.admin.security.users');
        Route::get('/admin/security/user/add', [UserController::class, 'getUserAdd'])->name('ganaderia.admin.security.users.add');
        Route::post('/admin/security/user/search', [UserController::class, 'postUserSearch'])->name('ganaderia.admin.security.user.search');
        Route::post('/admin/security/user/add', [UserController::class, 'postUserAdd'])->name('ganaderia.admin.security.user.add');
    });  

}); 