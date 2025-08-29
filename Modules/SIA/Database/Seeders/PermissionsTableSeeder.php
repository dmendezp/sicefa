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
        
        // Permisos de Administrador para Proyectos de Investigación
        $permission = Permission::updateOrCreate(['slug' => 'sia.admin.research_project.index'], [
            'name' => 'Admin: Ver proyectos de investigación',
            'description' => 'Puede ver la lista de proyectos de investigación',
            'description_english' => 'Can see the list of research projects',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'sia.admin.searchperson'], [
            'name' => 'Admin: Buscar personas',
            'description' => 'Puede buscar personas para asignar a proyectos',
            'description_english' => 'Can search for people to assign to projects',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'sia.admin.research_project.store'], [
            'name' => 'Admin: Crear proyectos de investigación',
            'description' => 'Puede crear nuevos proyectos de investigación',
            'description_english' => 'Can create new research projects',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'sia.admin.research_project.update'], [
            'name' => 'Admin: Actualizar proyectos de investigación',
            'description' => 'Puede actualizar proyectos de investigación existentes',
            'description_english' => 'Can update existing research projects',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'sia.admin.research_project.destroy'], [
            'name' => 'Admin: Eliminar proyectos de investigación',
            'description' => 'Puede eliminar proyectos de investigación',
            'description_english' => 'Can delete research projects',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'sia.admin.research_project.applications'], [
            'name' => 'Admin: Gestionar postulaciones a proyectos',
            'description' => 'Puede gestionar las postulaciones de los aprendices a los proyectos',
            'description_english' => 'Can manage apprentice applications for projects',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'sia.admin.research_project.applications.update'], [
            'name' => 'Admin: Actualizar estado de postulación',
            'description' => 'Puede aprobar o rechazar postulaciones a proyectos',
            'description_english' => 'Can approve or reject project applications',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'sia.admin.research_project.group'], [
            'name' => 'Admin: Ver grupos de semillero',
            'description' => 'Puede ver los grupos de semillero y sus integrantes',
            'description_english' => 'Can see the research groups and their members',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'sia.admin.research_project.applications.detach'], [
            'name' => 'Admin: Desvincular aprendiz de proyecto',
            'description' => 'Puede desvincular un aprendiz de un proyecto de investigación',
   'description_english' => 'Can detach an apprentice from a research project',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;      
        
         $permission = Permission::updateOrCreate(['slug' => 'sia.admin.alliance.index'], [
            'name' => 'Admin: Ver alianzas',
            'description' => 'Puede ver la lista de alianzas',
            'description_english' => 'Can see the list of alliances',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'sia.admin.alliance.store'], [
            'name' => 'Admin: Crear alianzas',
            'description' => 'Puede crear nuevas alianzas',
            'description_english' => 'Can create new alliances',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'sia.admin.alliance.update'], [
            'name' => 'Admin: Actualizar alianzas',
            'description' => 'Puede actualizar alianzas existentes',
            'description_english' => 'Can update existing alliances',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'sia.admin.alliance.destroy'], [
            'name' => 'Admin: Eliminar alianzas',
            'description' => 'Puede eliminar alianzas',
            'description_english' => 'Can delete alliances',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'sia.admin.event.index'], [
            'name' => 'Admin: Ver eventos',
            'description' => 'Puede ver la lista de eventos',
            'description_english' => 'Can see the list of events',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'sia.admin.event.store'], [
            'name' => 'Admin: Crear eventos',
            'description' => 'Puede crear nuevos eventos',
            'description_english' => 'Can create new events',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'sia.admin.event.update'], [
            'name' => 'Admin: Actualizar eventos',
            'description' => 'Puede actualizar eventos existentes',
            'description_english' => 'Can update existing events',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'sia.admin.event.destroy'], [
            'name' => 'Admin: Eliminar eventos',
            'description' => 'Puede eliminar eventos',
            'description_english' => 'Can delete events',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'sia.admin.publication.index'], [
            'name' => 'Admin: Ver publicaciones',
            'description' => 'Puede ver y gestionar todas las publicaciones',
            'description_english' => 'Can see and manage all publications',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'sia.admin.publication.store'], [
            'name' => 'Admin: Crear publicaciones',
            'description' => 'Puede crear publicaciones como administrador',
            'description_english' => 'Can create publications as an administrator',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'sia.admin.publication.update'], [
            'name' => 'Admin: Actualizar estado de publicación',
            'description' => 'Puede aprobar o rechazar publicaciones',
            'description_english' => 'Can approve or reject publications',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'sia.admin.human_talent.user'], [
            'name' => 'Admin: Ver usuarios de talento humano',
            'description' => 'Puede ver la lista de usuarios de talento humano',
            'description_english' => 'Can see the list of human talent users',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'sia.admin.human_talent.apprentice'], [
            'name' => 'Admin: Ver aprendices de talento humano',
            'description' => 'Puede ver la lista de aprendices de talento humano',
            'description_english' => 'Can see the list of human talent apprentices',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'sia.admin.human_talent.apprentice.data'], [
            'name' => 'Admin: Obtener datos de aprendices',
            'description' => 'Puede obtener datos de aprendices para tablas (DataTables)',
            'description_english' => 'Can get apprentice data for tables (DataTables)',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id;

        // ---------- Permisos de Instructor ----------
        $permission = Permission::updateOrCreate(['slug' => 'sia.instructor.research_project.group'], [
            'name' => 'Instructor: Ver grupos de semillero',
            'description' => 'Puede ver los grupos de semillero y sus integrantes',
            'description_english' => 'Can see the research groups and their members',
            'app_id' => $app->id
        ]);
        $permissions_instructor[] = $permission->id;

        // ---------- Permisos de Aprendiz ----------
        $permission = Permission::updateOrCreate(['slug' => 'sia.apprentice.research_project.apply'], [
            'name' => 'Aprendiz: Postularse a proyecto',
            'description' => 'Puede ver el formulario y postularse a un proyecto de investigación',
            'description_english' => 'Can see the form and apply for a research project',
            'app_id' => $app->id
        ]);
        $permissions_apprentice[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'sia.apprentice.publication.create'], [
            'name' => 'Aprendiz: Crear publicación',
            'description' => 'Puede ver el formulario y crear una nueva publicación',
            'description_english' => 'Can see the form and create a new publication',
            'app_id' => $app->id
        ]);
        $permissions_apprentice[] = $permission->id;

         $permission = Permission::updateOrCreate(['slug' => 'sia.apprentice.publication.store'], [
            'name' => 'Aprendiz: Guardar publicación',
            'description' => 'Puede enviar el formulario para guardar una nueva publicación',
            'description_english' => 'Can submit the form to save a new publication',
            'app_id' => $app->id
        ]);
        $permissions_apprentice[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'sia.apprentice.research_project.showinfo'], [
            'name' => 'Aprendiz: Ver info de proyecto (AJAX)',
            'description' => 'Puede ver la información detallada de un proyecto',
            'description_english' => 'Can see detailed information of a project',
            'app_id' => $app->id
        ]);
        $permissions_apprentice[] = $permission->id;

        $permission = Permission::updateOrCreate(['slug' => 'sia.apprentice.research_project.apply.store'], [
            'name' => 'Aprendiz: Enviar postulación a proyecto',
            'description' => 'Puede enviar el formulario para postularse a un proyecto',
            'description_english' => 'Can submit the form to apply for a project',
            'app_id' => $app->id
        ]);
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