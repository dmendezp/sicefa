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

        // Permiso para gestionar proyectos (Administrador e Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'sia.projects.manage'], [
            'name' => 'Gestionar proyectos',
            'description' => 'Puede gestionar proyectos de investigación',
            'description_english' => 'You can manage research projects',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;
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