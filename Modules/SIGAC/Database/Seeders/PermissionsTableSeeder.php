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

        //  ---------------------------- ROL COORDINADOR ACADEMICO --------------------------------------

        // Panel de control de coordinación académica (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.dashboard'], [ // Registro o actualización de permiso
            'name' => 'Panel de control de coordinación académica (Coordinación Académica)',
            'description' => 'Panel de control de coordinación académica',
            'description_english' => "Academic coordination control panel",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        //  ----------------------------------- ROL INSTRUCTOR ------------------------------------------

        // Panel de control del instructor (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.instructor.dashboard'], [ // Registro o actualización de permiso
            'name' => 'Panel de control del instructor (Instructor)',
            'description' => 'Panel de control del instructor',
            'description_english' => "Instructor's control panel",
            'app_id' => $app->id
        ]);
        $permissions_instructor[] = $permission->id; // Almacenar permiso para rol

        // Programación de horarios (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.programming.index'], [ // Registro o actualización de permiso
            'name' => 'Programación de horarios (Coordinación Académica)',
            'description' => 'Programación de horarios',
            'description_english' => "Programming schedules",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Vista Parametros (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.programming.parameters.index'], [ // Registro o actualización de permiso
            'name' => 'Vista Parametros (Coordinación Académica)',
            'description' => 'Acceder a la vista de parametros',
            'description_english' => "Access the parameters view",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // PROGRAMAS

        // Consutar programas de formación (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.programming.programs.search'], [ // Registro o actualización de permiso
            'name' => 'Consultar programas (Coordinación Académica)',
            'description' => 'Consultar los programas de formación',
            'description_english' => "Consult training programs",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Vista carge programas (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.programming.programs.load.create'], [ // Registro o actualización de permiso
            'name' => 'Vista carge de programas (Coordinación Académica)',
            'description' => 'Acceder a la vista para cargar los programas',
            'description_english' => "Access the view to load programs",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Registrar programas cargados (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.programming.programs.load.store'], [ // Registro o actualización de permiso
            'name' => 'Registrar programas cargados (Coordinación Académica)',
            'description' => 'Realizar el registro de los programas cargados',
            'description_english' => "Register loaded programs",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol
        
        // Exportar programas y cursos (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.programming.programs.export'], [ // Registro o actualización de permiso
            'name' => 'Exportar programas y cursos (Coordinación Académica)',
            'description' => 'Exportar programas y cursos',
            'description_english' => "Export programs and courses",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // COMPETENCIAS

        // Vista Competencias del programa (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.programming.competence.index'], [ // Registro o actualización de permiso
            'name' => 'Vista Competencias del programa (Coordinación Académica)',
            'description' => 'Acceder a las competencias del programa',
            'description_english' => "Access the program competencies",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Registrar competencia (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.programming.competence.store'], [ // Registro o actualización de permiso
            'name' => 'Registrar competencia (Coordinación Académica)',
            'description' => 'Realizar el registro de la competencia',
            'description_english' => "Register the competition",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Actualizar competencia (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.programming.competence.update'], [ // Registro o actualización de permiso
            'name' => 'Actualizar competencia (Coordinación Académica)',
            'description' => 'Realizar la actualización de la competencia',
            'description_english' => "Perform competency update",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Eliminar competencia (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.programming.competence.destroy'], [ // Registro o actualización de permiso
            'name' => 'Eliminar competencia (Coordinación Académica)',
            'description' => 'Eliminar la competencia',
            'description_english' => "Eliminate the competition",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // RESULTADO DE APRENDIZAJE

        // Vista resultados de aprendizaje de la competencia (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.programming.learning_outcome.index'], [ // Registro o actualización de permiso
            'name' => 'Vista resultados de aprendizaje de la competencia (Coordinación Académica)',
            'description' => 'Acceder a los resultados de aprendizaje de la competencia',
            'description_english' => "Access competition learning outcomes",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Registrar resultado de aprendizaje (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.programming.learning_outcome.store'], [ // Registro o actualización de permiso
            'name' => 'Registrar resultado de aprendizaje (Coordinación Académica)',
            'description' => 'Realizar el registro del resultado de aprendizaje',
            'description_english' => "Record the learning outcome",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Actualizar resultado de aprendizaje (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.programming.learning_outcome.update'], [ // Registro o actualización de permiso
            'name' => 'Actualizar resultado de aprendizaje (Coordinación Académica)',
            'description' => 'Realizar la actualización del resultado de aprendizaje',
            'description_english' => "Perform learning outcome update",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Eliminar resultado de aprendizaje (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.programming.learning_outcome.destroy'], [ // Registro o actualización de permiso
            'name' => 'Eliminar resultado de aprendizaje (Coordinación Académica)',
            'description' => 'Eliminar el resultado de aprendizaje',
            'description_english' => "Delete the learning outcome",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Vista carge de resultado de aprendizaje (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.programming.learning_outcome.load.create'], [ // Registro o actualización de permiso
            'name' => 'Vista carge de resultado de aprendizaje (Coordinación Académica)',
            'description' => 'Acceder a la vista para cargar los resultados de aprendizaje',
            'description_english' => "Access the view to load learning outcomes",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Registrar resultados de aprendizaje cargados (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.programming.learning_outcome.load.store'], [ // Registro o actualización de permiso
            'name' => 'Registrar resultados de aprendizaje (Coordinación Académica)',
            'description' => 'Realizar el registro de los resultados de aprendizaje cargados',
            'description_english' => "Record uploaded learning outcomes",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        //  ----------------------------------- ROL BIENESTAR ------------------------------------------

        // Panel de control de bienestar (Bienestar)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.wellness.dashboard'], [ // Registro o actualización de permiso
            'name' => 'Panel de control de bienestar (Bienestar)',
            'description' => 'Panel de control de bienestar',
            'description_english' => "Wellness control panel",
            'app_id' => $app->id
        ]);
        $permissions_wellness[] = $permission->id; // Almacenar permiso para rol

        //  ------------------------------------ ROL APRENDIZ ------------------------------------------

        // Panel de control de aprendiz (Aprendiz)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.apprentice.dashboard'], [ // Registro o actualización de permiso
            'name' => 'Panel de control de aprendiz (Aprendiz)',
            'description' => 'Panel de control de aprendiz',
            'description_english' => "Apprentice control panel",
            'app_id' => $app->id
        ]);
        $permissions_apprentice[] = $permission->id; // Almacenar permiso para rol


        // Consulta de ROLES
        $rol_academic_coordination = Role::where('slug', 'sigac.academic_coordinator')->firstOrFail(); // Rol Coordinador Académico
        $rol_instructor = Role::where('slug', 'sigac.instructor')->firstOrFail(); // Rol Instructor
        $rol_wellness = Role::where('slug', 'sigac.wellbeing')->firstOrFail(); // Rol Bienestar
        $rol_apprentice = Role::where('slug', 'sigac.apprentice')->firstOrFail(); // Rol Aprendiz

        // Asignación de PERMISOS para los ROLES de la aplicación SIGAC (Sincronización de las relaciones sin eliminar las relaciones existentes)
        $rol_academic_coordination->permissions()->syncWithoutDetaching($permissions_academic_coordination);
        $rol_instructor->permissions()->syncWithoutDetaching($permissions_instructor);
        $rol_apprentice->permissions()->syncWithoutDetaching($permissions_apprentice);
    }
}
