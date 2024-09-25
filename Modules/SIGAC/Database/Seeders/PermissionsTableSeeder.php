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
    public function run(){
    
        // Definir arreglos de PERMISOS que van ser asignados a los ROLES
        $permissions_academic_coordination = []; // Permisos para Coordinación Académica
        $permissions_instructor = []; // Permisos para el Instructor
        $permissions_wellness = []; // Permisos para Bienestar
        $permissions_apprentice = []; // Permisos para Aprendiz
        $permissions_support = []; // Permisos para Aprendiz

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

        // Programación de horarios (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.programming.index'], [ // Registro o actualización de permiso
            'name' => 'Programación de horarios (Coordinación Académica)',
            'description' => 'Programación de horarios',
            'description_english' => "Programming schedules",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Consultar filtro de horario (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.programming.management.filter'], [ // Registro o actualización de permiso
            'name' => 'Consultar filtro de horario (Coordinación Académica)',
            'description' => 'Consultar filtro de horario',
            'description_english' => "Check schedule filter",
            'app_id' => $app->id
        ]);

        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Consultar programaciones del instructor (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.programming.management.search'], [ // Registro o actualización de permiso
            'name' => 'Consultar programaciones del instructor (Coordinación Académica)',
            'description' => 'Consultar programaciones del instructor',
            'description_english' => "Consult instructor schedules",
            'app_id' => $app->id
        ]);

        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // ¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬ MODULO PARAMETROS ¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬

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

            
        // ACTIVIDADES EXTERNAS

        // Registrar actividad externa (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.programming.parameters.external_activities.store'], [ // Registro o actualización de permiso
            'name' => 'Registrar actividad externa (Coordinación Académica)',
            'description' => 'Realizar el registro de la actividad externa',
            'description_english' => "Record external activity",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Actualizar actividad externa (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.programming.parameters.external_activities.update'], [ // Registro o actualización de permiso
            'name' => 'Actualizar actividad externa (Coordinación Académica)',
            'description' => 'Realizar la actualización de la actividad externa',
            'description_english' => "Perform external activity update",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Eliminar actividad externa (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.programming.parameters.external_activities.destroy'], [ // Registro o actualización de permiso
            'name' => 'Eliminar actividad externa (Coordinación Académica)',
            'description' => 'Eliminar la actividad externa',
            'description_english' => "Eliminate external activity",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // PROFESION

        // Registrar profesion (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.programming.profession.store'], [ // Registro o actualización de permiso
            'name' => 'Registrar profesion (Coordinación Académica)',
            'description' => 'Realizar el registro de la profesion',
            'description_english' => "Record profession",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Actualizar profesion (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.programming.profession.update'], [ // Registro o actualización de permiso
            'name' => 'Actualizar profesion (Coordinación Académica)',
            'description' => 'Realizar la actualización de la profesion',
            'description_english' => "Perform profession update",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Eliminar profesion (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.programming.profession.destroy'], [ // Registro o actualización de permiso
            'name' => 'Eliminar profesion (Coordinación Académica)',
            'description' => 'Eliminar la profesion',
            'description_english' => "Eliminate profession",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // PROGRAMA ESPECIAL

        // Registrar programa especial (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.programming.parameters.special_program.store'], [ // Registro o actualización de permiso
            'name' => 'Registrar programa especial (Coordinación Académica)',
            'description' => 'Realizar el registro de la programa especial',
            'description_english' => "Record special program",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Actualizar programa especial (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.programming.parameters.special_program.update'], [ // Registro o actualización de permiso
            'name' => 'Actualizar programa especial (Coordinación Académica)',
            'description' => 'Realizar la actualización de la programa especial',
            'description_english' => "Perform special program update",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Eliminar programa especial (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.programming.parameters.special_program.destroy'], [ // Registro o actualización de permiso
            'name' => 'Eliminar programa especial (Coordinación Académica)',
            'description' => 'Eliminar la programa especial',
            'description_english' => "Eliminate special program",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol


        // ¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬ MODULO GESTION DE LA PROGRAMACION ¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬

        // Vista gestionar la programación (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.programming.management.index'], [ // Registro o actualización de permiso
            'name' => 'Vista gestionar la programación (Coordinación Académica)',
            'description' => 'Acceder a la vista para la gesion de la programación',
            'description_english' => "Access the view for scheduling management",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Consultar numero de trimestres (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.programming.management.search_quarter_number'], [ // Registro o actualización de permiso
            'name' => 'Consultar numero de trimestres (Coordinación Académica)',
            'description' => 'Consultar numero de trimestres del curso',
            'description_english' => "Check the number of quarters of the course",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Consultar trimestralización (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.programming.management.filterquarterlie'], [ // Registro o actualización de permiso
            'name' => 'Consultar trimestralización (Coordinación Académica)',
            'description' => 'Consultar la trimestralización del curso',
            'description_english' => "Consult the course quarterly",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Consultar resultados de aprendizaje (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.programming.management.filterlearning'], [ // Registro o actualización de permiso
            'name' => 'Consultar resultados de aprendizaje (Coordinación Académica)',
            'description' => 'Consultar los resultados de aprendizaje del curso',
            'description_english' => "View course learning outcomes",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Consultar instructores (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.programming.management.filterinstructor'], [ // Registro o actualización de permiso
            'name' => 'Consultar instructores (Coordinación Académica)',
            'description' => 'Consultar instructores enfocados en el resultado de aprendizaje',
            'description_english' => "Consult instructors focused on learning outcomes",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Consultar ambientes (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.programming.management.filterenvironment'], [ // Registro o actualización de permiso
            'name' => 'Consultar ambientes (Coordinación Académica)',
            'description' => 'Consultar ambientes aptos para la formacion de la competencia',
            'description_english' => "Consult environments suitable for training competition",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Consultar estado del resultado de prendizaje (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.programming.management.filterstatelearning'], [ // Registro o actualización de permiso
            'name' => 'Consultar estado del resultado de prendizaje (Coordinación Académica)',
            'description' => 'Consultar si el resultado de aprendizaje ya esta programado',
            'description_english' => "Check if the learning result is already programmed",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Registrar programación del instructor (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.programming.management.store'], [ // Registro o actualización de permiso
            'name' => 'Registrar programación del instructor (Coordinación Académica)',
            'description' => 'Realizar el registro de la programación del instructor',
            'description_english' => "Record instructor programming",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Buscar nombre del programa (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.programming.management.search_course'], [ // Registro o actualización de permiso
            'name' => 'Buscar nombre del programa (Coordinación Académica)',
            'description' => 'Buscar nombre del programa',
            'description_english' => 'Search for program name',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Eliminar la programacion (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.programming.management.destroy'], [ // Registro o actualización de permiso
            'name' => 'Eliminar la programacion (Coordinación Académica)',
            'description' => 'Eliminar la programación de un trimestre en el dia especifico',
            'description_english' => 'Delete the schedule of a quarter on the specific day',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Registrar novedad de la programación (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.programming.management.novelty.store'], [ // Registro o actualización de permiso
            'name' => 'Registrar novedad de la programación (Coordinación Académica)',
            'description' => 'Realizar el registro de la novedad de la programación del instructor',
            'description_english' => "Record the newness of the instructor's programming",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Registrar novedad de la programación (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.instructor.programming.management.novelty.store'], [ // Registro o actualización de permiso
            'name' => 'Registrar novedad de la programación (Instructor)',
            'description' => 'Realizar el registro de la novedad de la programación del instructor',
            'description_english' => "Record the newness of the instructor's programming",
            'app_id' => $app->id
        ]);
        $permissions_instructor[] = $permission->id; // Almacenar permiso para rol

        // Programación de horarios (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.instructor.programming.index'], [ // Registro o actualización de permiso
            'name' => 'Programación de horarios (Instructor)',
            'description' => 'Programación de horarios',
            'description_english' => "Programming schedules",
            'app_id' => $app->id
        ]);
        $permissions_instructor[] = $permission->id; // Almacenar permiso para rol

        // Consultar filtro de horario (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.instructor.programming.management.filter'], [ // Registro o actualización de permiso
            'name' => 'Consultar filtro de horario (Instructor)',
            'description' => 'Consultar filtro de horario',
            'description_english' => "Check schedule filter",
            'app_id' => $app->id
        ]);

        $permissions_instructor[] = $permission->id; // Almacenar permiso para rol

        // Consultar programaciones del instructor (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.instructor.programming.management.search'], [ // Registro o actualización de permiso
            'name' => 'Consultar programaciones del instructor (Instructor)',
            'description' => 'Consultar programaciones del instructor',
            'description_english' => "Consult instructor schedules",
            'app_id' => $app->id
        ]);

        $permissions_instructor[] = $permission->id; // Almacenar permiso para rol

        // Buscar nombre del programa (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.instructor.programming.management.search_course'], [ // Registro o actualización de permiso
            'name' => 'Buscar nombre del programa (Instructor)',
            'description' => 'Buscar nombre del programa',
            'description_english' => 'Search for program name',
            'app_id' => $app->id
        ]);
        $permissions_instructor[] = $permission->id; // Almacenar permiso para rol




        // ¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬ MODULO PLANEACION CURRICULAR ¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬¬


        // PROYECTO FORMATIVO

        // Vista proyectos formativos y cursos (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.curriculum_planning.training_project.index'], [ // Registro o actualización de permiso
            'name' => 'Vista proyectos formativos y cursos (Coordinación Académica)',
            'description' => 'Acceder a la vista de los proyectos formativos y cursos',
            'description_english' => "Access the view of training projects and courses",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Registrar proyecto formativo (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.curriculum_planning.training_project.store'], [ // Registro o actualización de permiso
            'name' => 'Registrar proyecto formativo (Coordinación Académica)',
            'description' => 'Registrar proyecto formativo',
            'description_english' => "Register training project",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Actualizar proyecto formativo (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.curriculum_planning.training_project.update'], [ // Registro o actualización de permiso
            'name' => 'Actualizar proyecto formativo (Coordinación Académica)',
            'description' => 'Actualizar proyecto formativo',
            'description_english' => "Update training project",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Eliminar proyecto formativo (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.curriculum_planning.training_project.destroy'], [ // Registro o actualización de permiso
            'name' => 'Eliminar proyecto formativo (Coordinación Académica)',
            'description' => 'Eliminar proyecto formativo',
            'description_english' => "Delete training project",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol


        // TRIMESTRALIZACIÓN

        // Vista trimestralización del curso (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.curriculum_planning.training_project.quarterlie.index'], [ // Registro o actualización de permiso
            'name' => 'Vista trimestralización del curso (Coordinación Académica)',
            'description' => 'Acceder a la vista de la trimestralización del curso',
            'description_english' => "Access the course quarterly view",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Consultar resultados de aprendizaje por competencia (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.curriculum_planning.quarterlie.filterlearning'], [ // Registro o actualización de permiso
            'name' => 'Consultar resultados de aprendizaje por competencia (Coordinación Académica)',
            'description' => 'Consultar resultados de aprendizaje por competencia',
            'description_english' => "Consult learning results by competency",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol
        
        // Registrar trimestralizaciòn (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.curriculum_planning.quarterlie.store'], [ // Registro o actualización de permiso
            'name' => 'Registrar trimestralizaciòn (Coordinación Académica)',
            'description' => 'Registrar trimestralizaciòn',
            'description_english' => "Register quarterly",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Eliminar trimestralizaciòn (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.curriculum_planning.quarterlie.destroy'], [ // Registro o actualización de permiso
            'name' => 'Eliminar trimestralizaciòn (Coordinación Académica)',
            'description' => 'Eliminar trimestralizaciòn',
            'description_english' => "Delete quarterly",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Vista carge de trimestralizaciòn (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.curriculum_planning.quarterlie.load.create'], [ // Registro o actualización de permiso
            'name' => 'Vista carge de trimestralizaciòn (Coordinación Académica)',
            'description' => 'Acceder a la vista para cargar la trimestralizaciòn',
            'description_english' => "Access the view to load the quarterly",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Registrar trimestralizaciones cargadas (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.curriculum_planning.quarterlie.load.store'], [ // Registro o actualización de permiso
            'name' => 'Registrar trimestralizaciones cargadas (Coordinación Académica)',
            'description' => 'Realizar el registro de las trimestralizaciones cargadas',
            'description_english' => "Register the quarterly payments uploaded",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // PROFESION X COMPETENCIA

        // Vista asignacion de profesion por competencia (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.curriculum_planning.assign_learning_outcomes.competencie_profession_index'], [ // Registro o actualización de permiso
            'name' => 'Vista asignacion de profesion por competencia (Coordinación Académica)',
            'description' => 'Acceder a la vista de asignacion de profesion por competencia',
            'description_english' => "Access the profession assignment view by competency",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Consultar profesiones asignadas por programa (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.curriculum_planning.assign_learning_outcomes.competencie_profession.table'], [ // Registro o actualización de permiso
            'name' => 'Consultar profesiones asignadas por programa (Coordinación Académica)',
            'description' => 'Consultar profesiones asignadas por programa',
            'description_english' => "Consult professions assigned by program",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Asignar profesion a la competencia (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.curriculum_planning.assign_learning_outcomes.competencie_profession_store'], [ // Registro o actualización de permiso
            'name' => 'Asignar profesion a la competencia (Coordinación Académica)',
            'description' => 'Asignar profesion a la competencia',
            'description_english' => "Assign profession to competition",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Actualizar la consulta profesiones asignadas (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.curriculum_planning.assign_learning_outcomes.competencie_profession_search'], [ // Registro o actualización de permiso
            'name' => 'Actualizar la consulta profesiones asignadas (Coordinación Académica)',
            'description' => 'Actualizar la consulta profesiones asignadas',
            'description_english' => "Update the assigned professions query",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Eliminar asociación de la profesion asignada con la competencia (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.curriculum_planning.assign_learning_outcomes.competencie_profession_destroy'], [ // Registro o actualización de permiso
            'name' => 'Eliminar asociación de la profesion asignada con la competencia (Coordinación Académica)',
            'description' => 'Eliminar asociación de la profesion asignada con la competencia',
            'description_english' => "Eliminate association of the assigned profession with the competition",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // CURSO X PROYECTO FORMATIVO

        // Vista asociacion de curso por proyecto formativo (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.curriculum_planning.course_trainig_project.index'], [ // Registro o actualización de permiso
            'name' => 'Vista asociacion de curso por proyecto formativo (Coordinación Académica)',
            'description' => 'Acceder a la vista de los cursos asociados a los proyectos formatvivos',
            'description_english' => "Access the view of the courses associated with the formative projects",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Consulta de los cursos por proyecto formativo (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.curriculum_planning.course_trainig_project.table'], [ // Registro o actualización de permiso
            'name' => 'Consulta de los cursos por proyecto formativo (Coordinación Académica)',
            'description' => 'Consulta de los cursos asociado al proyecto formativo',
            'description_english' => "Consultation of the courses associated with the training project",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol
        
        // Consultar profesiones asignadas por programa (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.curriculum_planning.assign_learning_outcomes.competencie_profession.table'], [ // Registro o actualización de permiso
            'name' => 'Consultar profesiones asignadas por programa (Coordinación Académica)',
            'description' => 'Consultar profesiones asignadas por programa',
            'description_english' => "Consult professions assigned by program",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Asociar curso al proyecto formativo (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.curriculum_planning.course_trainig_project.store'], [ // Registro o actualización de permiso
            'name' => 'Asociar curso al proyecto formativo (Coordinación Académica)',
            'description' => 'Asociación curso al proyecto formativo',
            'description_english' => "Associated course to the training project",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol
        
        // Asignar profesion a la competencia (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.curriculum_planning.assign_learning_outcomes.competencie_profession_store'], [ // Registro o actualización de permiso
            'name' => 'Asignar profesion a la competencia (Coordinación Académica)',
            'description' => 'Asignar profesion a la competencia',
            'description_english' => "Assign profession to competition",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Eliminar asociacion del curso con el proyecto formativo (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.curriculum_planning.course_trainig_project.destroy'], [ // Registro o actualización de permiso
            'name' => 'Eliminar asociacion del curso con el proyecto formativo (Coordinación Académica)',
            'description' => 'Eliminar asociacion del curso con el proyecto formativo',
            'description_english' => "Delete association of the course with the training project",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol
        

        // COMPETENCIA POR CALSE DE AMBIENTE

        // Vista asociacion de competencia por clase de ambiente (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.curriculum_planning.competencie_class.index'], [ // Registro o actualización de permiso
            'name' => 'Vista asociacion de competencia por clase de ambiente (Coordinación Académica)',
            'description' => 'Acceder a la vista de las competencias asociadas a la clase de ambiente',
            'description_english' => "Access the view of the competencies associated with the environment class",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Asociar la competencia a la clase de ambiente (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.curriculum_planning.competencie_class.store'], [ // Registro o actualización de permiso
            'name' => 'Asociar la competencia a la clase de ambiente (Coordinación Académica)',
            'description' => 'Asociar la competencia a la clase de ambiente',
            'description_english' => "Associate competition with the type of environment",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Eliminar asociacion de la competencia con la clase de ambiente (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.curriculum_planning.competencie_class.destroy'], [ // Registro o actualización de permiso
            'name' => 'Eliminar asociacion de la competencia con la clase de ambiente (Coordinación Académica)',
            'description' => 'Eliminar asociacion de la competencia con la clase de ambiente',
            'description_english' => "Remove association of competition with environment class",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // JUICIO EVALUATIVO
        
        // Vista de juicio evaluativo (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.curriculum_planning.evaluative_judgment.index'], [ // Registro o actualización de permiso
            'name' => 'Vista de juicio evaluativo (Coordinación Académica)',
            'description' => 'Acceder a la vista del juicio evaluativo',
            'description_english' => "Access the view of the evaluative judgment",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Consultar juicio evaluativo del curso (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.curriculum_planning.evaluative_judgment.search'], [ // Registro o actualización de permiso
            'name' => 'Consultar juicio evaluativo del curso (Coordinación Académica)',
            'description' => 'Consultar el juicio evaluativo del curso por aprendiz',
            'description_english' => "Consult the evaluative judgment of the course by trainee",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Filtrar juicio evaluativo (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.curriculum_planning.evaluative_judgment.filter'], [ // Registro o actualización de permiso
            'name' => 'Filtrar juicio evaluativo (Coordinación Académica)',
            'description' => 'Filtrar juicio evaluativo por aprendiz o estado',
            'description_english' => "Filter evaluative judgment by trainee or status",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Vista cerge del juicio evaluativo (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.curriculum_planning.evaluative_judgment.load.create'], [ // Registro o actualización de permiso
            'name' => 'Vista cerge del juicio evaluativo (Coordinación Académica)',
            'description' => 'Acceder a la vista para cargar el juicio evaluativo',
            'description_english' => "Access the view to load the evaluative judgment",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Registrar el juicio evaluativo cargado (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.curriculum_planning.evaluative_judgment.load.store'], [ // Registro o actualización de permiso
            'name' => 'Registrar el juicio evaluativo cargado (Coordinación Académica)',
            'description' => 'Realizar el registro del juicio evaluativo cargado por medio de archivo',
            'description_english' => "Make the record of the evaluative judgment uploaded via file",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        

        // INSTRUCTOR X PROFESION

        // Vista asociacion de instructores por profesion (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.human_talent.management_instructor.profession_instructor.index'], [ // Registro o actualización de permiso
            'name' => 'Vista asociacion de instructores por profesion (Coordinación Académica)',
            'description' => 'Acceder a la vista de asociación de instructores por profesion',
            'description_english' => "Access the instructor association view by profession",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Asociar profesion al instructor (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.human_talent.management_instructor.profession_instructor.store'], [ // Registro o actualización de permiso
            'name' => 'Asociar profesion al instructor (Coordinación Académica)',
            'description' => 'Asociar profesion al instructor',
            'description_english' => "Associate profession with the instructor",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Eliminar asociación de la profesion y el instructor (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.human_talent.management_instructor.profession_instructor.destroy'], [ // Registro o actualización de permiso
            'name' => 'Eliminar asociación de la profesion y el instructor (Coordinación Académica)',
            'description' => 'Eliminar asociación de la profesion y el instructor',
            'description_english' => "Eliminate association of the profession and the instructor",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // RESULTADO DE APRENDIZAJE X INSTRUCTOR

        // Vista asociacion de resultado de aprendizaje por instructor (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.human_talent.assign_learning_outcomes.index'], [ // Registro o actualización de permiso
            'name' => 'Vista asociacion de resultado de aprendizaje por instructor (Coordinación Académica)',
            'description' => 'Acceder a la vista de asociacion de los resultados de aprendizaje por instructor',
            'description_english' => "Access the association view of learning outcomes by instructor",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Consultar asociacion de instructores por resultado de aprendizaje (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.human_talent.assign_learning_outcomes.table'], [ // Registro o actualización de permiso
            'name' => 'Consultar asociacion de instructores por resultado de aprendizaje (Coordinación Académica)',
            'description' => 'Consultar asociacion de instructores por resultado de aprendizaje',
            'description_english' => "Consult association of instructors by learning outcome",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol
        
        // Asociar resultado de aprendizaje al instructor (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.human_talent.assign_learning_outcomes.store'], [ // Registro o actualización de permiso
            'name' => 'Asociar resultado de aprendizaje al instructor (Coordinación Académica)',
            'description' => 'Asociar resultado de aprendizaje al instructor',
            'description_english' => "Associate learning result to the instructor",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Consultar instructor apto para el resultado de aprendizaje (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.human_talent.assign_learning_outcomes.search_instructor'], [ // Registro o actualización de permiso
            'name' => 'Consultar instructor apto para el resultado de aprendizaje (Coordinación Académica)',
            'description' => 'Consultar instructor apto para el resultado de aprendizaje',
            'description_english' => "Consult suitable instructor for learning outcome",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Consultar competencias del programa (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.human_talent.assign_learning_outcomes.search_competencie'], [ // Registro o actualización de permiso
            'name' => 'Consultar competencias del programa (Coordinación Académica)',
            'description' => 'Consultar competencias del programa',
            'description_english' => "Consult program competencies",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Consultar resultado de aprendizaje (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.human_talent.assign_learning_outcomes.search_learning_outcome'], [ // Registro o actualización de permiso
            'name' => 'Consultar resultado de aprendizaje (Coordinación Académica)',
            'description' => 'Consultar resultados de aprendizajes de la competencia',
            'description_english' => "Consult competition learning results",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Eliminar asociación de la profesion asignada con la competencia (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.human_talent.assign_learning_outcomes.destroy'], [ // Registro o actualización de permiso
            'name' => 'Eliminar asociación de la profesion asignada con la competencia (Coordinación Académica)',
            'description' => 'Eliminar asociación de la profesion asignada con la competencia',
            'description_english' => "Eliminate association of the assigned profession with the competition",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // REPORTE TRIMESTRALIZACON

        // Vista reporte trimestralización (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.reports.quartelies.index'], [ // Registro o actualización de permiso
            'name' => 'Vista reporte trimestralización (Coordinación Académica)',
            'description' => 'Acceder a la vista para consultar el reporte de trimestralización',
            'description_english' => "Access the view to consult the quarterly report",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Consultar trimestralización del curso (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.reports.quartelies.search'], [ // Registro o actualización de permiso
            'name' => 'Consultar trimestralización del curso (Coordinación Académica)',
            'description' => 'Consultar trimestralización del curso',
            'description_english' => "Consult course trimester",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol
 
        // Reporte de instructores (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.reports.instructors.index'], [ // Registro o actualización de permiso
            'name' => 'Reporte de instructores (Coordinación Académica)',
            'description' => 'Reporte de instructores',
            'description_english' => "Instructors Report",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Consultar datos de instructores (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.reports.instructors.search'], [ // Registro o actualización de permiso
            'name' => 'Consultar datos de instructores (Coordinación Académica)',
            'description' => 'Consultar datos de instructores',
            'description_english' => "View instructor data",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Ambientes (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.reports.environments.index'], [ // Registro o actualización de permiso
            'name' => 'Ambientes (Coordinación Académica)',
            'description' => 'Ambientes',
            'description_english' => "Environments",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Consultar ambientes (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.reports.environments.search'], [ // Registro o actualización de permiso
            'name' => 'Consultar ambientes (Coordinación Académica)',
            'description' => 'Consultar ambientes',
            'description_english' => "Check environments",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Buscar personas (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.reports.environments.search_person'], [ // Registro o actualización de permiso
            'name' => 'Buscar personas (Coordinación Académica)',
            'description' => 'Buscar personas',
            'description_english' => "Search for people",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Guardar reprogramacion (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.reports.environments.institucional_request_store'], [ // Registro o actualización de permiso
            'name' => 'Guardar reprogramacion (Coordinación Académica)',
            'description' => 'Guardar reprogramacion',
            'description_english' => "Save reprogramming",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Vista actividades externas (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.programming.external_activities.index'], [ // Registro o actualización de permiso
            'name' => 'Vista actividades externas (Coordinación Académica)',
            'description' => 'Puede ingresar a la vista de actividades externas',
            'description_english' => "You can enter the external activities view",
            'app_id' => $app->id
        ]);

        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol
    
        // Formulario de solicitud de actividad externa
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.programming.external_activities.external_activities_create'], [ // Registro o actualización de permiso
            'name' => 'Formulario de solicitud de actividad externa (Coordinación Académica)',
            'description' => 'Puede ver el formulario de solicitud de actividad externa',
            'description_english' => "You can see the external activity application form",
            'app_id' => $app->id
        ]);

        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Consultar cursos (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.programming.external_activities.external_activities_search_course'], [ // Registro o actualización de permiso
            'name' => 'Consultar cursos (Coordinación Académica)',
            'description' => 'Puede consultar los cursos',
            'description_english' => "You can check the courses",
            'app_id' => $app->id
        ]);

        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Guardar programacion de actividades externas (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.programming.external_activities.external_activities_store'], [ // Registro o actualización de permiso
            'name' => 'Guardar programacion de actividades externas (Coordinación Académica)',
            'description' => 'Puede guardar la programacion de actividades externas',
            'description_english' => "You can save the schedule of external activities",
            'app_id' => $app->id
        ]);

        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Buscar persona para la actividad externa
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.programming.external_activities.external_activities_search_person'], [ // Registro o actualización de permiso
            'name' => 'Buscar persona para la actividad externa',
            'description' => 'Puede buscar la persona que va a estar encargada de la actividad',
            'description_english' => "You can search for the person who will be in charge of the activity",
            'app_id' => $app->id
        ]);

        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Aprobar actividad externa
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.programming.external_activities.approved_external_activities'], [ // Registro o actualización de permiso
            'name' => 'Aprobar actividad externa',
            'description' => 'Puede aprobar la actividad externa',
            'description_english' => "You can approve the external activity",
            'app_id' => $app->id
        ]);

        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // No aprobar actividad externa
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.programming.external_activities.cancel_external_activities'], [ // Registro o actualización de permiso
            'name' => 'No aprobar actividad externa',
            'description' => 'Puede no aprobar la actividad externa',
            'description_english' => "May not approve outside activity",
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

        // ASISTENCIA
        
        // Vista registro de asistencia (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.instructor.attendances.attendance.index'], [ // Registro o actualización de permiso
            'name' => 'Vista registro de asistencia (Instructor)',
            'description' => 'Acceder a la vista de registro de asistencia',
            'description_english' => "Access the attendance record view",
            'app_id' => $app->id
        ]);
        $permissions_instructor[] = $permission->id; // Almacenar permiso para rol

        // Table solicitar programa (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.instructor.programming.program_request.table'], [ // Registro o actualización de permiso
            'name' => 'Tabla solicitar programa (Instructor)',
            'description' => 'Acceder a la tabla de la solicitud de programas de formaciòn',
            'description_english' => "Access the table of the application for training programs",
            'app_id' => $app->id
        ]);
        $permissions_instructor[] = $permission->id; // Almacenar permiso para rol
        
        // Vista solicitar programa (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.instructor.programming.program_request.index'], [ // Registro o actualización de permiso
            'name' => 'Vista solicitar programa (Instructor)',
            'description' => 'Acceder a la vista de la solicitud de programas de formaciòn',
            'description_english' => "Access the view of the application for training programs",
            'app_id' => $app->id
        ]);
        $permissions_instructor[] = $permission->id; // Almacenar permiso para rol

        // Consultar asistencia (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.instructor.attendances.attendance.search'], [ // Registro o actualización de permiso
            'name' => 'Consultar asistencia (Instructor)',
            'description' => 'Consultar asistencia por fecha',
            'description_english' => "Check attendance by date",
            'app_id' => $app->id
        ]);
        $permissions_instructor[] = $permission->id; // Almacenar permiso para rol
        
        // Consultar profesion del instructor (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.instructor.programming.program_request.searchprofession'], [ // Registro o actualización de permiso
            'name' => 'Consultar profesion del instructor (Instructor)',
            'description' => 'Consultar profesion del instructor',
            'description_english' => "Consult the instructor's profession",
            'app_id' => $app->id
        ]);
        $permissions_instructor[] = $permission->id; // Almacenar permiso para rol

        // Consultar empresa (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.instructor.programming.program_request.searchempresa'], [ // Registro o actualización de permiso
            'name' => 'Consultar empresa (Instructor)',
            'description' => 'Consultar la empresa',
            'description_english' => "Consult the company",
            'app_id' => $app->id
        ]);
        $permissions_instructor[] = $permission->id; // Almacenar permiso para rol

        // Consultar solicitador (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.instructor.programming.program_request.searchapplicant'], [ // Registro o actualización de permiso
            'name' => 'Consultar solicitador (Instructor)',
            'description' => 'Consultar el solicitador',
            'description_english' => "Consult the requester",
            'app_id' => $app->id
        ]);
        $permissions_instructor[] = $permission->id; // Almacenar permiso para rol

        // Registrar solicitud del programa (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.instructor.programming.program_request.store'], [ // Registro o actualización de permiso
            'name' => 'Registrar solicitud del programa (Instructor)',
            'description' => 'Realizar el registro de la solicitud del programa',
            'description_english' => "Register the program application",
            'app_id' => $app->id
        ]);
        $permissions_instructor[] = $permission->id; // Almacenar permiso para rol


        //  ----------------------------------- ROL BIENESTAR ------------------------------------------

        // Panel de control de bienestar (Bienestar)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.wellness.dashboard'], [ // Registro o actualización de permiso
            'name' => 'Panel de control de bienestar (Bienestar)',
            'description' => 'Panel de control de bienestar',
            'description_english' => "Wellness control panel",
            'app_id' => $app->id
        ]);
        $permissions_wellness[] = $permission->id; // Almacenar permiso para rol

        // Programación de horarios (Bienestar)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.wellness.programming.index'], [ // Registro o actualización de permiso
            'name' => 'Programación de horarios (Bienestar)',
            'description' => 'Programación de horarios',
            'description_english' => "Programming schedules",
            'app_id' => $app->id
        ]);
        $permissions_wellness[] = $permission->id; // Almacenar permiso para rol

        // Consultar filtro de horario (Bienestar)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.wellness.programming.management.filter'], [ // Registro o actualización de permiso
            'name' => 'Consultar filtro de horario (Bienestar)',
            'description' => 'Consultar filtro de horario',
            'description_english' => "Check schedule filter",
            'app_id' => $app->id
        ]);

        $permissions_wellness[] = $permission->id; // Almacenar permiso para rol

        // Consultar programaciones del instructor (Bienestar)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.wellness.programming.management.search'], [ // Registro o actualización de permiso
            'name' => 'Consultar programaciones del instructor (Bienestar)',
            'description' => 'Consultar programaciones del instructor',
            'description_english' => "Consult instructor schedules",
            'app_id' => $app->id
        ]);

        $permissions_wellness[] = $permission->id; // Almacenar permiso para rol

        // Vista actividades externas (Bienestar)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.wellness.programming.external_activities.index'], [ // Registro o actualización de permiso
            'name' => 'Vista actividades externas (Bienestar)',
            'description' => 'Puede ingresar a la vista de actividades externas',
            'description_english' => "You can enter the external activities view",
            'app_id' => $app->id
        ]);

        $permissions_wellness[] = $permission->id; // Almacenar permiso para rol

        // Formulario de solicitud de actividad externa
        $permission = Permission::updateOrCreate(['slug' => 'sigac.wellness.programming.external_activities.external_activities_create'], [ // Registro o actualización de permiso
            'name' => 'Formulario de solicitud de actividad externa (Bienestar)',
            'description' => 'Puede ver el formulario de solicitud de actividad externa',
            'description_english' => "You can see the external activity application form",
            'app_id' => $app->id
        ]);

        $permissions_wellness[] = $permission->id; // Almacenar permiso para rol

        // Consultar cursos (Bienestar)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.wellness.programming.external_activities.external_activities_search_course'], [ // Registro o actualización de permiso
            'name' => 'Consultar cursos (Bienestar)',
            'description' => 'Puede consultar los cursos',
            'description_english' => "You can check the courses",
            'app_id' => $app->id
        ]);

        $permissions_wellness[] = $permission->id; // Almacenar permiso para rol

        // Guardar programacion de actividades externas (Bienestar)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.wellness.programming.external_activities.external_activities_store'], [ // Registro o actualización de permiso
            'name' => 'Guardar programacion de actividades externas (Bienestar)',
            'description' => 'Puede guardar la programacion de actividades externas',
            'description_english' => "You can save the schedule of external activities",
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

        // Programación de horarios (Aprendiz)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.apprentice.programming.index'], [ // Registro o actualización de permiso
            'name' => 'Programación de horarios (Aprendiz)',
            'description' => 'Programación de horarios',
            'description_english' => "Programming schedules",
            'app_id' => $app->id
        ]);
        $permissions_apprentice[] = $permission->id; // Almacenar permiso para rol

        // Consultar filtro de horario (Aprendiz)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.apprentice.programming.management.filter'], [ // Registro o actualización de permiso
            'name' => 'Consultar filtro de horario (Aprendiz)',
            'description' => 'Consultar filtro de horario',
            'description_english' => "Check schedule filter",
            'app_id' => $app->id
        ]);

        $permissions_apprentice[] = $permission->id; // Almacenar permiso para rol

        // Consultar programaciones del instructor (Aprendiz)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.apprentice.programming.management.search'], [ // Registro o actualización de permiso
            'name' => 'Consultar programaciones del instructor (Aprendiz)',
            'description' => 'Consultar programaciones del instructor',
            'description_english' => "Consult instructor schedules",
            'app_id' => $app->id
        ]);

        $permissions_apprentice[] = $permission->id; // Almacenar permiso para rol

        //  ----------------------------------- ROL APOYO ------------------------------------------

        // Panel de control de apoyo (Apoyo)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.support.dashboard'], [ // Registro o actualización de permiso
            'name' => 'Panel de control de apoyo (Apoyo)',
            'description' => 'Panel de control de apoyo',
            'description_english' => "Support control panel",
            'app_id' => $app->id
        ]);
        $permissions_support[] = $permission->id; // Almacenar permiso para rol

        // Programación de horarios (Apoyo)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.support.programming.index'], [ // Registro o actualización de permiso
            'name' => 'Programación de horarios (Apoyo)',
            'description' => 'Programación de horarios',
            'description_english' => "Programming schedules",
            'app_id' => $app->id
        ]);
        $permissions_support[] = $permission->id; // Almacenar permiso para rol

        // Consultar filtro de horario (Apoyo)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.support.programming.management.filter'], [ // Registro o actualización de permiso
            'name' => 'Consultar filtro de horario (Apoyo)',
            'description' => 'Consultar filtro de horario',
            'description_english' => "Check schedule filter",
            'app_id' => $app->id
        ]);

        $permissions_support[] = $permission->id; // Almacenar permiso para rol

        // Consultar programaciones del instructor (Apoyo)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.support.programming.management.search'], [ // Registro o actualización de permiso
            'name' => 'Consultar programaciones del instructor (Apoyo)',
            'description' => 'Consultar programaciones del instructor',
            'description_english' => "Consult instructor schedules",
            'app_id' => $app->id
        ]);

        $permissions_support[] = $permission->id; // Almacenar permiso para rol

        // Vista solicitude de programas (Apoyo)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.support.programming.program_request.characterization.index'], [ // Registro o actualización de permiso
            'name' => 'Vista solicitude de programas (Apoyo)',
            'description' => 'Acceder a la vista de las solicitudes de programas',
            'description_english' => "Access the program request view",
            'app_id' => $app->id
        ]);
        $permissions_support[] = $permission->id; // Almacenar permiso para rol

        // Caracterizar programa (Apoyo)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.support.programming.program_request.characterization.store'], [ // Registro o actualización de permiso
            'name' => 'Caracterizar programa (Apoyo)',
            'description' => 'Caracterizar el programa de formaciòn solicitado',
            'description_english' => "Characterize the requested training program",
            'app_id' => $app->id
        ]);
        $permissions_support[] = $permission->id; // Almacenar permiso para rol

        // Devolver solicitud del programa (Apoyo)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.instructor.programming.program_request.characterization.devolution'], [ // Registro o actualización de permiso
            'name' => 'Devolver solicitud del programa (Apoyo)',
            'description' => 'Devolver solicitud del programa de formaciòn',
            'description_english' => "Return training program request",
            'app_id' => $app->id
        ]);
        $permissions_support[] = $permission->id; // Almacenar permiso para rol

        // Descargar los documentos de la solicitud del programa (Apoyo)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.support.programming.program_request.program_request_download'], [ // Registro o actualización de permiso
            'name' => 'Descargar los documentos de la solicitud del programa (Apoyo)',
            'description' => 'Descargar los documentos de la solicitud del programa',
            'description_english' => 'Download the program application documents',
            'app_id' => $app->id
        ]);
        $permissions_support[] = $permission->id; // Almacenar permiso para rol

        //  ------------------------------------ ROLES ------------------------------------------

        // Registra asistencia del aprendiz (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.instructor.attendances.attendance.store'], [ // Registro o actualización de permiso
            'name' => 'Registra asistencia del aprendiz (Instructor)',
            'description' => 'Realizar el registro de la asistencia del aprendiz',
            'description_english' => "Record the apprentice's attendance",
            'app_id' => $app->id
        ]);
        $permissions_instructor[] = $permission->id; // Almacenar permiso para rol 

        // SOLICITAR PROGRAMA -- COORDINADOR ACADEMICO

        // Tabla solicitar programa (Coordiandor Academico)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.programming.program_request.table'], [ // Registro o actualización de permiso
            'name' => 'Tabla solicitar programa (Coordiandor Academico)',
            'description' => 'Acceder a la tabla de la solicitud de programas de formaciòn',
            'description_english' => "Access the table of the application for training programs",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Vista solicitar programa (Coordiandor Academico)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.programming.program_request.index'], [ // Registro o actualización de permiso
            'name' => 'Vista solicitar programa (Coordiandor Academico)',
            'description' => 'Acceder a la vista de la solicitud de programas de formaciòn',
            'description_english' => "Access the view of the application for training programs",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Consultar profesion del instructor (Coordiandor Academico)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.programming.program_request.searchprofession'], [ // Registro o actualización de permiso
            'name' => 'Consultar profesion del instructor (Coordiandor Academico)',
            'description' => 'Consultar profesion del instructor',
            'description_english' => "Consult the instructor's profession",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol


        // Consultar empresa (Coordiandor Academico)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.programming.program_request.searchempresa'], [ // Registro o actualización de permiso
            'name' => 'Consultar empresa (Coordiandor Academico)',
            'description' => 'Consultar la empresa',
            'description_english' => "Consult the company",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Consultar solicitador (Coordiandor Academico)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.programming.program_request.searchapplicant'], [ // Registro o actualización de permiso
            'name' => 'Consultar solicitador (Coordiandor Academico)',
            'description' => 'Consultar el solicitador',
            'description_english' => "Consult the requester",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Registrar solicitud del programa (Coordiandor Academico)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.programming.program_request.store'], [ // Registro o actualización de permiso
            'name' => 'Registrar solicitud del programa (Coordiandor Academico)',
            'description' => 'Realizar el registro de la solicitud del programa',
            'description_english' => "Register the program application",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Descargar los documentos de la solicitud del programa (Coordiandor Academico)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.programming.program_request.program_request_download'], [ // Registro o actualización de permiso
            'name' => 'Descargar los documentos de la solicitud del programa (Coordiandor Academico)',
            'description' => 'Descargar los documentos de la solicitud del programa',
            'description_english' => 'Download the program application documents',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol
        
        // Cargar documentos para la solicitud del programa (Coordiandor Academico)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.programming.program_request.document_store'], [ // Registro o actualización de permiso
            'name' => 'Cargar los documentos de la solicitud del programa (Coordiandor Academico)',
            'description' => 'Cargar los documentos de la solicitud del programa',
            'description_english' => 'Upload your program application documents',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Cargar documentos para la solicitud del programa (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.instructor.programming.program_request.document_store'], [ // Registro o actualización de permiso
            'name' => 'Cargar los documentos de la solicitud del programa (Instructor)',
            'description' => 'Cargar los documentos de la solicitud del programa',
            'description_english' => 'Upload your program application documents',
            'app_id' => $app->id
        ]);
        $permissions_instructor[] = $permission->id; // Almacenar permiso para rol

        // Descargar los documentos de la solicitud del programa (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.instructor.programming.program_request.program_request_download'], [ // Registro o actualización de permiso
            'name' => 'Descargar los documentos de la solicitud del programa (Instructor)',
            'description' => 'Descargar los documentos de la solicitud del programa',
            'description_english' => 'Download the program application documents',
            'app_id' => $app->id
        ]);
        $permissions_instructor[] = $permission->id; // Almacenar permiso para rol

        

        // REPORTE TRIMESTRALIZACON -- INSTRUCTOR

        // Vista reporte trimestralización (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.instructor.reports.quartelies.index'], [ // Registro o actualización de permiso
            'name' => 'Vista reporte trimestralización (Instructor)',
            'description' => 'Acceder a la vista para consultar el reporte de trimestralización',
            'description_english' => "Access the view to consult the quarterly report",
            'app_id' => $app->id
        ]);
        $permissions_instructor[] = $permission->id; // Almacenar permiso para rol

        // Consultar trimestralización del curso (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.instructor.reports.quartelies.search'], [ // Registro o actualización de permiso
            'name' => 'Consultar trimestralización del curso (Instructor)',
            'description' => 'Consultar trimestralización del curso',
            'description_english' => "Consult course trimester",
            'app_id' => $app->id
        ]);
        $permissions_instructor[] = $permission->id; // Almacenar permiso para rol


        // Consulta de ROLES
        $rol_academic_coordination = Role::where('slug', 'sigac.academic_coordinator')->firstOrFail(); // Rol Coordinador Académico
        $rol_instructor = Role::where('slug', 'sigac.instructor')->firstOrFail(); // Rol Instructor
        $rol_wellness = Role::where('slug', 'sigac.wellbeing')->firstOrFail(); // Rol Bienestar
        $rol_apprentice = Role::where('slug', 'sigac.apprentice')->firstOrFail(); // Rol Aprendiz
        $rol_support = Role::where('slug', 'sigac.support')->firstOrFail(); // Rol Apoyo

        // Asignación de PERMISOS para los ROLES de la aplicación SIGAC (Sincronización de las relaciones sin eliminar las relaciones existentes)
        $rol_academic_coordination->permissions()->syncWithoutDetaching($permissions_academic_coordination);
        $rol_instructor->permissions()->syncWithoutDetaching($permissions_instructor);
        $rol_apprentice->permissions()->syncWithoutDetaching($permissions_apprentice);
        $rol_wellness->permissions()->syncWithoutDetaching($permissions_wellness);
        $rol_support->permissions()->syncWithoutDetaching($permissions_support);
    }
}
