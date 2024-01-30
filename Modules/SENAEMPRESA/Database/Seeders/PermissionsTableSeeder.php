<?php

namespace Modules\SENAEMPRESA\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
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
        $permissions_admin = []; // Permisos para Administrador
        $permissions_human_talent_leader = []; // Permisos para Lider de talento humano
        $permissions_psychologo = []; // Permisos para psicologo
        $permissions_apprentice = []; // Permisos para aprendiz


        // Consultar aplicación SENAEMPRESA para registrar los roles
        $app = App::where('name', 'SENAEMPRESA')->first();

        // Vista admin senaempresa
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.index'], [ // Registro o actualización de permiso
            'name' => 'Vista Admin Senaempresa',
            'description' => 'Puede ver vista admin senaempresa',
            'description_english' => 'You can see admin senaempresa view',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista Lider de talento humano senaempresa
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.human_talent_leader.index'], [ // Registro o actualización de permiso
            'name' => 'Vista lider talento human Senaempresa',
            'description' => 'Puede ver vista lider talento human senaempresa',
            'description_english' => 'You can view vista lider talento human senaempresa',
            'app_id' => $app->id
        ]);
        $permissions_human_talent_leader[] = $permission->id; // Almacenar permiso para rol

        // Vista de psicologo senaempresa
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.psychologo.index'], [ // Registro o actualización de permiso
            'name' => 'Vista Psicologo Senaempresa',
            'description' => 'Puede ver vista psicologo senaempresa',
            'description_english' => 'You can view view psicologo senaempresa',
            'app_id' => $app->id
        ]);
        $permissions_psychologo[] = $permission->id; // Almacenar permiso para rol

        // Vista aprendiz senaempresa
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.apprentice.index'], [ // Registro o actualización de permiso
            'name' => 'Vista Aprendiz Senaempresa',
            'description' => 'Puede ver vista aprendiz senaempresa',
            'description_english' => 'You can see senaempresa apprentice view',
            'app_id' => $app->id
        ]);
        $permissions_apprentice[] = $permission->id; // Almacenar permiso para rol

        // Vista fases senaempresa (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.phases.index'], [ // Registro o actualización de permiso
            'name' => 'Vista fases senaempresa (Administrador)',
            'description' => 'Puede ver listado de las fases de senaempresa',
            'description_english' => 'You can see a list of senaempresa phases',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista de agregar nueva fase senaempresa (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.phases.new'], [ // Registro o actualización de permiso
            'name' => 'Vista de formulario para nueva fase senaempresa (Administrador)',
            'description' => 'Formulario para agregar nueva fase de senaempresa',
            'description_english' => 'Form to add new phase senaempresa',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // guardar nueva fase senaempresa (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.phases.saved'], [ // Registro o actualización de permiso
            'name' => 'Guardar nueva fase senaempresa (Administrador)',
            'description' => 'Formulario para guardar nueva fase de senaempresa',
            'description_english' => 'Form to save the new phase of senaempresa',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista de editar fase senaempresa (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.phases.edit'], [ // Registro o actualización de permiso
            'name' => 'Vista de formulario para editar las fases senaempresa (Administrador)',
            'description' => 'Formulario para editar las fase de senaempresa',
            'description_english' => 'Form to edit senaempresa phases',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Actualizar fase senaempresa (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.phases.updated'], [ // Registro o actualización de permiso
            'name' => 'Actualizar las fases senaempresa (Administrador)',
            'description' => 'Formulario para actualizar las fases de senaempresa',
            'description_english' => 'Form to update the phases of senaempresa',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Eliminar fase senaempresa (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.phases.delete'], [ // Registro o actualización de permiso
            'name' => 'Eliminar las fases senaempresa (Administrador)',
            'description' => 'Formulario para eliminar las fases de senaempresa',
            'description_english' => 'Form to eliminate the phases of senaempresa',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista de asociar curso senampresa (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.phases.show_associates'], [ // Registro o actualización de permiso
            'name' => 'Vista asociar curso con senamepresa (Administrador)',
            'description' => 'Puede ver las senaempresas asociadas segun el curso',
            'description_english' => 'You can see the associated senaenmpresa according to the course',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // actualizar las asociaciones de cursos senampresa (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.phases.associated_course'], [ // Registro o actualización de permiso
            'name' => 'Actualizar asociaciones cursos senaempresa (Administrador)',
            'description' => 'Actualizar las asociaciones entre cursos y senaempresa',
            'description_english' => 'Update partnerships between courses and senaempresa',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // consultar las asociaciones de cursos senampresa (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.phases.get_associations'], [ // Registro o actualización de permiso
            'name' => 'Consultar asociaciones cursos senaempresa (Administrador)',
            'description' => 'Consultar las asociaciones entre cursos y senaempresa',
            'description_english' => 'Consult partnerships between courses and senaempresa',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista senaempresa personal (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.staff.index'], [ // Registro o actualización de permiso
            'name' => 'Vista SenaEmpresa Personal (Administrador)',
            'description' => 'Puede ver el personal de senaempresa',
            'description_english' => 'You can see the senaempresa staff',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista senaempresa personal (Lider talento humano)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.human_talent_leader.staff.index'], [ // Registro o actualización de permiso
            'name' => 'Vista SenaEmpresa Personal (Lider talento humano)',
            'description' => 'Puede ver el personal de senaempresa',
            'description_english' => 'You can see the senaempresa staff',
            'app_id' => $app->id
        ]);
        $permissions_human_talent_leader[] = $permission->id; // Almacenar permiso para rol

        // Vista senaempresa personal (Aprendiz)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.apprentice.staff.index'], [ // Registro o actualización de permiso
            'name' => 'Vista SenaEmpresa Personal (Aprendiz)',
            'description' => 'Puede ver el personal de senaempresa',
            'description_english' => 'You can see the senaempresa staff',
            'app_id' => $app->id
        ]);
        $permissions_apprentice[] = $permission->id; // Almacenar permiso para rol

        // Vista de agregar nuevo personal de senaempresa (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.staff.new'], [ // Registro o actualización de permiso
            'name' => 'Vista de formulario para nuevo personal (Administrador)',
            'description' => 'Formulario para agregar nuevo personal de senaempresa',
            'description_english' => 'Form to add new staff of senaempresa',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // guardar nuevo personal de senaempresa (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.staff.saved'], [ // Registro o actualización de permiso
            'name' => 'Guardar nuevo personal (Administrador)',
            'description' => 'Formulario para guardar nuevo personal de senaempresa',
            'description_english' => 'Form to save new staff of senaempresa',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista de editar personal de senaempresa (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.staff.edit'], [ // Registro o actualización de permiso
            'name' => 'Vista de formulario para editar el personal (Administrador)',
            'description' => 'Formulario para editar el personal de senaempresa',
            'description_english' => 'Form for editing senaempresa staff',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Actualizar personal de senaempresa (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.staff.updated'], [ // Registro o actualización de permiso
            'name' => 'Actualizar el personal (Administrador)',
            'description' => 'Formulario para actualizar el personal de senaempresa',
            'description_english' => 'Form to update the senaempresa staff',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Eliminar personal de senaempresa (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.staff.delete'], [ // Registro o actualización de permiso
            'name' => 'Eliminar el personal (Administrador)',
            'description' => 'Formulario para eliminar el personal de senaempresa',
            'description_english' => 'Form to eliminate the staff of senaempresa',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista senaempresa prestamos (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.loans.index'], [ // Registro o actualización de permiso
            'name' => 'Vista SenaEmpresa Prestamos (Administrador)',
            'description' => 'Puede ver los prestamos registrados',
            'description_english' => 'You can view registered loans',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

         //Generar pdf de prestamos (Administrador)
         $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.loans.generate.pdf'], [ // Registro o actualización de permiso
            'name' => 'Generar pdf prestamos (Administrador)',
            'description' => 'Generar pdf de los prestamos de senaempresa',
            'description_english' => 'Generate pdf of senaempresa loans',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

         //Generar pdf de prestamos (Lider talento humano)
         $permission = Permission::updateOrCreate(['slug' => 'senaempresa.human_talent_leader.loans.generate.pdf'], [ // Registro o actualización de permiso
            'name' => 'Generar pdf prestamos (Lider talento humano)',
            'description' => 'Generar pdf de los prestamos de senaempresa',
            'description_english' => 'Generate pdf of senaempresa loans',
            'app_id' => $app->id
        ]);
        $permissions_human_talent_leader[] = $permission->id; // Almacenar permiso para rol

        // Vista senaempresa inventario (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.loans.inventory'], [ // Registro o actualización de permiso
            'name' => 'Vista SenaEmpresa Inventario (Administrador)',
            'description' => 'Puede ver el inventario de senaempresa',
            'description_english' => 'You can view the inventory of senaempresa',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        //Generar pdf de inventario (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.loans.generate.inventory.pdf'], [ // Registro o actualización de permiso
            'name' => 'Generar pdf Inventario (Administrador)',
            'description' => 'Generar pdf del inventario senaempresa',
            'description_english' => 'Generate pdf of the senaempresa inventory',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Filtrar prestamos por estado (Administrador y/o Lider talento humano)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin-human_talent_leader.loans.filter'], [ // Registro o actualización de permiso
            'name' => 'Vista SenaEmpresa Prestamos (Administrador y/o Lider talento humano)',
            'description' => 'Puede ver los prestamos registrados',
            'description_english' => 'You can view registered loans',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol
        $permissions_human_talent_leader[] = $permission->id; // Almacenar permiso para rol

        // Vista senaempresa prestamos (Lider talento humano)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.human_talent_leader.loans.index'], [ // Registro o actualización de permiso
            'name' => 'Vista SenaEmpresa Prestamos (Lider talento humano)',
            'description' => 'Puede ver los prestamos registrados',
            'description_english' => 'You can view registered loans',
            'app_id' => $app->id
        ]);
        $permissions_human_talent_leader[] = $permission->id; // Almacenar permiso para rol

        // Vista senaempresa prestamos (Aprendiz)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.apprentice.loans.index'], [ // Registro o actualización de permiso
            'name' => 'Vista SenaEmpresa Prestamos (Aprendiz)',
            'description' => 'Puede ver los prestamos registrados',
            'description_english' => 'You can view registered loans',
            'app_id' => $app->id
        ]);
        $permissions_apprentice[] = $permission->id; // Almacenar permiso para rol

        // Vista de agregar nuevo prestamo (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.loans.new'], [ // Registro o actualización de permiso
            'name' => 'Vista de formulario para nuevo prestamo (Administrador)',
            'description' => 'Formulario para agregar nuevo prestamo de senaempresa',
            'description_english' => 'Form to add a new loan from senaempresa',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista de agregar nuevo prestamo (Lider Talento Humano)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.human_talent_leader.loans.new'], [ // Registro o actualización de permiso
            'name' => 'Vista de formulario para nuevo prestamo (Lider Talento Humano)',
            'description' => 'Formulario para agregar nuevo prestamo de senaempresa',
            'description_english' => 'Form to add a new loan from senaempresa',
            'app_id' => $app->id
        ]);
        $permissions_human_talent_leader[] = $permission->id; // Almacenar permiso para rol

        // guardar nuevo prestamo (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.loans.saved'], [ // Registro o actualización de permiso
            'name' => 'Guardar nuevo prestamo (Administrador)',
            'description' => 'Formulario para guardar nuevo prestamo de senaempresa',
            'description_english' => 'Form to save new loan of senaempresa',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // guardar nuevo prestamo (Lider Talento Humano)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.human_talent_leader.loans.saved'], [ // Registro o actualización de permiso
            'name' => 'Guardar nuevo prestamo (Lider Talento Humano)',
            'description' => 'Formulario para guardar nuevo prestamo de senaempresa',
            'description_english' => 'Form to save new loan of senaempresa',
            'app_id' => $app->id
        ]);
        $permissions_human_talent_leader[] = $permission->id; // Almacenar permiso para rol

        // Vista de editar los prestamos de senaempresa (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.loans.edit'], [ // Registro o actualización de permiso
            'name' => 'Vista de formulario para editar los prestamos (Administrador)',
            'description' => 'Formulario para editar los prestamos de senaempresa',
            'description_english' => 'Form for editing senaempresa loans',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista de editar los prestamos de senaempresa (Lider Talento Humano)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.human_talent_leader.loans.edit'], [ // Registro o actualización de permiso
            'name' => 'Vista de formulario para editar los prestamos (Lider Talento Humano)',
            'description' => 'Formulario para editar los prestamos de senaempresa',
            'description_english' => 'Form for editing senaempresa loans',
            'app_id' => $app->id
        ]);
        $permissions_human_talent_leader[] = $permission->id; // Almacenar permiso para rol

        // Actualizar prestamos de senaempresa (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.loans.updated'], [ // Registro o actualización de permiso
            'name' => 'Actualizar los prestamos (Administrador)',
            'description' => 'Formulario para actualizar los prestamos de senaempresa',
            'description_english' => 'Form to update senaempresa loan information',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Actualizar prestamos de senaempresa (Lider Talento Humano)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.human_talent_leader.loans.updated'], [ // Registro o actualización de permiso
            'name' => 'Actualizar los prestamos (Lider Talento Humano)',
            'description' => 'Formulario para actualizar los prestamos de senaempresa',
            'description_english' => 'Form to update senaempresa loan information',
            'app_id' => $app->id
        ]);
        $permissions_human_talent_leader[] = $permission->id; // Almacenar permiso para rol

        // Devolver prestamos de senaempresa (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.loans.return'], [ // Registro o actualización de permiso
            'name' => 'Devolver los prestamos (Administrador)',
            'description' => 'Botón para devolver los prestamos de senaempresa',
            'description_english' => 'Button to repay senaempresa loans',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Devolver prestamos de senaempresa (Lider Talento Humano)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.human_talent_leader.loans.return'], [ // Registro o actualización de permiso
            'name' => 'Devolver los prestamos (Lider Talento Humano)',
            'description' => 'Botón para devolver los prestamos de senaempresa',
            'description_english' => 'Button to repay senaempresa loans',
            'app_id' => $app->id
        ]);
        $permissions_human_talent_leader[] = $permission->id; // Almacenar permiso para rol

        // Vista de vacantes (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.vacancies.index'], [ // Registro o actualización de permiso
            'name' => 'Vista vacantes (Administrador)',
            'description' => 'Puede ver el listado de los vacantes',
            'description_english' => 'You can see the list of vacancies',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista de vacantes (Aprendiz)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.apprentice.vacancies.index'], [ // Registro o actualización de permiso
            'name' => 'Vista vacantes (Aprendiz)',
            'description' => 'Puede ver el listado de los vacantes',
            'description_english' => 'You can see the list of vacancies',
            'app_id' => $app->id
        ]);
        $permissions_apprentice[] = $permission->id; // Almacenar permiso para rol

        // Filtar vacantes por senaempresa (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.vacancies.filter'], [ // Registro o actualización de permiso
            'name' => 'Vista vacantes (Administrador)',
            'description' => 'Puede ver el listado de los vacantes',
            'description_english' => 'You can see the list of vacancies',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista de agregar nueva vacante de senaempresa (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.vacancies.new'], [
            'name' => 'Vista de formulario para nueva vacante (Administrador)',
            'description' => 'Formulario para agregar nueva vacante de senaempresa',
            'description_english' => 'Form to add new vacancy for senaempresa',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // guardar nueva vacante de senaempresa (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.vacancies.saved'], [ // Registro o actualización de permiso
            'name' => 'Guardar nueva vacante (Administrador)',
            'description' => 'Formulario para guardar nueva vacante de senaempresa',
            'description_english' => 'Form to save new vacancy of senaempresa',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista de editar vacante de senaempresa (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.vacancies.edit'], [ // Registro o actualización de permiso
            'name' => 'Vista de formulario para editar vacante (Administrador)',
            'description' => 'Formulario para editar vacante de senaempresa',
            'description_english' => 'Form to edit vacancy in senaempresa',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Actualizar vacante de senaempresa (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.vacancies.updated'], [ // Registro o actualización de permiso
            'name' => 'Actualizar vacante (Administrador)',
            'description' => 'Formulario para actualizar vacante de senaempresa',
            'description_english' => 'Senaempresa vacancy update form',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Eliminar vacante de senaempresa (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.vacancies.delete'], [ // Registro o actualización de permiso
            'name' => 'Eliminar vacante (Administrador)',
            'description' => 'Formulario para eliminar vacante de senaempresa',
            'description_english' => 'Form to delete vacancy from senaempresa',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista de asociar curso vacante (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.vacancies.partner_course'], [ // Registro o actualización de permiso
            'name' => 'Vista asociar curso con vacante (Administrador)',
            'description' => 'Puede ver las vacantes asociadas segun el curso',
            'description_english' => 'You can see the associated vacancies according to the course',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // actualizar las asociaciones de cursos vacantes (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.vacancies.show_associates'], [ // Registro o actualización de permiso
            'name' => 'Actualizar asociaciones cursos vacantes (Administrador)',
            'description' => 'Actualizar las asociaciones entre cursos y senaempresa',
            'description_english' => 'Update partnerships between courses and vacancies',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // consultar las asociaciones de cursos senampresa (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.vacancies.get_associations'], [ // Registro o actualización de permiso
            'name' => 'Consultar asociaciones cursos vacantes (Administrador)',
            'description' => 'Consultar las asociaciones entre cursos y vacantes',
            'description_english' => 'Consult partnerships between courses and vacancies',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista de inscripción a vacantes disponibles (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.vacancies.inscription'], [ // Registro o actualización de permiso
            'name' => 'Formulario de inscripción a vacantes (Administrador)',
            'description' => 'Formulario de inscripción a vacantes disponibles segun el curso',
            'description_english' => 'Enrollment to available vacancies according to the course',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista de inscripción a vacantes disponibles (Aprendiz)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.apprentice.vacancies.inscription'], [ // Registro o actualización de permiso
            'name' => 'Formulario de inscripción a vacantes (Aprendiz)',
            'description' => 'Formulario de inscripción a vacantes disponibles segun el curso',
            'description_english' => 'Enrollment to available vacancies according to the course',
            'app_id' => $app->id
        ]);
        $permissions_apprentice[] = $permission->id; // Almacenar permiso para rol

        // Inscripción a vacantes (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.vacancies.registered'], [ // Registro o actualización de permiso
            'name' => 'Inscripción a vacantes disponibles (Administrador)',
            'description' => 'Inscripción a vacantes disponibles segun el curso',
            'description_english' => 'Registration form for available vacancies according to the course',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Inscripción a vacantes (Aprendiz)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.apprentice.vacancies.registered'], [ // Registro o actualización de permiso
            'name' => 'Inscripción a vacantes disponibles (Aprendiz)',
            'description' => 'Inscripción a vacantes disponibles segun el curso',
            'description_english' => 'Registration form for available vacancies according to the course',
            'app_id' => $app->id
        ]);
        $permissions_apprentice[] = $permission->id; // Almacenar permiso para rol

        // Vista de postulados (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.postulates.index'], [ // Registro o actualización de permiso
            'name' => 'Vista postulados (Administrador)',
            'description' => 'Puede ver el listado de los postulados',
            'description_english' => 'You can see the list of postulates',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista de postulados (Psicologo)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.psychologo.postulates.index'], [ // Registro o actualización de permiso
            'name' => 'Vista postulados (Psicologo)',
            'description' => 'Puede ver el listado de los postulados',
            'description_english' => 'You can see the list of postulates',
            'app_id' => $app->id
        ]);
        $permissions_psychologo[] = $permission->id; // Almacenar permiso para rol

        // Vista de esatdo del postulado (Aprendiz)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.apprentice.postulates.state_apprentice'], [ // Registro o actualización de permiso
            'name' => 'Vista de estado del postulado (Aprendiz)',
            'description' => 'Vista del estado del postulado o aprendiz',
            'description_english' => 'Status view of the applicant or apprentice',
            'app_id' => $app->id
        ]);
        $permissions_apprentice[] = $permission->id; // Almacenar permiso para rol


        // Vista de asignar puntaje a los postulados (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.postulates.assign_score'], [ // Registro o actualización de permiso
            'name' => 'Vista de asignar puntaje (Administrador)',
            'description' => 'Vista de asignar puntaje a los postulados',
            'description_english' => 'View of assigning scores to postulates',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista de asignar puntaje a los postulados (Psicologo)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.psychologo.postulates.assign_score'], [ // Registro o actualización de permiso
            'name' => 'Vista postulados (Psicologo)',
            'description' => 'Puede ver el listado de los postulados',
            'description_english' => 'You can see the list of postulates',
            'app_id' => $app->id
        ]);
        $permissions_psychologo[] = $permission->id; // Almacenar permiso para rol

        // Asignar puntaje a los postulados (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.postulates.score_assigned'], [ // Registro o actualización de permiso
            'name' => ' Asignar puntaje (Administrador)',
            'description' => 'Asignar puntaje a los postulados',
            'description_english' => 'Assign scores to postulates',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Asignar puntaje a hoja de vida y propuesta de los postulados (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.postulates.cv'], [ // Registro o actualización de permiso
            'name' => ' Asignar puntaje a la hoja de vida y a la propuesta(Administrador)',
            'description' => 'Puede asignar puntaje a hoja de vida y propuesta de los postulados',
            'description_english' => 'You can assign scores to the postulates resume and proposal.',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista de asignar puntaje a los postulados (Psicologo)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.psychologo.postulates.score_assigned'], [ // Registro o actualización de permiso
            'name' => 'Vista postulados (Psicologo)',
            'description' => 'Puede ver el listado de los postulados',
            'description_english' => 'You can see the list of postulates',
            'app_id' => $app->id
        ]);
        $permissions_psychologo[] = $permission->id; // Almacenar permiso para rol

        // Vista de actualizar estado a los postulados (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.postulates.state'], [ // Registro o actualización de permiso
            'name' => 'Vista de actualizar estado (Administrador)',
            'description' => 'Vista de actualizar estado a los postulados',
            'description_english' => 'View to update status of postulates',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista de asignar puntaje a las personalidades de postulados (Psicologo)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.psychologo.postulates.personalities'], [ // Registro o actualización de permiso
            'name' => 'Asignar puntaje a las personalidades (Psicologo)',
            'description' => 'Puede asignar puntaje a las personalidades de los postulados',
            'description_english' => 'You can assign points to the personalities of the postulates',
            'app_id' => $app->id
        ]);
        $permissions_psychologo[] = $permission->id; // Almacenar permiso para rol

        // Actualizar estado a los postulados (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.postulates.state_updated'], [ // Registro o actualización de permiso
            'name' => 'Actualizar estado (Administrador)',
            'description' => 'Actualizar estado a los postulados',
            'description_english' => 'Update status to postulates',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista de seleccionados (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.postulates.selected'], [ // Registro o actualización de permiso
            'name' => 'Vista seleccionados (Administrador)',
            'description' => 'Puede ver el listado de los seleccionados de senaempresa',
            'description_english' => 'You can see the list of those selected by senaempresa',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista descargar reporte de seleccionados (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.postulates.selected.generatepdf'], [ // Registro o actualización de permiso
            'name' => 'Vista descargar reporte de seleccionados (Administrador)',
            'description' => 'Puede descargar reporte de seleccionados de senaempresa',
            'description_english' => 'You can download senaempresa report of selected companies.',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol


        // Vista de cargos (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.positions.index'], [ // Registro o actualización de permiso
            'name' => 'Vista cargos (Administrador)',
            'description' => 'Puede ver el listado de los cargos de senaempresa',
            'description_english' => 'You can view the list of senaempresa positions',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista de agregar nuevo cargo de senaempresa (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.positions.new'], [ // Registro o actualización de permiso
            'name' => 'Vista de formulario para nuevo cargo (Administrador)',
            'description' => 'Formulario para agregar nuevo cargo de senaempresa',
            'description_english' => 'Form for adding new senaempresa position',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // guardar nuevo cargo de senaempresa (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.positions.saved'], [ // Registro o actualización de permiso
            'name' => 'Guardar nuevo cargo (Administrador)',
            'description' => 'Formulario para guardar nuevo cargo de senaempresa',
            'description_english' => 'Form to save new position of senaempresa',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista de editar cargo de senaempresa (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.positions.edit'], [ // Registro o actualización de permiso
            'name' => 'Vista de formulario para editar cargo (Administrador)',
            'description' => 'Formulario para editar cargo de senaempresa',
            'description_english' => 'Form to edit senaempresa position',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Actualizar cargo de senaempresa (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.positions.updated'], [ // Registro o actualización de permiso
            'name' => 'Actualizar cargo (Administrador)',
            'description' => 'Formulario para actualizar cargo de senaempresa',
            'description_english' => 'Form to update senaempresa position',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Eliminar cargo de senaempresa (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.positions.delete'], [ // Registro o actualización de permiso
            'name' => 'Eliminar cargo (Administrador)',
            'description' => 'Formulario para eliminar cargo de senaempresa',
            'description_english' => 'Form to delete charge from senaempresa',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista de asistencia (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.attendances.index'], [ // Registro o actualización de permiso
            'name' => 'Vista asistencia (Administrador)',
            'description' => 'Puede ver la vista para el registro de asistencia',
            'description_english' => 'You can see the view for the attendance record',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista de asistencia (Lider Talento Humano)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.human_talent_leader.attendances.index'], [ // Registro o actualización de permiso
            'name' => 'Vista asistencia (Lider Talento Humano)',
            'description' => 'Puede ver la vista para el registro de asistencia',
            'description_english' => 'You can see the view for the attendance record',
            'app_id' => $app->id
        ]);
        $permissions_human_talent_leader[] = $permission->id; // Almacenar permiso para rol

        // Vista de asistencia (Aprendiz)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.apprentice.attendances.index'], [ // Registro o actualización de permiso
            'name' => 'Vista asistencia (Aprendiz)',
            'description' => 'Puede ver la vista de asistencia',
            'description_english' => 'You can see the support view',
            'app_id' => $app->id
        ]);
        $permissions_apprentice[] = $permission->id; // Almacenar permiso para rol

        // Regsitrar asistencia (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.attendances.register'], [ // Registro o actualización de permiso
            'name' => 'Registrar asistencia senaempresa (Administrador)',
            'description' => 'Registrar asistencia del personal de senaempresa',
            'description_english' => 'Register attendance of senaempresa staff',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Regsitrar asistencia (Lider Talento Humano)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.human_talent_leader.attendances.register'], [ // Registro o actualización de permiso
            'name' => 'Registrar asistencia senaempresa (Lider Talento Humano)',
            'description' => 'Registrar asistencia del personal de senaempresa',
            'description_english' => 'Register attendance of senaempresa staff',
            'app_id' => $app->id
        ]);
        $permissions_human_talent_leader[] = $permission->id; // Almacenar permiso para rol

        // Consultar asistencia por numero de documento (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.attendances.queryAttendance'], [ // Registro o actualización de permiso
            'name' => 'Consultar asistencia senaempresa (Administrador)',
            'description' => 'Consultar asistencia del personal por documento',
            'description_english' => 'Consult staff attendance by document',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Consultar asistencia por numero de documento (Lider Talento Humano)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.human_talent_leader.attendances.queryAttendance'], [ // Registro o actualización de permiso
            'name' => 'Consultar asistencia senaempresa (Lider Talento Humano)',
            'description' => 'Consultar asistencia del personal por documento',
            'description_english' => 'Consult staff attendance by document',
            'app_id' => $app->id
        ]);
        $permissions_human_talent_leader[] = $permission->id; // Almacenar permiso para rol

        // Consultar asistencia por senaempresa (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.attendances.loadAttendancesBySenaempresa'], [ // Registro o actualización de permiso
            'name' => 'Consultar asistencia por senaempresa (Administrador)',
            'description' => 'Consultar asistencia del personal por senaempresa',
            'description_english' => 'Consult staff attendance by senaempresa',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Consultar asistencia por senaempresa (Lider Talento Humano)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.human_talent_leader.attendances.loadAttendancesBySenaempresa'], [ // Registro o actualización de permiso
            'name' => 'Consultar asistencia por senaempresa (Lider Talento Humano)',
            'description' => 'Consultar asistencia del personal por senaempresa',
            'description_english' => 'Consult staff attendance by senaempresa',
            'app_id' => $app->id
        ]);
        $permissions_human_talent_leader[] = $permission->id; // Almacenar permiso para rol

        // Consultar reporte de personal por senaempresa (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.attendances.loadReportBySenaempresa'], [ // Registro o actualización de permiso
            'name' => 'Consultar asistencia por senaempresa (Administrador)',
            'description' => 'Consultar reporte del personal por senaempresa',
            'description_english' => 'Consult staff report by senaempresa',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Consultar reporte de personal por senaempresa (Lider Talento Humano)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.human_talent_leader.attendances.loadReportBySenaempresa'], [ // Registro o actualización de permiso
            'name' => 'Consultar asistencia por senaempresa (Lider Talento Humano)',
            'description' => 'Consultar reporte del personal por senaempresa',
            'description_english' => 'Consult staff report by senaempresa',
            'app_id' => $app->id
        ]);
        $permissions_human_talent_leader[] = $permission->id; // Almacenar permiso para rol

        // Consultar personal por numero de documento (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.attendances.loadStaffBySenaempresa'], [
            'name' => 'Consultar personal senaempresa Administrador',
            'description' => 'Consultar personal de senaempresa por documento',
            'description_english' => 'Consult senaempresa personnel by document',
            'app_id' => $app->id
        ]);

        $permissions_admin[] = $permission->id; // Almacenar permiso para rol admin

        // Consultar personal por numero de documento (Lider Talento Humano)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.human_talent_leader.attendances.loadStaffBySenaempresa'], [
            'name' => 'Consultar personal senaempresa (Lider Talento Humano)',
            'description' => 'Consultar personal de senaempresa por documento',
            'description_english' => 'Consult senaempresa personnel by document',
            'app_id' => $app->id
        ]);

        $permissions_human_talent_leader[] = $permission->id; // Almacenar permiso para rol admin

        // menu de fases de senamepresa (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.phases'], [ // Registro o actualización de permiso
            'name' => 'Menu senaempresa (Administrador)',
            'description' => 'Puede ver menu de senaempresa',
            'description_english' => 'You can see senaempresa menu',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // menu de vacantes (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.vacancies'], [ // Registro o actualización de permiso
            'name' => 'Menu vacantes (Administrador)',
            'description' => 'Puede ver menu de vacantes',
            'description_english' => 'You can see vacancies menu',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // menu de postulados (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.postulates'], [ // Registro o actualización de permiso
            'name' => 'Menu postulados (Administrador)',
            'description' => 'Puede ver menu de postulados',
            'description_english' => 'You can see postulates menu',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // menu de postulados (Lider Talento Humano)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.human_talent_leader.postulates'], [ // Registro o actualización de permiso
            'name' => 'Menu postulados (Lider Talento Humano)',
            'description' => 'Puede ver menu de postulados',
            'description_english' => 'You can see postulates menu',
            'app_id' => $app->id
        ]);
        $permissions_human_talent_leader[] = $permission->id; // Almacenar permiso para rol

        // mostrar vacantes por cursos (Aprendiz)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.apprentice.vancancy-course'], [ // Registro o actualización de permiso
            'name' => 'Vacantes por curso (Aprendiz)',
            'description' => 'Mostrar vacantes por curso al que pertenece',
            'description_english' => 'Show vacancies by course to which you belong',
            'app_id' => $app->id
        ]);
        $permissions_apprentice[] = $permission->id; // Almacenar permiso para rol


         // manual de usuario (Administrador)
         $permission = Permission::updateOrCreate(['slug' => 'senaempresa.admin.manual_admin'], [ // Registro o actualización de permiso
            'name' => 'Manual de usuario (LAdministrador)',
            'description' => 'Puede ver manual de usuario del administrador',
            'description_english' => 'You can view the administrator user manual',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

         // manual de usuario (Lider Talento Humano)
         $permission = Permission::updateOrCreate(['slug' => 'senaempresa.human_talent_leader.manual_human_talent_leader'], [ // Registro o actualización de permiso
            'name' => 'Manual de usuario (Lider Talento Humano)',
            'description' => 'Puede ver manual de usuario del lider de talento humano',
            'description_english' => 'You can view the users manual for the human talent leader',
            'app_id' => $app->id
        ]);
        $permissions_human_talent_leader[] = $permission->id; // Almacenar permiso para rol

        // manual de usuario (Psicologo)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.psychologo.manual_psychologo'], [ // Registro o actualización de permiso
            'name' => 'Manual de usuario (Psicologo)',
            'description' => 'Puede ver manual de usuario del Psicologo',
            'description_english' => 'You can view the user manual for the Psicologo',
            'app_id' => $app->id
        ]);
        $permissions_psychologo[] = $permission->id; // Almacenar permiso para rol

        // manual de usuario (Aprendiz)
        $permission = Permission::updateOrCreate(['slug' => 'senaempresa.apprentice.manual_apprentice'], [ // Registro o actualización de permiso
            'name' => 'Manual de usuario (Aprendiz)',
            'description' => 'Puede ver manual de usuario del Aprendiz',
            'description_english' => 'You can view the user manual for the Appretice',
            'app_id' => $app->id
        ]);
        $permissions_apprentice[] = $permission->id; // Almacenar permiso para rol


        // Consulta de ROLES
        $rol_admin = Role::where('slug', 'senaempresa.admin')->first(); // Rol Administrador Senaempresa
        $rol_lider_talento_humano = Role::where('slug', 'senaempresa.human_talent_leader')->first(); // Rol Pasante Senaempresa
        $rol_psychologo = Role::where('slug', 'senaempresa.psychologo')->first(); // Rol Psicologo Senaempresa
        $rol_aprendiz = Role::where('slug', 'senaempresa.apprentice')->first(); // Rol Usuario Senaempresa

        // Asignación de PERMISOS para los ROLES de la aplicación SENAEMPRESA (Sincronización de las relaciones sin eliminar las relaciones existentes)
        $rol_admin->permissions()->syncWithoutDetaching($permissions_admin);
        $rol_lider_talento_humano->permissions()->syncWithoutDetaching($permissions_human_talent_leader);
        $rol_psychologo->permissions()->syncWithoutDetaching($permissions_psychologo);
        $rol_aprendiz->permissions()->syncWithoutDetaching($permissions_apprentice);
    }
}
