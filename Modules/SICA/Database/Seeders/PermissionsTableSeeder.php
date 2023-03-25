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

        // Dashboard de asistencia
        $permission = Permission::updateOrCreate(['slug' => 'sica.attendance.dashboard'], [ // Registro o actualización de permiso
            'name' => 'Attendance Dashboard',
            'description' => 'Puede ver el dashboard de asistencia',
            'description_english' => 'You can see the assistance dashboard',
            'app_id' => $app->id
        ]);
        $permission_attendance[] = $permission->id; // Almacenar permiso para rol

        // Administrara datos personales
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.people.personal_data'], [ // Registro o actualización de permiso
            'name' => 'Administrar datos personales',
            'description' => 'Puede gestionar la información de las personas',
            'description_english' => "Can manage people's information",
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Asistencia a eventos (admin)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.people.events_attendance'], [ // Registro o actualización de permiso
            'name' => 'Asistencia a eventos (admin)',
            'description' => 'Registro de asistencia a eventos',
            'description_english' => 'Event attendance record',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Asistencia - Busqueda por documento (admin)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.people.basic_data.search'], [ // Registro o actualización de permiso
            'name' => 'Asistencia - Busqueda por documento (admin)',
            'description' => 'Permite buscar los datos de una persona por numero de documento para registrar su asistencia',
            'description_english' => "Allows you to search for a person's data by document number to register their attendance",
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Registrar asistencia (admin)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.people.basic_data.add'], [ // Registro o actualización de permiso
            'name' => 'Registrar asistencia (admin)',
            'description' => 'Permite registrar datos personales básicos y asistencias',
            'description_english' => 'Allows you to record basic personal data and assistance',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol

        // Asistencia a eventos
        $permission = Permission::updateOrCreate(['slug' => 'sica.attendance.people.events_attendance'], [ // Registro o actualización de permiso
            'name' => 'Asistencia a eventos',
            'description' => 'Registro de asistencia a eventos',
            'description_english' => 'Event attendance record',
            'app_id' => $app->id
        ]);
        $permission_attendance[] = $permission->id; // Almacenar permiso para rol

        // Asistencia - Busqueda por documento
        $permission = Permission::updateOrCreate(['slug' => 'sica.attendance.people.basic_data.search'], [ // Registro o actualización de permiso
            'name' => 'Asistencia - Busqueda por documento',
            'description' => 'Permite buscar los datos de una persona por numero de documento para registrar su asistencia',
            'description_english' => "Allows you to search for a person's data by document number to register their attendance",
            'app_id' => $app->id
        ]);
        $permission_attendance[] = $permission->id; // Almacenar permiso para rol

        // Registrar asistencia
        $permission = Permission::updateOrCreate(['slug' => 'sica.attendance.people.basic_data.add'], [ // Registro o actualización de permiso
            'name' => 'Registrar asistencia',
            'description' => 'Permite registrar datos personales básicos y asistencias',
            'description_english' => 'Allows you to record basic personal data and assistance',
            'app_id' => $app->id
        ]);
        $permission_attendance[] = $permission->id; // Almacenar permiso para rol

        // Búsqueda de aprendices
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.people.apprentices'], [ // Registro o actualización de permiso
            'name' => 'Búsqueda de aprendices',
            'description' => 'Puede acceder a lista de aprendices por titulación',
            'description_english' => 'You can access the list of apprentices by program',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol
        $permission_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Listar Instructores
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.people.instructors'], [ // Registro o actualización de permiso
            'name' => 'Listar Instructores',
            'description' => 'Puede acceder a lista de instructores',
            'description_english' => 'You can access the list of instructors',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol
        $permission_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Listar Funcionarios
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.people.officers'], [ // Registro o actualización de permiso
            'name' => 'Listar Funcionarios',
            'description' => 'Puede acceder a lista de funcionarios',
            'description_english' => 'You can access the list of officers',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol
        $permission_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Listar Contratistas
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.people.contractors'], [ // Registro o actualización de permiso
            'name' => 'Listar Contratistas',
            'description' => 'Puede acceder a lista de contratistas',
            'description_english' => 'You can access the list of contractors',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol
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
