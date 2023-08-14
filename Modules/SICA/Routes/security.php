<?php
use Illuminate\Support\Facades\Route;
use Modules\SICA\Http\Controllers\security\AppController;
use Modules\SICA\Http\Controllers\security\RoleController;
use Modules\SICA\Http\Controllers\security\UserController;

Route::middleware(['lang'])->group(function(){

    Route::prefix('sica')->group(function() {

        // --------------  Rutas de Aplicaciones ---------------------------------
        Route::get('/admin/security/apps', [AppController::class, 'apps_index'])->name('sica.admin.security.apps.index'); /* Lista de aplicaciones disponibles (Administrador) */

        // --------------  Rutas de Roles ---------------------------------
        Route::get('/admin/security/roles', [RoleController::class, 'roles_index'])->name('sica.admin.security.roles.index'); /* Lista de roles disponibles (Administrador) */

        // --------------  Rutas de Permisos ---------------------------------
        Route::get('/admin/security/permissions', [RoleController::class, 'permissions_index'])->name('sica.admin.security.permissions.index'); /* Lista de permisos disponibles (Administrador) */

        Route::get('/admin/security/responsibilities', [RoleController::class, 'responsibilities'])->name('sica.admin.security.responsibilities');

        Route::get('/admin/security/users', [UserController::class, 'users'])->name('sica.admin.security.users');
        Route::get('/admin/security/user/add', [UserController::class, 'getUserAdd'])->name('sica.admin.security.users.add');
        Route::post('/admin/security/user/search', [UserController::class, 'postUserSearch'])->name('sica.admin.security.user.search');
        Route::post('/admin/security/user/add', [UserController::class, 'postUserAdd'])->name('sica.admin.security.user.add');
    });

});
