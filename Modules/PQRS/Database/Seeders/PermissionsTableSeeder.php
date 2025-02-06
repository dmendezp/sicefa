<?php

namespace Modules\PQRS\Database\Seeders;

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
        $permission_tracking = []; // Permisos para Administrador
        $permission_official = []; // Permisos para Almacenista

        $app = App::where('name','PQRS')->first();
        
        // Registro de todos los permisos para la aplicacion de AGROINDUSTRIA //
        // Vista Tipo de PQRS (Monitor)
        $permission = Permission::updateOrCreate(['slug' => 'pqrs.tracking.type_pqrs_index'], [
            'name' => 'Vista Tipo de PQRS',
            'description' => 'Puede ver la vista de Tipo de PQRS (Monitor).',
            'description_english' => 'You can see the PQRS Type view (Monitor).',
            'app_id' => $app->id
        ]);

        $permission_tracking[] = $permission->id; // Almacenar permiso para rol

        // Registrar Tipo de PQRS (Monitor)
        $permission = Permission::updateOrCreate(['slug' => 'pqrs.tracking.type_pqrs_store'], [
            'name' => 'Registrar Tipo de PQRS',
            'description' => 'Puede registrar el Tipo de PQRS (Monitor).',
            'description_english' => 'You can register the PQRS Type (Monitor).',
            'app_id' => $app->id
        ]);

        $permission_tracking[] = $permission->id; // Almacenar permiso para rol

        // Eliminar Tipo de PQRS (Monitor)
        $permission = Permission::updateOrCreate(['slug' => 'pqrs.tracking.type_pqrs_delete'], [
            'name' => 'Eliminar Tipo de PQRS',
            'description' => 'Puede eliminar el Tipo de PQRS (Monitor).',
            'description_english' => 'You can delete the PQRS Type (Monitor).',
            'app_id' => $app->id
        ]);

        $permission_tracking[] = $permission->id; // Almacenar permiso para rol

         // Vista de Seguimiento (Monitor)
         $permission = Permission::updateOrCreate(['slug' => 'pqrs.tracking.index'], [
            'name' => 'Vista de Seguimiento',
            'description' => 'Puede ver la vista de Seguimiento (Monitor).',
            'description_english' => 'You can see the Tracking view (Monitor).',
            'app_id' => $app->id
        ]);

        $permission_tracking[] = $permission->id;

        // Buscar pqrs (Monitor)
        $permission = Permission::updateOrCreate(['slug' => 'pqrs.tracking.search'], [
            'name' => 'Buscar pqrs por estado',
            'description' => 'Puede Buscar pqrs por estado (Monitor).',
            'description_english' => 'You can search pqrs for status (Monitor).',
            'app_id' => $app->id
         ]);
 
         $permission_tracking[] = $permission->id; // Almacenar permiso para rol

        // Buscar funcionario o apoyo (Monitor)
        $permission = Permission::updateOrCreate(['slug' => 'pqrs.tracking.searchOfficial'], [
           'name' => 'Buscar funcionario o apoyo',
           'description' => 'Puede buscar el funcionario o apoyo (Monitor).',
           'description_english' => 'You can search for the official or support (Monitor).',
           'app_id' => $app->id
        ]);

        $permission_tracking[] = $permission->id; // Almacenar permiso para rol

        // Vista de registrar PQRS (Monitor)
        $permission = Permission::updateOrCreate(['slug' => 'pqrs.tracking.create'], [
            'name' => 'Vista de registrar PQRS',
            'description' => 'Puede ver la vista para registrar una PQRS (Monitor).',
            'description_english' => 'You can see the view to register a PQRS (Monitor).',
            'app_id' => $app->id
        ]);

        $permission_tracking[] = $permission->id; // Almacenar permiso para rol

        // Registrar PQRS (Monitor)
        $permission = Permission::updateOrCreate(['slug' => 'pqrs.tracking.store'], [
            'name' => 'Registrar PQRS',
            'description' => 'Puede registrar una PQRS (Monitor).',
            'description_english' => 'You can register a PQRS (Monitor).',
            'app_id' => $app->id
        ]);

        $permission_tracking[] = $permission->id; // Almacenar permiso para rol

         // Vista de Cargar Excel (Monitor)
         $permission = Permission::updateOrCreate(['slug' => 'pqrs.tracking.excel'], [
            'name' => 'Vista de Cargar Excel',
            'description' => 'Puede ver la vista de Cargar Excel (Monitor).',
            'description_english' => 'You can see the Load Excel view (Monitor).',
            'app_id' => $app->id
        ]);

        $permission_tracking[] = $permission->id; // Almacenar permiso para rol

        // Cargar Excel Regional (Monitor)
        $permission = Permission::updateOrCreate(['slug' => 'pqrs.tracking.excel.store_excel_regional'], [
            'name' => 'Cargar Excel Regional',
            'description' => 'Puede cargar el Excel Regional (Monitor).',
            'description_english' => 'You can load the Excel Regional (Monitor).',
            'app_id' => $app->id
        ]);

        $permission_tracking[] = $permission->id; // Almacenar permiso para rol

        // Cargar Excel de Centro (Monitor)
        $permission = Permission::updateOrCreate(['slug' => 'pqrs.tracking.excel.store_excel_centro'], [
            'name' => 'Cargar Excel de Centro',
            'description' => 'Puede cargar el Excel de Centro (Monitor).',
            'description_english' => 'You can load the Excel from Centro (Monitor).',
            'app_id' => $app->id
        ]);

        $permission_tracking[] = $permission->id; // Almacenar permiso para rol

        // Enviar correo (Monitor)
        $permission = Permission::updateOrCreate(['slug' => 'pqrs.tracking.email'], [
            'name' => 'Enviar correo',
            'description' => 'Puede enviar correo de alerta (Monitor).',
            'description_english' => 'You can send alert email (Monitor).',
            'app_id' => $app->id
        ]);

        $permission_tracking[] = $permission->id; // Almacenar permiso para rol

        // Registrar Radicado de Respuesta (Monitor)
        $permission = Permission::updateOrCreate(['slug' => 'pqrs.tracking.filed_response'], [
            'name' => 'Registrar Radicado de Respuesta',
            'description' => 'Puede registrar el radicado de respuesta (Monitor).',
            'description_english' => 'You can register the response filing (Monitor).',
            'app_id' => $app->id
        ]);

        $permission_tracking[] = $permission->id; // Almacenar permiso para rol

        // Registrar respuesta (Monitor)
        $permission = Permission::updateOrCreate(['slug' => 'pqrs.tracking.answer.store'], [
            'name' => 'Registrar respuesta',
            'description' => 'Puede registrar la respuesta (Monitor).',
            'description_english' => 'You can record the response (Monitor).',
            'app_id' => $app->id
        ]);

        $permission_tracking[] = $permission->id;

        // Vista PQRS del funcionario (Funcionario)
        $permission = Permission::updateOrCreate(['slug' => 'pqrs.official.answer.index'], [
            'name' => 'Vista PQRS del funcionario',
            'description' => 'Puede ver la vista de PQRS (Funcionario).',
            'description_english' => 'You can see the PQRS view (Official).',
            'app_id' => $app->id
        ]);

        $permission_official[] = $permission->id; // Almacenar permiso para rol

        // Registrar respuesta (Funcionario)
        $permission = Permission::updateOrCreate(['slug' => 'pqrs.official.answer.store'], [
            'name' => 'Registrar respuesta',
            'description' => 'Puede registrar la respuesta (Funcionario).',
            'description_english' => 'You can record the response (Official).',
            'app_id' => $app->id
        ]);

        $permission_official[] = $permission->id;

        // Buscar funcionario o apoyo (Funcionario)
        $permission = Permission::updateOrCreate(['slug' => 'pqrs.official.answer.searchOfficial'], [
            'name' => 'Buscar funcionario o apoyo',
            'description' => 'Puede buscar el funcionario o apoyo (Funcionario).',
            'description_english' => 'You can search for the official or support (Official).',
            'app_id' => $app->id
        ]);

        $permission_official[] = $permission->id;

        // Reasignar PQRS (Funcionario)
        $permission = Permission::updateOrCreate(['slug' => 'pqrs.official.answer.reasign'], [
            'name' => 'Reasignar PQRS',
            'description' => 'Puede reasignar la PQRS (Funcionario)',
            'description_english' => 'You can assign the PQRS (Official).',
            'app_id' => $app->id
        ]);

        $permission_official[] = $permission->id; // Almacenar permiso para rol

        $rol_tracking = Role::where('slug', 'pqrs.tracking')->first(); // Rol Administrador
        $rol_official = Role::where('slug', 'pqrs.official')->first(); // Rol Coordinado Académico

        // Asignación de PERMISOS para los ROLES de la aplicación AGROINDUSTRIA (Sincronización de las relaciones sin eliminar las relaciones existentes)
        $rol_tracking->permissions()-> syncWithoutDetaching($permission_tracking);
        $rol_official->permissions()->syncWithoutDetaching($permission_official);
    }
}
