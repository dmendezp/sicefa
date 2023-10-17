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
        $permission = Permission::updateOrCreate(['slug' => 'sigac.instructor.dashboards'], [ // Registro o actualización de permiso
            'name' => 'Panel de control del instructor (Instructor)',
            'description' => 'Panel de control del instructor',
            'description_english' => "Instructor's control panel",
            'app_id' => $app->id
        ]);
        $permissions_instructor[] = $permission->id; // Almacenar permiso para rol

        // Panel de control de bienestar (Bienestar)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.wellness.dashboard'], [ // Registro o actualización de permiso
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
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.programming_schedules.index'], [ // Registro o actualización de permiso
            'name' => 'Programación de horarios (Coordinación Académica)',
            'description' => 'Programación de horarios',
            'description_english' => "Programming schedules",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Programación de eventos (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.event_programming.index'], [ // Registro o actualización de permiso
            'name' => 'Programación de eventos (Coordinación Académica)',
            'description' => 'Programación de eventos',
            'description_english' => "Event Programming",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol
        
        // Visualización de horario asignado a instructor (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.instructor.schedule_instructor.index'], [ // Registro o actualización de permiso
            'name' => 'Visualización de horario asignado a instructor (Instructor)',
            'description' => 'Visualización de horario asignado a instructor',
            'description_english' => "Display of instructor's assigned schedule",
            'app_id' => $app->id
        ]);
        $permissions_instructor[] = $permission->id; // Almacenar permiso para rol

        // Visualización de horario asignado a titulada (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.instructor.schedule_titled.index'], [ // Registro o actualización de permiso
            'name' => 'Visualización de horario asignado a titulada (Instructor)',
            'description' => 'Visualización de horario asignado a titulada',
            'description_english' => "Display of timetable assigned to a titled person",
            'app_id' => $app->id
        ]);
        $permissions_instructor[] = $permission->id; // Almacenar permiso para rol

        // Visualización de horario asignado al aprendiz (Aprendiz)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.apprentice.schedule_apprentice.index'], [ // Registro o actualización de permiso
            'name' => 'Visualización de horario asignado al aprendiz (Aprendiz)',
            'description' => 'Visualización de horario asignado al aprendiz',
            'description_english' => "Display of trainee's assigned schedule",
            'app_id' => $app->id
        ]);
        $permissions_apprentice[] = $permission->id; // Almacenar permiso para rol

        // Consultar excusas de aprendiz (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.instructor.attendance.excuses'], [ // Registro o actualización de permiso
            'name' => 'Consultar excusas de aprendiz (Instructor)',
            'description' => 'Consultar excusas de aprendiz',
            'description_english' => "Consult apprentice excuses",
            'app_id' => $app->id
        ]);
        $permissions_instructor[] = $permission->id; // Almacenar permiso para rol

        // Consultar asistencia por aprendiz o tituladas (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.instructor.attendance.consult'], [ // Registro o actualización de permiso
            'name' => 'Consultar asistencia por aprendiz o tituladas (Instructor)',
            'description' => 'Consultar asistencia por aprendiz o tituladas',
            'description_english' => "Consult assistance for apprentices or titled",
            'app_id' => $app->id
        ]);
        $permissions_instructor[] = $permission->id; // Almacenar permiso para rol

        // Registrar asistencia de aprendiz por titulada (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.instructor.attendance.register'], [ // Registro o actualización de permiso
            'name' => 'Registrar asistencia de aprendiz por titulada (Instructor)',
            'description' => 'Registrar asistencia de aprendiz por titulada',
            'description_english' => "Register apprentice attendance by titled",
            'app_id' => $app->id
        ]);
        $permissions_instructor[] = $permission->id; // Almacenar permiso para rol

        // Consultar asistencia por aprendiz o tituladas (Bienestar)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.wellness.attendance.consult'], [ // Registro o actualización de permiso
            'name' => 'Consultar asistencia por aprendiz o tituladas (Bienestar)',
            'description' => 'Consultar asistencia por aprendiz o tituladas',
            'description_english' => "Register apprentice attendance by titled",
            'app_id' => $app->id
        ]);
        $permissions_wellness[] = $permission->id; // Almacenar permiso para rol

        // Vista principal de la sección de reportes de asistencia (Coordinación Académica) 
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.reports.attendance.index'], [ // Registro o actualización de permiso
            'name' => 'Vista principal de la sección de reportes de asistencia (Coordinación Académica)',
            'description' => 'Vista principal de la sección de reportes de asistencia',
            'description_english' => "Main view of the attendance report section",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Vista principal de la sección de reportes de asistencia (Instructor) 
        $permission = Permission::updateOrCreate(['slug' => 'sigac.instructor.reports.attendance.index'], [ // Registro o actualización de permiso
            'name' => 'Vista principal de la sección de reportes de asistencia (Instructor)',
            'description' => 'Vista principal de la sección de reportes de asistencia',
            'description_english' => "Main view of the attendance report section",
            'app_id' => $app->id
        ]);
        $permissions_instructor[] = $permission->id; // Almacenar permiso para rol

        // Vista principal de la sección de reportes de asistencia (Bienestar) 
        $permission = Permission::updateOrCreate(['slug' => 'sigac.wellness.reports.attendance.index'], [ // Registro o actualización de permiso
            'name' => 'Vista principal de la sección de reportes de asistencia (Bienestar)',
            'description' => 'Vista principal de la sección de reportes de asistencia',
            'description_english' => "Main view of the attendance report section",
            'app_id' => $app->id
        ]);
        $permissions_wellness[] = $permission->id; // Almacenar permiso para rol

        // Enviar excusa para justificación de inasistencia (Aprendiz)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.apprentice.excuses.send'], [ // Registro o actualización de permiso
            'name' => 'Enviar excusa para justificación de inasistencia (Aprendiz)',
            'description' => 'Enviar excusa para justificación de inasistencia',
            'description_english' => "Send excuse for non-attendance",
            'app_id' => $app->id
        ]);
        $permissions_apprentice[] = $permission->id; // Almacenar permiso para rol

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
