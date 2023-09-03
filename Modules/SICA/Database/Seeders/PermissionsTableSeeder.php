<?php

namespace Modules\SICA\Database\Seeders;

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
        $permission_admin = []; // Permisos para Administrador
        $permission_coordinator = []; // Permisos para Coordinador
        $permission_attendance = []; // Permisos para Registro Asistencia


        // Consultar aplicación SICA para registrar los roles
        $app = App::where('name','SICA')->first();



        // ===================== Registro de todos los permisos de la aplicación SICA ==================
        // Dashboard de administrador
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.dashboard'], [ // Registro o actualización de permiso
            'name' => 'Admin Dashboard',
            'description' => 'Puede ver el dashboard de administrador',
            'description_english' => 'You can see the admin dashboard',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol
        $permission_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Panel de control de asistencias a eventos (Asistencia)
        $permission = Permission::updateOrCreate(['slug' => 'sica.attendance.dashboard'], [ // Registro o actualización de permiso
            'name' => 'Panel de control de asistencias a eventos (Asistencia)',
            'description' => 'Panel de control de asistencias a eventos',
            'description_english' => 'Event attendance control panel',
            'app_id' => $app->id
        ]);
        $permission_attendance[] = $permission->id; // Almacenar permiso para rol

        // Vista principal de datos personales
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.people.personal_data.index'], [ // Registro o actualización de permiso
            'name' => 'Vista principal de datos personales (Administrador)',
            'description' => 'Vista principal de datos personales',
            'description_english' => 'Main view of personal data',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Panel de control de asistencias de eventos (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.people.events_attendance.dashboard'], [ // Registro o actualización de permiso
            'name' => 'Panel de control de asistencias de eventos (Administrador)',
            'description' => 'Panel de control de asistenciaa de eventos',
            'description_english' => 'Events attendance control panel',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Formulario de registro de asistencia a eventos (Asistencia)
        $permission = Permission::updateOrCreate(['slug' => 'sica.attendance.people.events_attendance.index'], [ // Registro o actualización de permiso
            'name' => 'Formulario de registro de asistencia a eventos (Asistencia)',
            'description' => 'Formulario de registro de asistencia a eventos',
            'description_english' => 'Event attendance registration form',
            'app_id' => $app->id
        ]);
        $permission_attendance[] = $permission->id; // Almacenar permiso para rol

        // Buscar o registrar datos básicos de persona para registrar asistencia a evento (Asistencia)
        $permission = Permission::updateOrCreate(['slug' => 'sica.attendance.people.basic_data.search'], [ // Registro o actualización de permiso
            'name' => 'Buscar o registrar datos básicos de persona para registrar asistencia a evento (Asistencia)',
            'description' => 'Permite buscar los datos de una persona por número de documento para registrar su asistencia',
            'description_english' => "Allows you to search for a person's data by document number to register their attendance",
            'app_id' => $app->id
        ]);
        $permission_attendance[] = $permission->id; // Almacenar permiso para rol

        // Registrar datos básicos de personas y asistencia a evento (Asistencia)
        $permission = Permission::updateOrCreate(['slug' => 'sica.attendance.people.basic_data.store'], [ // Registro o actualización de permiso
            'name' => 'Registrar datos básicos de personas y asistencia a evento (Asistencia)',
            'description' => 'Permite registrar datos personales básicos y asistencia a evento',
            'description_english' => 'Allows you to record basic personal data and event assistance',
            'app_id' => $app->id
        ]);
        $permission_attendance[] = $permission->id; // Almacenar permiso para rol

        // BVista principal para consultar aprendices por titulación (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.people.apprentices.index'], [ // Registro o actualización de permiso
            'name' => 'Vista principal para consultar aprendices por titulación (Administrador)',
            'description' => 'Puede acceder a lista de aprendices por titulación',
            'description_english' => 'You can access the list of apprentices by program',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista principal de instructores (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.people.instructors.index'], [ // Registro o actualización de permiso
            'name' => 'Vista principal de instructores (Administrador)',
            'description' => 'Puede acceder a lista de instructores',
            'description_english' => 'You can access the list of instructors',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista principal de instructores (Coordinador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.coordinator.people.instructors.index'], [ // Registro o actualización de permiso
            'name' => 'Vista principal de instructores (Administrador)',
            'description' => 'Puede acceder a lista de instructores',
            'description_english' => 'You can access the list of instructors',
            'app_id' => $app->id
        ]);
        $permission_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Vista principal de funcionarios (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.people.employees.index'], [ // Registro o actualización de permiso
            'name' => 'Vista principal de funcionarios (Administrador)',
            'description' => 'Puede acceder a lista de funcionarios',
            'description_english' => 'You can access the list of officers',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista principal de funcionarios (Coordinador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.coordinator.people.employees.index'], [ // Registro o actualización de permiso
            'name' => 'Vista principal de funcionarios (Coordinador)',
            'description' => 'Puede acceder a lista de funcionarios',
            'description_english' => 'You can access the list of officers',
            'app_id' => $app->id
        ]);
        $permission_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Vista principal de contratistas (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.people.contractors.index'], [ // Registro o actualización de permiso
            'name' => 'Vista principal de contratistas (Administrador)',
            'description' => 'Puede acceder a lista de contratistas',
            'description_english' => 'You can access the list of contractors',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista principal de contratistas (Coordinador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.coordinator.people.contractors.index'], [ // Registro o actualización de permiso
            'name' => 'Vista principal de contratistas (Coordinador)',
            'description' => 'Puede acceder a lista de contratistas',
            'description_english' => 'You can access the list of contractors',
            'app_id' => $app->id
        ]);
        $permission_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Listar Trimestres
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.academy.quarters'], [ // Registro o actualización de permiso
            'name' => 'Listar Trimestres',
            'description' => 'Puede acceder a lista de trimestres académicos',
            'description_english' => 'You can access the list of academic quarters',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol
        $permission_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Listar Programas
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.academy.curriculums'], [ // Registro o actualización de permiso
            'name' => 'Listar Programas',
            'description' => 'Puede acceder a lista de Programas de formación',
            'description_english' => 'You can access the list of training programs',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol
        $permission_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Listar Cursos
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.academy.courses'], [ // Registro o actualización de permiso
            'name' => 'Listar Cursos',
            'description' => 'Puede acceder a lista de Titulaciones',
            'description_english' => 'You can access the list of Programs',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol
        $permission_coordinator[] = $permission->id; // Almacenar permiso para rol



        // Consulta de ROLES
        $rol_admin = Role::where('slug', 'sica.admin')->first(); // Rol Administrador
        $rol_coordinator = Role::where('slug', 'sica.coordinator')->first(); // Rol Coordinado Académico
        $rol_attendance = Role::where('slug', 'sica.attendance')->first(); // Rol Registro Asistencia

        // Asignación de PERMISOS para los ROLES de la aplicación SICA (Sincronización de las relaciones sin eliminar las relaciones existentes)
        $rol_admin->permissions()-> syncWithoutDetaching($permission_admin);
        $rol_coordinator->permissions()->syncWithoutDetaching($permission_coordinator);
        $rol_attendance->permissions()->syncWithoutDetaching($permission_attendance);

    }
}
