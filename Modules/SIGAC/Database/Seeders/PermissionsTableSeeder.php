<?php

namespace Modules\SIGAC\Database\Seeders;

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
        // Definir arreglos de PERMISOS que van ser asignados a los ROLES
        $permissions_academic_coordination = []; // Permisos para Coordinación Académica
        $permissions_instructor = []; // Permisos para el Instructor
        $permissions_wellness = []; // Permisos para Bienestar
        $permissions_apprentice = []; // Permisos para Aprendiz

        // Consultar aplicación SICA para registrar los roles
        $app = App::where('name', 'SIGAC')->firstOrFail();


        // ===================== Registro de todos los permisos de la aplicación SIGAC ==================
        // Panel de control de coordinación académica (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.dashboard'], [ // Registro o actualización de permiso
            'name' => 'Panel de control de coordinación académica (Coordinación Académica)',
            'description' => 'Panel de control de coordinación académica',
            'description_english' => "Academic coordination control panel",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Panel de control del instructor (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.instructor.dashboard'], [ // Registro o actualización de permiso
            'name' => 'Panel de control del instructor (Instructor)',
            'description' => 'Panel de control del instructor',
            'description_english' => "Instructor's control panel",
            'app_id' => $app->id
        ]);
        $permissions_instructor[] = $permission->id; // Almacenar permiso para rol

        // Panel de control de bienestar (Bienestar)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.welness.dashboard'], [ // Registro o actualización de permiso
            'name' => 'Panel de control de bienestar (Bienestar)',
            'description' => 'Panel de control de bienestar',
            'description_english' => "Wellness control panel",
            'app_id' => $app->id
        ]);
        $permissions_wellness[] = $permission->id; // Almacenar permiso para rol

        // Panel de control de aprendiz (Aprendiz)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.apprentice.dashboard'], [ // Registro o actualización de permiso
            'name' => 'Panel de control de aprendiz (Aprendiz)',
            'description' => 'Panel de control de aprendiz',
            'description_english' => "Apprentice control panel",
            'app_id' => $app->id
        ]);
        $permissions_apprentice[] = $permission->id; // Almacenar permiso para rol

        // Programación de horarios (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.programming_schedules'], [ // Registro o actualización de permiso
            'name' => 'Programación de horarios (Coordinación Académica)',
            'description' => 'Programación de horarios',
            'description_english' => "Programming schedules",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Programación de eventos (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.event_programming'], [ // Registro o actualización de permiso
            'name' => 'Programación de eventos (Coordinación Académica)',
            'description' => 'Programación de eventos',
            'description_english' => "Event Programming",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Consulta de ROLES
        $rol_academic_coordination = Role::where('slug', 'sigac.academic_coordinator')->firstOrFail(); // Rol Coordinador Académico
        $rol_instructor = Role::where('slug', 'sigac.instructor')->firstOrFail(); // Rol Instructor
        $rol_wellness = Role::where('slug', 'sigac.wellness')->firstOrFail(); // Rol Bienestar
        $rol_apprentice = Role::where('slug', 'sigac.apprentice')->firstOrFail(); // Rol Aprendiz

        // Asignación de PERMISOS para los ROLES de la aplicación SIGAC (Sincronización de las relaciones sin eliminar las relaciones existentes)
        $rol_academic_coordination->permissions()->syncWithoutDetaching($permissions_academic_coordination);
        $rol_instructor->permissions()->syncWithoutDetaching($permissions_instructor);
        $rol_wellness->permissions()->syncWithoutDetaching($permissions_wellness);
        $rol_apprentice->permissions()->syncWithoutDetaching($permissions_apprentice);
    }
}
