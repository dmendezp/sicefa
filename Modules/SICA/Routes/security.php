<?php
use Illuminate\Support\Facades\Route;
use Modules\SICA\Http\Controllers\security\AppController;
use Modules\SICA\Http\Controllers\security\RoleController;
use Modules\SICA\Http\Controllers\security\UserController;

Route::middleware(['lang'])->group(function(){

    Route::prefix('sica')->group(function() {

        // --------------  Rutas de Aplicaciones ---------------------------------
        Route::get('/admin/security/apps', [AppController::class, 'apps_index'])->name('sica.admin.security.apps.index'); /* Lista de aplicaciones disponibles (Administrador) */
        // --------------  Rutas de asociación de Aplicaciones y Unidades Productivas ---------------------------------
        Route::get('/admin/security/apps/app_pus', [AppController::class, 'app_pus_index'])->name('sica.admin.security.apps.app_pus.index'); /* Listado de aplicaciones y unidades productivas asociadas (Administrador) */
        Route::post('/admin/security/apps/app_pus/store', [AppController::class, 'app_pus_store'])->name('sica.admin.security.apps.app_pus.store'); /* Registrar asociación de aplicación y unidad productiva (Administrador) */
        Route::delete('/admin/security/apps/app_pus/destroy/{apu}', [AppController::class, 'app_pus_destroy'])->name('sica.admin.security.apps.app_pus.destroy'); /* Eliminar asociación de aplicación y unidad productiva (Administrador) */

        // --------------  Rutas de Roles ---------------------------------
        Route::get('/admin/security/roles', [RoleController::class, 'roles_index'])->name('sica.admin.security.roles.index'); /* Lista de roles disponibles (Administrador) */
        Route::get('/admin/security/roles/permission_role', [RoleController::class, 'roles_permission_role'])->name('sica.admin.security.roles.permision_role.index'); /* Lista de la asociación de roles y permisos (Administrador) */
        Route::get('/admin/security/roles/permission_role/create/{role_id}', [RoleController::class, 'roles_permission_create'])->name('sica.admin.security.roles.permision_role.create'); /* Vista de la asociación de roles y permisos (Administrador) */
        Route::post('/admin/security/roles/permission_role/store', [RoleController::class, 'roles_permission_store'])->name('sica.admin.security.roles.permision_role.store'); /* Asociación de roles y permisos (Administrador) */
        // -------------- Rutas de asociación de roles y unidades productivas ---------------------------------
        Route::get('/admin/security/roles/pu_roles', [RoleController::class, 'pu_roles_index'])->name('sica.admin.security.roles.pu_roles.index'); /* Listado de asociaciones de roles y unidades productivas (Administrador) */
        // Registrar permiso (sica.admin.security.roles.pu_roles.store); Registrar asociación de rol y unidad productiva (Administrador) <Función livewire>
        // Registrar permiso (sica.admin.security.roles.pu_roles.destroy); Eliminar asociación de rol y unidad productiva (Administrador) <Función livewire>
        // -------------- Rutas de responsibilidades (asociación de actividades y roles) ---------------------------------
        Route::get('/admin/security/roles/responsibilitities', [RoleController::class, 'responsibilities_index'])->name('sica.admin.security.roles.responsibilities.index'); /* Listado de responsabilidades disponibles (Administrador) */
        // Registrar permiso (sica.admin.security.roles.responsibilities.store); Registrar responsabilidad (Administrador) <Función livewire>
        // Registrar permiso (sica.admin.security.roles.responsibilities.destroy); Eliminar responsabilidad (Administrador) <Función livewire>

        // --------------  Rutas de Permisos ---------------------------------
        Route::get('/admin/security/permissions', [RoleController::class, 'permissions_index'])->name('sica.admin.security.permissions.index'); /* Lista de permisos disponibles (Administrador) */

        // --------------  Rutas de Usuarios ---------------------------------
        Route::get('/admin/security/users', [UserController::class, 'index'])->name('sica.admin.security.users.index');/* Listado  de usuarios disponibles (Administrador) */
        Route::get('/admin/security/users/create', [UserController::class, 'create'])->name('sica.admin.security.users.create'); /* Formulario de registro de usuario (Administrador) */
        Route::post('/admin/security/users/search/person', [UserController::class, 'search_person'])->name('sica.admin.security.users.search.person'); /* Consultar persona por número de identificación (Administrador) */
        Route::post('/admin/security/users/store', [UserController::class, 'store'])->name('sica.admin.security.users.store'); /* Registrar usuario (Administrador) */
        Route::get('/admin/security/users/edit/{user}', [UserController::class, 'edit'])->name('sica.admin.security.users.edit'); /* Formulario de actualización de usuario (Administrador) */
        Route::post('/admin/security/users/update/{user}', [UserController::class, 'update'])->name('sica.admin.security.users.update'); /* Actualizar usuario (Administrador) */
        Route::delete('/admin/security/users/destroy/{user}', [UserController::class, 'destroy'])->name('sica.admin.security.users.destroy'); /* Eliminar usuario (Administrador) */

    });

});
