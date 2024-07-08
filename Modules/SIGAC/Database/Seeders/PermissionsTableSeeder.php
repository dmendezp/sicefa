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

        // Asociar curso al proyecto formativo (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.curriculum_planning.course_trainig_project.store'], [ // Registro o actualización de permiso
            'name' => 'Asociar curso al proyecto formativo (Coordinación Académica)',
            'description' => 'Asociación curso al proyecto formativo',
            'description_english' => "Associated course to the training project",
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
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.human_talent.assign_learning_outcomes.search_competencie'], [ // Registro o actualización de permiso
            'name' => 'Consultar resultado de aprendizaje (Coordinación Académica)',
            'description' => 'Consultar resultados de aprendizajes de la competencia',
            'description_english' => "Consult competition learning results",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordination[] = $permission->id; // Almacenar permiso para rol

        // Eliminar asociación del resultado de aprendizaje al instructor (Coordinación Académica)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.academic_coordination.human_talent.assign_learning_outcomes.search_competencie'], [ // Registro o actualización de permiso
            'name' => 'Eliminar asociación del resultado de aprendizaje al instructor (Coordinación Académica)',
            'description' => 'Eliminar asociación del resultado de aprendizaje al instructor',
            'description_english' => "Remove association from learning outcome to instructor",
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

        // Consultar asistencia (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.instructor.attendances.attendance.search'], [ // Registro o actualización de permiso
            'name' => 'Consultar asistencia (Instructor)',
            'description' => 'Consultar asistencia por fecha',
            'description_english' => "Check attendance by date",
            'app_id' => $app->id
        ]);
        $permissions_instructor[] = $permission->id; // Almacenar permiso para rol

        // Registra asistencia del aprendiz (Instructor)
        $permission = Permission::updateOrCreate(['slug' => 'sigac.instructor.attendances.attendance.index'], [ // Registro o actualización de permiso
            'name' => 'Registra asistencia del aprendiz (Instructor)',
            'description' => 'Realizar el registro de la asistencia del aprendiz',
            'description_english' => "Record the apprentice's attendance",
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
