<?php

namespace Modules\SIA\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Permission;
use Modules\SICA\Entities\Role;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Definir arreglos de PERMISOS que van a ser asignados a los ROLES
        $permissions_admin = []; // Permisos para Administrador
        $permissions_instructor = []; // Permisos para Instructor Investigador
        $permissions_apprentice = []; // Permisos para Aprendiz Investigador

        // Consultar aplicación SICA para registrar los permisos
        $app = App::where('name', 'SIA')->first();

        // ===================== Registro de todos los permisos de la aplicación SIA ==================

        // Vista principal del administrador
        $permission = Permission::updateOrCreate(['slug' => 'sia.admin.index'], [
            'name' => 'Vista principal del administrador',
            'description' => 'Puede ver la vista principal del administrador',
            'description_english' => 'You can see the main view of the administrator',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;

        // Vista principal del instructor investigador
        $permission = Permission::updateOrCreate(['slug' => 'sia.instructor.index'], [
            'name' => 'Vista principal del instructor investigador',
            'description' => 'Puede ver la vista principal del instructor investigador',
            'description_english' => 'You can see the main view of the instructor investigator',
            'app_id' => $app->id
        ]);
        $permissions_instructor[] = $permission->id;

        // Vista principal del aprendiz investigador
        $permission = Permission::updateOrCreate(['slug' => 'sia.apprentice.index'], [
            'name' => 'Vista principal del aprendiz investigador',
            'description' => 'Puede ver la vista principal del aprendiz investigador',
            'description_english' => 'You can see the main view of the apprentice investigator',
            'app_id' => $app->id
        ]);
        $permissions_apprentice[] = $permission->id;

    // Permiso para gestionar todos los proyectos (Administrador)
    $permission = Permission::updateOrCreate(['slug' => 'sia.projects.manage_all'], [
        'name' => 'Gestionar todos los proyectos',
        'description' => 'Puede gestionar todos los proyectos creados por el administrador e instructor',
        'description_english' => 'Can manage all projects created by administrator and instructor',
        'app_id' => $app->id
    ]);
    $permissions_admin[] = $permission->id;
   
        // Permiso para gestionar proyectos (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'sia.projects.manage'], [
            'name' => 'Gestionar proyectos',
            'description' => 'Puede gestionar proyectos de investigación',
            'description_english' => 'You can manage research projects',
            'app_id' => $app->id
        ]);
        $permissions_instructor[] = $permission->id;

        // Permiso para ver proyectos (Todos los roles)
        $permission = Permission::updateOrCreate(['slug' => 'sia.projects.view'], [
            'name' => 'Ver proyectos',
            'description' => 'Puede ver los proyectos de investigación',
            'description_english' => 'You can view research projects',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;
        $permissions_instructor[] = $permission->id;
        $permissions_apprentice[] = $permission->id;

        // Permiso para gestionar usuarios (Solo Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sia.users.manage'], [
            'name' => 'Gestionar usuarios',
            'description' => 'Puede gestionar usuarios del sistema',
            'description_english' => 'You can manage system users',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;

        // Permiso para editar su propio perfil (Todos los roles)
        $permission = Permission::updateOrCreate(['slug' => 'sia.profile.edit'], [
            'name' => 'Editar su propio perfil',
            'description' => 'Puede editar su propio perfil de usuario',
            'description_english' => 'Can edit their own user profile',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;
        $permissions_instructor[] = $permission->id;
        $permissions_apprentice[] = $permission->id;

        // Permiso para eliminar su propio perfil (Todos los roles)
        $permission = Permission::updateOrCreate(['slug' => 'sia.profile.delete'], [
            'name' => 'Eliminar su propio perfil',
            'description' => 'Puede eliminar su propio perfil de usuario',
            'description_english' => 'Can delete their own user profile',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;
        $permissions_instructor[] = $permission->id;
        $permissions_apprentice[] = $permission->id;

        // Permiso para gestionar todas las publicaciones (Solo Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sia.posts.manage'], [
            'name' => 'Gestionar todas las publicaciones',
            'description' => 'Puede crear, editar y eliminar todas las publicaciones',
            'description_english' => 'Can create, edit and delete all posts',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;

        // Permiso para gestionar sus propias publicaciones (Administrador, Instructor e Aprendiz)
        $permission = Permission::updateOrCreate(['slug' => 'sia.posts.crud'], [
            'name' => 'Crear, editar y eliminar publicaciones',
            'description' => 'Puede crear, editar y eliminar sus propias publicaciones',
            'description_english' => 'Can create, edit and delete their own posts',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;
        $permissions_instructor[] = $permission->id;
        $permissions_apprentice[] = $permission->id;

        // Permiso para gestionar eventos (Administrador e Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'sia.events.crud'], [
            'name' => 'Crear, editar y eliminar eventos',
            'description' => 'Puede crear, editar y eliminar eventos',
            'description_english' => 'Can create, edit and delete events',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;
        $permissions_instructor[] = $permission->id;

        // Permiso para gestionar alianzas (Solo Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sia.alliances.crud'], [
            'name' => 'Crear, editar y eliminar alianzas',
            'description' => 'Puede crear, editar y eliminar alianzas',
            'description_english' => 'Can create, edit and delete alliances',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;

        // Permiso para gestionar grupos de semilleros (Solo Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sia.groups.manage'], [
            'name' => 'Gestionar grupos de semilleros',
            'description' => 'Puede crear, editar y eliminar grupos de semilleros',
            'description_english' => 'Can create, edit and delete seedbed groups',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;

        // Permiso para ver grupos de semilleros (Todos los roles y público)
        $permission = Permission::updateOrCreate(['slug' => 'sia.groups.view'], [
            'name' => 'Ver grupos de semilleros',
            'description' => 'Puede ver los grupos de semilleros en la página pública y privada',
            'description_english' => 'Can view seedbed groups on public and private pages',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;
        $permissions_instructor[] = $permission->id;
        $permissions_apprentice[] = $permission->id;

        

        // ===================== Asignación de permisos a los roles =====================

        // Consulta de roles
        $rol_admin = Role::where('slug', 'sia.admin')->first(); // Rol Administrador
        $rol_instructor = Role::where('slug', 'sia.inst-inv')->first(); // Rol Instructor Investigador
        $rol_apprentice = Role::where('slug', 'sia.ap-inv')->first(); // Rol Aprendiz Investigador

        // Asignación de permisos a los roles (Sincronización de las relaciones sin eliminar las existentes)
        $rol_admin->permissions()->syncWithoutDetaching($permissions_admin);
        $rol_instructor->permissions()->syncWithoutDetaching($permissions_instructor);
        $rol_apprentice->permissions()->syncWithoutDetaching($permissions_apprentice);
        }
}