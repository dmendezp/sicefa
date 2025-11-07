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
        $permissions_admin = []; // Permisos para el Administrador
        $permissions_academic_coordinator = []; // Permisos para el Coordinador académico
        $permissions_attendance = []; // Permisos para el rol Asistencia
        $permissions_unitmanager = []; // Permisos para el rol Gestor de unidades


        // Consultar aplicación SICA para registrar los roles
        $app = App::where('name','SICA')->first();


        // ===================== Registro de todos los permisos de la aplicación SICA ==================
        /* // Panel de control del administrador (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.dashboard'], [ // Registro o actualización de permiso
            'name' => 'Panel de control del administrador (Administrador)',
            'description' => 'Panel de control del administrador',
            'description_english' => "Administrator's control panel",
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Panel de control del coordinador académico (Coordinador acádemico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.dashboard'], [ // Registro o actualización de permiso
            'name' => 'Panel de control del coordinador académico (Coordinador acádemico)',
            'description' => 'Panel de control del coordinador académico',
            'description_english' => "Academic coordinator's control panel",
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Panel de control de asistencias a eventos (Asistencia)
        $permission = Permission::updateOrCreate(['slug' => 'sica.attendance.dashboard'], [ // Registro o actualización de permiso
            'name' => 'Panel de control de asistencias a eventos (Asistencia)',
            'description' => 'Panel de control de asistencias a eventos',
            'description_english' => 'Event attendance control panel',
            'app_id' => $app->id
        ]);
        $permissions_attendance[] = $permission->id; // Almacenar permiso para rol

        // Vista principal de parámetros para datos de personas (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.people.config.index'], [ // Registro o actualización de permiso
            'name' => 'Vista principal de parámetros para datos de personas (Administrador)',
            'description' => 'Vista principal de parámetros para datos de personas',
            'description_english' => 'Main parameter view for person data',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista principal de parámetros para datos de personas (Coordinador académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.people.config.index'], [ // Registro o actualización de permiso
            'name' => 'Vista principal de parámetros para datos de personas (Coordinador académico)',
            'description' => 'Vista principal de parámetros para datos de personas',
            'description_english' => 'Main parameter view for person data',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Formulario de registro de EPS (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.people.config.eps.create'], [ // Registro o actualización de permiso
            'name' => 'Formulario de registro de EPS (Administrador)',
            'description' => 'Formulario de registro de EPS',
            'description_english' => 'EPS registration form',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Formulario de registro de EPS (Coordiandor académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.people.config.eps.create'], [ // Registro o actualización de permiso
            'name' => 'Formulario de registro de EPS (Coordiandor académico)',
            'description' => 'Formulario de registro de EPS',
            'description_english' => 'EPS registration form',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Registrar EPS (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.people.config.eps.store'], [ // Registro o actualización de permiso
            'name' => 'Registrar EPS (Administrador)',
            'description' => 'Registrar EPS',
            'description_english' => 'Register EPS',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Registrar EPS (Coordiandor académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.people.config.eps.store'], [ // Registro o actualización de permiso
            'name' => 'Registrar EPS (Coordiandor académico)',
            'description' => 'Registrar EPS',
            'description_english' => 'Register EPS',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Formulario de actualización de EPS (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.people.config.eps.edit'], [ // Registro o actualización de permiso
            'name' => 'Formulario de actualización de EPS (Administrador)',
            'description' => 'Formulario de actualización de EPS',
            'description_english' => 'EPS Update Form',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Formulario de actualización de EPS (Coordiandor académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.people.config.eps.edit'], [ // Registro o actualización de permiso
            'name' => 'Formulario de actualización de EPS (Coordiandor académico)',
            'description' => 'Formulario de actualización de EPS',
            'description_english' => 'EPS Update Form',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Actualizar EPS (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.people.config.eps.update'], [ // Registro o actualización de permiso
            'name' => 'Actualizar EPS (Administrador)',
            'description' => 'Actualizar EPS',
            'description_english' => 'Update EPS',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Actualizar EPS (Coordiandor académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.people.config.eps.update'], [ // Registro o actualización de permiso
            'name' => 'Actualizar EPS (Coordiandor académico)',
            'description' => 'Actualizar EPS',
            'description_english' => 'Update EPS',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Formulario de eliminación de EPS (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.people.config.eps.delete'], [ // Registro o actualización de permiso
            'name' => 'Formulario de eliminación de EPS (Administrador)',
            'description' => 'Formulario de eliminación de EPS',
            'description_english' => 'EPS elimination form',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Formulario de eliminación de EPS (Coordiandor académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.people.config.eps.delete'], [ // Registro o actualización de permiso
            'name' => 'Formulario de eliminación de EPS (Coordiandor académico)',
            'description' => 'Formulario de eliminación de EPS',
            'description_english' => 'EPS elimination form',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Eliminar EPS (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.people.config.eps.destroy'], [ // Registro o actualización de permiso
            'name' => 'Eliminar EPS (Administrador)',
            'description' => 'Eliminar EPS',
            'description_english' => 'Eliminate EPS',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Eliminar EPS (Coordiandor académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.people.config.eps.destroy'], [ // Registro o actualización de permiso
            'name' => 'Eliminar EPS (Coordiandor académico)',
            'description' => 'Eliminar EPS',
            'description_english' => 'Eliminate EPS',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Formulario de registro de grupo poblacional (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.people.config.population.create'], [ // Registro o actualización de permiso
            'name' => 'Formulario de registro de grupo poblacional (Administrador)',
            'description' => 'Formulario de registro de grupo poblacional',
            'description_english' => 'Population group registration form',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Formulario de registro de grupo poblacional (Coordiandor académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.people.config.population.create'], [ // Registro o actualización de permiso
            'name' => 'Formulario de registro de grupo poblacional (Coordiandor académico)',
            'description' => 'Formulario de registro de grupo poblacional',
            'description_english' => 'Population group registration form',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Registrar grupo poblacional (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.people.config.population.store'], [ // Registro o actualización de permiso
            'name' => 'Registrar grupo poblacional (Administrador)',
            'description' => 'Registrar grupo poblacional',
            'description_english' => 'Register population group',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Registrar grupo poblacional (Coordiandor académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.people.config.population.store'], [ // Registro o actualización de permiso
            'name' => 'Registrar grupo poblacional (Coordiandor académico)',
            'description' => 'Registrar grupo poblacional',
            'description_english' => 'Register population group',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Formulario de actualización de grupo poblacional (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.people.config.population.edit'], [ // Registro o actualización de permiso
            'name' => 'Formulario de actualización de grupo poblacional (Administrador)',
            'description' => 'Formulario de actualización de grupo poblacional',
            'description_english' => 'Population group update form',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Formulario de actualización de grupo poblacional (Coordiandor académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.people.config.population.edit'], [ // Registro o actualización de permiso
            'name' => 'Formulario de actualización de grupo poblacional (Coordiandor académico)',
            'description' => 'Formulario de actualización de grupo poblacional',
            'description_english' => 'Population group update form',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Actualizar grupo poblacional (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.people.config.population.update'], [ // Registro o actualización de permiso
            'name' => 'Actualizar grupo poblacional (Administrador)',
            'description' => 'Actualizar grupo poblacional',
            'description_english' => 'Update population group',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Actualizar grupo poblacional (Coordiandor académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.people.config.population.update'], [ // Registro o actualización de permiso
            'name' => 'Actualizar grupo poblacional (Coordiandor académico)',
            'description' => 'Actualizar grupo poblacional',
            'description_english' => 'Update population group',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Formulario para eliminar grupo poblacional (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.people.config.population.delete'], [ // Registro o actualización de permiso
            'name' => 'Formulario para eliminar grupo poblacional (Administrador)',
            'description' => 'Formulario para eliminar grupo poblacional',
            'description_english' => 'Form to eliminate population group',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Formulario para eliminar grupo poblacional (Coordiandor académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.people.config.population.delete'], [ // Registro o actualización de permiso
            'name' => 'Formulario para eliminar grupo poblacional (Coordiandor académico)',
            'description' => 'Formulario para eliminar grupo poblacional',
            'description_english' => 'Form to eliminate population group',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Eliminar grupo poblacional (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.people.config.population.destroy'], [ // Registro o actualización de permiso
            'name' => 'Eliminar grupo poblacional (Administrador)',
            'description' => 'Eliminar grupo poblacional',
            'description_english' => 'Eliminate population group',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Eliminar grupo poblacional (Coordiandor académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.people.config.population.destroy'], [ // Registro o actualización de permiso
            'name' => 'Eliminar grupo poblacional (Coordiandor académico)',
            'description' => 'Eliminar grupo poblacional',
            'description_english' => 'Eliminate population group',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Formulario de registro de evento (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.people.config.events.create'], [ // Registro o actualización de permiso
            'name' => 'Formulario de registro de evento (Administrador)',
            'description' => 'Formulario de registro de evento',
            'description_english' => 'Event registration form',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Formulario de registro de evento (Coordiandor académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.people.config.events.create'], [ // Registro o actualización de permiso
            'name' => 'Formulario de registro de evento (Coordiandor académico)',
            'description' => 'Formulario de registro de evento',
            'description_english' => 'Event registration form',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Registrar evento (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.people.config.events.store'], [ // Registro o actualización de permiso
            'name' => 'Registrar evento (Administrador)',
            'description' => 'Registrar evento',
            'description_english' => 'Register event',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Registrar evento (Coordiandor académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.people.config.events.store'], [ // Registro o actualización de permiso
            'name' => 'Registrar evento (Coordiandor académico)',
            'description' => 'Registrar evento',
            'description_english' => 'Register event',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Formulario de actualización de evento (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.people.config.events.edit'], [ // Registro o actualización de permiso
            'name' => 'Formulario de actualización de evento (Administrador)',
            'description' => 'Formulario de actualización de evento',
            'description_english' => 'Event update form',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Formulario de actualización de evento (Coordiandor académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.people.config.events.edit'], [ // Registro o actualización de permiso
            'name' => 'Formulario de actualización de evento (Coordiandor académico)',
            'description' => 'Formulario de actualización de evento',
            'description_english' => 'Event update form',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Actualizar evento (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.people.config.events.update'], [ // Registro o actualización de permiso
            'name' => 'Actualizar evento (Administrador)',
            'description' => 'Actualizar evento',
            'description_english' => 'Update event',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Actualizar evento (Coordiandor académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.people.config.events.update'], [ // Registro o actualización de permiso
            'name' => 'Actualizar evento (Coordiandor académico)',
            'description' => 'Actualizar evento',
            'description_english' => 'Update event',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Formulario para eliminar evento (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.people.config.events.delete'], [ // Registro o actualización de permiso
            'name' => 'Formulario para eliminar evento (Administrador)',
            'description' => 'Formulario para eliminar evento',
            'description_english' => 'Form to eliminate event',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Formulario para eliminar evento (Coordiandor académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.people.config.events.delete'], [ // Registro o actualización de permiso
            'name' => 'Formulario para eliminar evento (Coordiandor académico)',
            'description' => 'Formulario para eliminar evento',
            'description_english' => 'Form to eliminate event',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Eliminar evento (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.people.config.events.destroy'], [ // Registro o actualización de permiso
            'name' => 'Eliminar evento (Administrador)',
            'description' => 'Eliminar evento',
            'description_english' => 'Delete event',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Eliminar evento (Coordiandor académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.people.config.events.destroy'], [ // Registro o actualización de permiso
            'name' => 'Eliminar evento (Coordiandor académico)',
            'description' => 'Eliminar evento',
            'description_english' => 'Delete event',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Vista principal de datos personales (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.people.personal_data.index'], [ // Registro o actualización de permiso
            'name' => 'Vista principal de datos personales (Administrador)',
            'description' => 'Vista principal de datos personales',
            'description_english' => 'Main view of personal data',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista principal de datos personales (Coordinador académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.people.personal_data.index'], [ // Registro o actualización de permiso
            'name' => 'Vista principal de datos personales (Coordinador académico)',
            'description' => 'Vista principal de datos personales',
            'description_english' => 'Main view of personal data',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Buscar datos personales por número de documento (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.people.personal_data.search'], [ // Registro o actualización de permiso
            'name' => 'Buscar datos personales por número de documento (Administrador)',
            'description' => 'Buscar datos personales por número de documento',
            'description_english' => 'Search personal data by document number',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Buscar datos personales por número de documento (Coordinador académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.people.personal_data.search'], [ // Registro o actualización de permiso
            'name' => 'Buscar datos personales por número de documento (Coordinador académico)',
            'description' => 'Buscar datos personales por número de documento',
            'description_english' => 'Search personal data by document number',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Formulario de registro de datos personales (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.people.personal_data.create'], [ // Registro o actualización de permiso
            'name' => 'Formulario de registro de datos personales (Administrador)',
            'description' => 'Formulario de registro de datos personales',
            'description_english' => 'Personal data registration form',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Formulario de registro de datos personales (Coordinador académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.people.personal_data.create'], [ // Registro o actualización de permiso
            'name' => 'Formulario de registro de datos personales (Coordinador académico)',
            'description' => 'Formulario de registro de datos personales',
            'description_english' => 'Personal data registration form',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Registrar datos personales (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.people.personal_data.store'], [ // Registro o actualización de permiso
            'name' => 'Registrar datos personales (Administrador)',
            'description' => 'Registrar datos personales',
            'description_english' => 'Register personal data',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Registrar datos personales (Coordinador académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.people.personal_data.store'], [ // Registro o actualización de permiso
            'name' => 'Registrar datos personales (Coordinador académico)',
            'description' => 'Registrar datos personales',
            'description_english' => 'Register personal data',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Formulario de actualización de datos personales (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.people.personal_data.edit'], [ // Registro o actualización de permiso
            'name' => 'Formulario de actualización de datos personales (Administrador)',
            'description' => 'Formulario de actualización de datos personales',
            'description_english' => 'Personal data update form',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Formulario de actualización de datos personales (Coordinador académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.people.personal_data.edit'], [ // Registro o actualización de permiso
            'name' => 'Formulario de actualización de datos personales (Coordinador académico)',
            'description' => 'Formulario de actualización de datos personales',
            'description_english' => 'Personal data update form',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Actualizar datos personales (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.people.personal_data.update'], [ // Registro o actualización de permiso
            'name' => 'Actualizar datos personales (Administrador)',
            'description' => 'Actualizar datos personales',
            'description_english' => 'Update personal data',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Actualizar datos personales (Coordinador académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.people.personal_data.update'], [ // Registro o actualización de permiso
            'name' => 'Actualizar datos personales (Coordinador académico)',
            'description' => 'Actualizar datos personales',
            'description_english' => 'Update personal data',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Formulario para carga de archivo con datos personales de personas (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.people.personal_data.load.create'], [ // Registro o actualización de permiso
            'name' => 'Formulario para carga de archivo con datos personales de personas (Administrador)',
            'description' => 'Formulario para carga de archivo con datos personales de personas',
            'description_english' => 'Update personal data',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Formulario para carga de archivo con datos personales de personas (Coordinador académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.people.personal_data.load.create'], [ // Registro o actualización de permiso
            'name' => 'Formulario para carga de archivo con datos personales de personas (Coordinador académico)',
            'description' => 'Formulario para carga de archivo con datos personales de personas',
            'description_english' => 'Update personal data',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Registro de datos personales a partir de un archivo (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.people.personal_data.load.store'], [ // Registro o actualización de permiso
            'name' => 'Registro de datos personales a partir de un archivo (Administrador)',
            'description' => 'Registro de datos personales a partir de un archivo',
            'description_english' => 'Recording of personal data from a file',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Registro de datos personales a partir de un archivo (Coordinador académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.people.personal_data.load.store'], [ // Registro o actualización de permiso
            'name' => 'Registro de datos personales a partir de un archivo (Coordinador académico)',
            'description' => 'Registro de datos personales a partir de un archivo',
            'description_english' => 'Recording of personal data from a file',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Vista principal para consultar aprendices por titulación (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.people.apprentices.index'], [ // Registro o actualización de permiso
            'name' => 'Vista principal para consultar aprendices por titulación (Administrador)',
            'description' => 'Puede acceder a lista de aprendices por titulación',
            'description_english' => 'You can access the list of apprentices by program',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista principal para consultar aprendices por titulación (Coordinador académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.people.apprentices.index'], [ // Registro o actualización de permiso
            'name' => 'Vista principal para consultar aprendices por titulación (Coordinador académico)',
            'description' => 'Puede acceder a lista de aprendices por titulación',
            'description_english' => 'You can access the list of apprentices by program',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Consultar aprendices por titulación (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.people.apprentices.search'], [ // Registro o actualización de permiso
            'name' => 'Consultar aprendices por titulación (Administrador)',
            'description' => 'Consultar aprendices por titulación',
            'description_english' => 'Consult apprentices by course',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Consultar aprendices por titulación (Coordinación académica)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.people.apprentices.search'], [ // Registro o actualización de permiso
            'name' => 'Consultar aprendices por titulación (Coordinación académica)',
            'description' => 'Consultar aprendices por titulación',
            'description_english' => 'Consult apprentices by course',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Formulario para carga de archivo con datos de aprendices (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.people.apprentices.load.create'], [ // Registro o actualización de permiso
            'name' => 'Formulario para carga de archivo con datos de aprendices (Administrador)',
            'description' => 'Formulario para carga de archivo con datos de aprendices',
            'description_english' => 'Form for uploading file with apprentices data',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Formulario para carga de archivo con datos de aprendices (Coordinador académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.people.apprentices.load.create'], [ // Registro o actualización de permiso
            'name' => 'Formulario para carga de archivo con datos de aprendices (Coordinador académico)',
            'description' => 'Formulario para carga de archivo con datos de aprendices',
            'description_english' => 'Form for uploading file with apprentices data',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Registrar de aprendices a partir de un archivo (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.people.apprentices.load.store'], [ // Registro o actualización de permiso
            'name' => 'Registrar de aprendices a partir de un archivo (Administrador)',
            'description' => 'Registrar de aprendices a partir de un archivo',
            'description_english' => 'Register of apprentices from a file',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Registrar de aprendices a partir de un archivo (Coordinador académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.people.apprentices.load.store'], [ // Registro o actualización de permiso
            'name' => 'Registrar de aprendices a partir de un archivo (Coordinador académico)',
            'description' => 'Registrar de aprendices a partir de un archivo',
            'description_english' => 'Register of apprentices from a file',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Vista principal de instructores (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.people.instructors.index'], [ // Registro o actualización de permiso
            'name' => 'Vista principal de instructores (Administrador)',
            'description' => 'Puede acceder a lista de instructores',
            'description_english' => 'You can access the list of instructors',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista principal de instructores (Coordinador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.people.instructors.index'], [ // Registro o actualización de permiso
            'name' => 'Vista principal de instructores (Administrador)',
            'description' => 'Puede acceder a lista de instructores',
            'description_english' => 'You can access the list of instructors',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Vista principal de funcionarios (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.people.employees.index'], [ // Registro o actualización de permiso
            'name' => 'Vista principal de funcionarios (Administrador)',
            'description' => 'Puede acceder a lista de funcionarios',
            'description_english' => 'You can access the list of officers',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista principal de funcionarios (Coordinador académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.people.employees.index'], [ // Registro o actualización de permiso
            'name' => 'Vista principal de funcionarios (Coordinador académico)',
            'description' => 'Puede acceder a lista de funcionarios',
            'description_english' => 'You can access the list of officers',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Vista principal de contratistas (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.people.contractors.index'], [ // Registro o actualización de permiso
            'name' => 'Vista principal de contratistas (Administrador)',
            'description' => 'Puede acceder a lista de contratistas',
            'description_english' => 'You can access the list of contractors',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Vista principal de contratistas (Coordinador académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.people.contractors.index'], [ // Registro o actualización de permiso
            'name' => 'Vista principal de contratistas (Coordinador académico)',
            'description' => 'Puede acceder a lista de contratistas',
            'description_english' => 'You can access the list of contractors',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Panel de control de asistencias de eventos (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.events_attendance_dashboard'], [ // Registro o actualización de permiso
            'name' => 'Panel de control de asistencias de eventos (Administrador)',
            'description' => 'Panel de control de asistenciaa de eventos',
            'description_english' => 'Events attendance control panel',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Formulario de registro de asistencia a eventos (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.people.events_attendance.index'], [ // Registro o actualización de permiso
            'name' => 'Formulario de registro de asistencia a eventos (Administrador)',
            'description' => 'Formulario de registro de asistencia a eventos',
            'description_english' => 'Event attendance registration form',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Formulario de registro de asistencia a eventos (Asistencia)
        $permission = Permission::updateOrCreate(['slug' => 'sica.attendance.people.events_attendance.index'], [ // Registro o actualización de permiso
            'name' => 'Formulario de registro de asistencia a eventos (Asistencia)',
            'description' => 'Formulario de registro de asistencia a eventos',
            'description_english' => 'Event attendance registration form',
            'app_id' => $app->id
        ]);
        $permissions_attendance[] = $permission->id; // Almacenar permiso para rol

        // Buscar o registrar datos básicos de persona para registrar asistencia a evento (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.people.basic_data.search'], [ // Registro o actualización de permiso
            'name' => 'Buscar o registrar datos básicos de persona para registrar asistencia a evento (Administrador)',
            'description' => 'Permite buscar los datos de una persona por número de documento para registrar su asistencia',
            'description_english' => "Allows you to search for a person's data by document number to register their attendance",
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Buscar o registrar datos básicos de persona para registrar asistencia a evento (Asistencia)
        $permission = Permission::updateOrCreate(['slug' => 'sica.attendance.people.basic_data.search'], [ // Registro o actualización de permiso
            'name' => 'Buscar o registrar datos básicos de persona para registrar asistencia a evento (Asistencia)',
            'description' => 'Permite buscar los datos de una persona por número de documento para registrar su asistencia',
            'description_english' => "Allows you to search for a person's data by document number to register their attendance",
            'app_id' => $app->id
        ]);
        $permissions_attendance[] = $permission->id; // Almacenar permiso para rol

        // Registrar datos básicos de personas y asistencia a evento (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.people.basic_data.store'], [ // Registro o actualización de permiso
            'name' => 'Registrar datos básicos de personas y asistencia a evento (Administrador)',
            'description' => 'Permite registrar datos personales básicos y asistencia a evento',
            'description_english' => 'Allows you to record basic personal data and event assistance',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Registrar datos básicos de personas y asistencia a evento (Asistencia)
        $permission = Permission::updateOrCreate(['slug' => 'sica.attendance.people.basic_data.store'], [ // Registro o actualización de permiso
            'name' => 'Registrar datos básicos de personas y asistencia a evento (Asistencia)',
            'description' => 'Permite registrar datos personales básicos y asistencia a evento',
            'description_english' => 'Allows you to record basic personal data and event assistance',
            'app_id' => $app->id
        ]);
        $permissions_attendance[] = $permission->id; // Almacenar permiso para rol

        // Listado de días festivos registrados (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.academy.holidays.index'], [ // Registro o actualización de permiso
            'name' => 'Listado de días festivos registrados (Administrador)',
            'description' => 'Listado de días festivos registrados',
            'description_english' => 'List of registered holidays',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Listado de días festivos registrados (Coordinador académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.academy.holidays.index'], [ // Registro o actualización de permiso
            'name' => 'Listado de días festivos registrados (Coordinador académico)',
            'description' => 'Listado de días festivos registrados',
            'description_english' => 'List of registered holidays',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Registrar día festivo (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.academy.holidays.store'], [ // Registro o actualización de permiso
            'name' => 'Registrar día festivo (Administrador)',
            'description' => 'Registrar día festivo',
            'description_english' => 'Register holiday',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Registrar día festivo (Coordinador académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.academy.holidays.store'], [ // Registro o actualización de permiso
            'name' => 'Registrar día festivo (Coordinador académico)',
            'description' => 'Registrar día festivo',
            'description_english' => 'Register holiday',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Formulario para actualizar día festivo (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.academy.holidays.edit'], [ // Registro o actualización de permiso
            'name' => 'Formulario para actualizar día festivo (Administrador)',
            'description' => 'Formulario para actualizar día festivo',
            'description_english' => 'Holiday update form',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Formulario para actualizar día festivo (Coordinador académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.academy.holidays.edit'], [ // Registro o actualización de permiso
            'name' => 'Formulario para actualizar día festivo (Coordinador académico)',
            'description' => 'Formulario para actualizar día festivo',
            'description_english' => 'Holiday update form',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Actualizar día festivo (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.academy.holidays.update'], [ // Registro o actualización de permiso
            'name' => 'Actualizar día festivo (Administrador)',
            'description' => 'Actualizar día festivo',
            'description_english' => 'Update holiday',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Actualizar día festivo (Coordinador académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.academy.holidays.update'], [ // Registro o actualización de permiso
            'name' => 'Actualizar día festivo (Coordinador académico)',
            'description' => 'Actualizar día festivo',
            'description_english' => 'Update holiday',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Eliminar día festivo (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.academy.holidays.destroy'], [ // Registro o actualización de permiso
            'name' => 'Eliminar día festivo (Administrador)',
            'description' => 'Eliminar día festivo',
            'description_english' => 'Eliminate holiday',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Eliminar día festivo (Coordinador académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.academy.holidays.destroy'], [ // Registro o actualización de permiso
            'name' => 'Eliminar día festivo (Coordinador académico)',
            'description' => 'Eliminar día festivo',
            'description_english' => 'Eliminate holiday',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Listado de trimestres registrados (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.academy.quarters.index'], [ // Registro o actualización de permiso
            'name' => 'Listado de trimestres registrados (Administrador)',
            'description' => 'Listado de trimestres registrados',
            'description_english' => 'List of registered quarters',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Listado de trimestres registrados (Coordinador académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.academy.quarters.index'], [ // Registro o actualización de permiso
            'name' => 'Listado de trimestres registrados (Coordinador académico)',
            'description' => 'Listado de trimestres registrados',
            'description_english' => 'List of registered quarters',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Formulario de registro de trimestre (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.academy.quarters.create'], [ // Registro o actualización de permiso
            'name' => 'Formulario de registro de trimestre (Administrador)',
            'description' => 'Formulario de registro de trimestre',
            'description_english' => 'Quarter registration form',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Formulario de registro de trimestre (Coordinador académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.academy.quarters.create'], [ // Registro o actualización de permiso
            'name' => 'Formulario de registro de trimestre (Coordinador académico)',
            'description' => 'Formulario de registro de trimestre',
            'description_english' => 'Quarter registration form',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Registrar trimestre (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.academy.quarters.store'], [ // Registro o actualización de permiso
            'name' => 'Registrar trimestre (Administrador)',
            'description' => 'Registrar trimestre',
            'description_english' => 'Registrer quarter',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Registrar trimestre (Coordinador académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.academy.quarters.store'], [ // Registro o actualización de permiso
            'name' => 'Registrar trimestre (Coordinador académico)',
            'description' => 'Registrar trimestre',
            'description_english' => 'Registrer quarter',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Formulario de actualización de trimestre (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.academy.quarters.edit'], [ // Registro o actualización de permiso
            'name' => 'Formulario de actualización de trimestre (Administrador)',
            'description' => 'Formulario de actualización de trimestre',
            'description_english' => 'Quarter update form',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Formulario de actualización de trimestre (Coordinador acádemico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.academy.quarters.edit'], [ // Registro o actualización de permiso
            'name' => 'Formulario de actualización de trimestre (Coordinador acádemico)',
            'description' => 'Formulario de actualización de trimestre',
            'description_english' => 'Quarter update form',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Actualizar trimestre (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.academy.quarters.update'], [ // Registro o actualización de permiso
            'name' => 'Actualizar trimestre (Administrador)',
            'description' => 'Actualizar trimestre',
            'description_english' => 'Update quarter',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Actualizar trimestre (Coordinador académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.academy.quarters.update'], [ // Registro o actualización de permiso
            'name' => 'Actualizar trimestre (Coordinador académico)',
            'description' => 'Actualizar trimestre',
            'description_english' => 'Update quarter',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Eliminar trimestre (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.academy.quarters.destroy'], [ // Registro o actualización de permiso
            'name' => 'Eliminar trimestre (Administrador)',
            'description' => 'Eliminar trimestre',
            'description_english' => 'Delete quarter',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Eliminar trimestre (Coordinador académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.academy.quarters.destroy'], [ // Registro o actualización de permiso
            'name' => 'Eliminar trimestre (Coordinador académico)',
            'description' => 'Eliminar trimestre',
            'description_english' => 'Delete quarter',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Listado de programas de formación registrados (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.academy.programs.index'], [ // Registro o actualización de permiso
            'name' => 'Listado de programas de formación registrados (Administrador)',
            'description' => 'Listado de programas de formación registrados',
            'description_english' => 'List of registered programs',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Listado de programas de formación registrados (Coordinador académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.academy.programs.index'], [ // Registro o actualización de permiso
            'name' => 'Listado de programas de formación registrados (Coordinador académico)',
            'description' => 'Listado de programas de formación registrados',
            'description_english' => 'List of registered programs',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Formulario de registro de programa de formación (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.academy.programs.create'], [ // Registro o actualización de permiso
            'name' => 'Formulario de registro de programa de formación (Administrador)',
            'description' => 'Formulario de registro de programa de formación',
            'description_english' => 'Program registration form',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Formulario de registro de programa de formación (Coordinador académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.academy.programs.create'], [ // Registro o actualización de permiso
            'name' => 'Formulario de registro de programa de formación (Coordinador académico)',
            'description' => 'Formulario de registro de programa de formación',
            'description_english' => 'Program registration form',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Registrar programa de formación (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.academy.programs.store'], [ // Registro o actualización de permiso
            'name' => 'Registrar programa de formación (Administrador)',
            'description' => 'Registrar programa de formación',
            'description_english' => 'Register program',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Registrar programa de formación (Coordinador académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.academy.programs.store'], [ // Registro o actualización de permiso
            'name' => 'Registrar programa de formación (Coordinador académico)',
            'description' => 'Registrar programa de formación',
            'description_english' => 'Register program',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Formulario de actualización de programa de formación (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.academy.programs.edit'], [ // Registro o actualización de permiso
            'name' => 'Formulario de actualización de programa de formación (Administrador)',
            'description' => 'Formulario de actualización de programa de formación',
            'description_english' => 'Program update form',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Formulario de actualización de programa de formación (Coordinador académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.academy.programs.edit'], [ // Registro o actualización de permiso
            'name' => 'Formulario de actualización de programa de formación (Coordinador académico)',
            'description' => 'Formulario de actualización de programa de formación',
            'description_english' => 'Program update form',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Actualizar programa de formación (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.academy.programs.update'], [ // Registro o actualización de permiso
            'name' => 'Actualizar programa de formación (Administrador)',
            'description' => 'Actualizar programa de formación',
            'description_english' => 'Update program',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Actualizar programa de formación (Coordinador académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.academy.programs.update'], [ // Registro o actualización de permiso
            'name' => 'Actualizar programa de formación (Coordinador académico)',
            'description' => 'Actualizar programa de formación',
            'description_english' => 'Update program',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Formulario de eliminación de programa de formación (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.academy.programs.delete'], [ // Registro o actualización de permiso
            'name' => 'Formulario de eliminación de programa de formación (Administrador)',
            'description' => 'Formulario de eliminación de programa de formación',
            'description_english' => 'Program elimination form',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Formulario de eliminación de programa de formación (Coordinador académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.academy.programs.delete'], [ // Registro o actualización de permiso
            'name' => 'Formulario de eliminación de programa de formación (Coordinador académico)',
            'description' => 'Formulario de eliminación de programa de formación',
            'description_english' => 'Program elimination form',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Eliminar programa de formación (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.academy.programs.destroy'], [ // Registro o actualización de permiso
            'name' => 'Eliminar programa de formación (Administrador)',
            'description' => 'Eliminar programa de formación',
            'description_english' => 'Delete program',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Eliminar programa de formación (Coordinador académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.academy.programs.destroy'], [ // Registro o actualización de permiso
            'name' => 'Eliminar programa de formación (Coordinador académico)',
            'description' => 'Eliminar programa de formación',
            'description_english' => 'Delete program',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Listado de redes de conocimiento registrados (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.academy.networks.index'], [ // Registro o actualización de permiso
            'name' => 'Listado de redes de conocimiento registrados (Administrador)',
            'description' => 'Listado de redes de conocimiento registrados',
            'description_english' => 'List of registered networks',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Listado de redes de conocimiento registrados (Coordinador académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.academy.networks.index'], [ // Registro o actualización de permiso
            'name' => 'Listado de redes de conocimiento registrados (Coordinador académico)',
            'description' => 'Listado de redes de conocimiento registrados',
            'description_english' => 'List of registered networks',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Formulario de registro de red de conocimiento (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.academy.networks.create'], [ // Registro o actualización de permiso
            'name' => 'Formulario de registro de red de conocimiento (Administrador)',
            'description' => 'Formulario de registro de red de conocimiento',
            'description_english' => 'Network registration form',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Formulario de registro de red de conocimiento (Coordinador académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.academy.networks.create'], [ // Registro o actualización de permiso
            'name' => 'Formulario de registro de red de conocimiento (Coordinador académico)',
            'description' => 'Formulario de registro de red de conocimiento',
            'description_english' => 'Network registration form',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Registrar red de conocimiento (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.academy.networks.store'], [ // Registro o actualización de permiso
            'name' => 'Registrar red de conocimiento (Administrador)',
            'description' => 'Registrar red de conocimiento',
            'description_english' => 'Register network',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Registrar red de conocimiento (Coordinador académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.academy.networks.store'], [ // Registro o actualización de permiso
            'name' => 'Registrar red de conocimiento (Coordinador académico)',
            'description' => 'Registrar red de conocimiento',
            'description_english' => 'Register network',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Formulario de actualización de red de conocimiento (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.academy.networks.edit'], [ // Registro o actualización de permiso
            'name' => 'Formulario de actualización de red de conocimiento (Administrador)',
            'description' => 'Formulario de actualización de red de conocimiento',
            'description_english' => 'Network update form',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Formulario de actualización de red de conocimiento (Coordinador académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.academy.networks.edit'], [ // Registro o actualización de permiso
            'name' => 'Formulario de actualización de red de conocimiento (Coordinador académico)',
            'description' => 'Formulario de actualización de red de conocimiento',
            'description_english' => 'Network update form',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Actualizar red de conocimiento (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.academy.networks.update'], [ // Registro o actualización de permiso
            'name' => 'Actualizar red de conocimiento (Administrador)',
            'description' => 'Actualizar red de conocimiento',
            'description_english' => 'Update network',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Actualizar red de conocimiento (Coordinador académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.academy.networks.update'], [ // Registro o actualización de permiso
            'name' => 'Actualizar red de conocimiento (Coordinador académico)',
            'description' => 'Actualizar red de conocimiento',
            'description_english' => 'Update network',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Formulario de eliminación de red de conocimiento (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.academy.networks.delete'], [ // Registro o actualización de permiso
            'name' => 'Formulario de eliminación de red de conocimiento (Administrador)',
            'description' => 'Formulario de eliminación de red de conocimiento',
            'description_english' => 'Network delete form',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Formulario de eliminación de red de conocimiento (Coordinador académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.academy.networks.delete'], [ // Registro o actualización de permiso
            'name' => 'Formulario de eliminación de red de conocimiento (Coordinador académico)',
            'description' => 'Formulario de eliminación de red de conocimiento',
            'description_english' => 'Network delete form',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Eliminar red de conocimiento (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.academy.networks.destroy'], [ // Registro o actualización de permiso
            'name' => 'Eliminar red de conocimiento (Administrador)',
            'description' => 'Eliminar red de conocimiento',
            'description_english' => 'Delete network',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Eliminar red de conocimiento (Coordinador académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.academy.networks.destroy'], [ // Registro o actualización de permiso
            'name' => 'Eliminar red de conocimiento (Coordinador académico)',
            'description' => 'Eliminar red de conocimiento',
            'description_english' => 'Delete network',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Listado de líneas tecnológicas registradas (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.academy.lines.index'], [ // Registro o actualización de permiso
            'name' => 'Listado de líneas tecnológicas registradas (Administrador)',
            'description' => 'Listado de líneas tecnológicas registradas',
            'description_english' => 'List of registered lines',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Listado de líneas tecnológicas registradas (Coordinador académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.academy.lines.index'], [ // Registro o actualización de permiso
            'name' => 'Listado de líneas tecnológicas registradas (Coordinador académico)',
            'description' => 'Listado de líneas tecnológicas registradas',
            'description_english' => 'List of registered lines',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Formulario de registro de línea tecnológica (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.academy.lines.create'], [ // Registro o actualización de permiso
            'name' => 'Formulario de registro de línea tecnológica (Administrador)',
            'description' => 'Formulario de registro de línea tecnológica',
            'description_english' => 'Line registration form',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Formulario de registro de línea tecnológica (Coordinador académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.academy.lines.create'], [ // Registro o actualización de permiso
            'name' => 'Formulario de registro de línea tecnológica (Coordinador académico)',
            'description' => 'Formulario de registro de línea tecnológica',
            'description_english' => 'Line registration form',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Registrar línea tecnológica (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.academy.lines.store'], [ // Registro o actualización de permiso
            'name' => 'Registrar línea tecnológica (Administrador)',
            'description' => 'Registrar línea tecnológica',
            'description_english' => 'Register line',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Registrar línea tecnológica (Coordinador académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.academy.lines.store'], [ // Registro o actualización de permiso
            'name' => 'Registrar línea tecnológica (Coordinador académico)',
            'description' => 'Registrar línea tecnológica',
            'description_english' => 'Register line',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Formulario de actualización de línea tecnológica (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.academy.lines.edit'], [ // Registro o actualización de permiso
            'name' => 'Formulario de actualización de línea tecnológica (Administrador)',
            'description' => 'Formulario de actualización de línea tecnológica',
            'description_english' => 'Line update form',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Formulario de actualización de línea tecnológica (Coordinador académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.academy.lines.edit'], [ // Registro o actualización de permiso
            'name' => 'Formulario de actualización de línea tecnológica (Coordinador académico)',
            'description' => 'Formulario de actualización de línea tecnológica',
            'description_english' => 'Line update form',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Actualizar línea tecnológica (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.academy.lines.update'], [ // Registro o actualización de permiso
            'name' => 'Actualizar línea tecnológica (Administrador)',
            'description' => 'Actualizar línea tecnológica',
            'description_english' => 'Update line',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Actualizar línea tecnológica (Coordinador académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.academy.lines.update'], [ // Registro o actualización de permiso
            'name' => 'Actualizar línea tecnológica (Coordinador académico)',
            'description' => 'Actualizar línea tecnológica',
            'description_english' => 'Update line',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Formulario de eliminación de línea tecnológica (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.academy.lines.delete'], [ // Registro o actualización de permiso
            'name' => 'Formulario de eliminación de línea tecnológica (Administrador)',
            'description' => 'Formulario de eliminación de línea tecnológica',
            'description_english' => 'Line elimination form',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Formulario de eliminación de línea tecnológica (Coordinador académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.academy.lines.delete'], [ // Registro o actualización de permiso
            'name' => 'Formulario de eliminación de línea tecnológica (Coordinador académico)',
            'description' => 'Formulario de eliminación de línea tecnológica',
            'description_english' => 'Line elimination form',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Eliminar línea tecnológica (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.academy.lines.destroy'], [ // Registro o actualización de permiso
            'name' => 'Eliminar línea tecnológica (Administrador)',
            'description' => 'Eliminar línea tecnológica',
            'description_english' => 'Delete line',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Eliminar línea tecnológica (Coordinador académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.academy.lines.destroy'], [ // Registro o actualización de permiso
            'name' => 'Eliminar línea tecnológica (Coordinador académico)',
            'description' => 'Eliminar línea tecnológica',
            'description_english' => 'Delete line',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Listado de cursos registrados (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.academy.courses.index'], [ // Registro o actualización de permiso
            'name' => 'Listado de cursos registrados (Administrador)',
            'description' => 'Listado de cursos registrados',
            'description_english' => 'List of registered courses',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Listado de cursos registrados (Coordinador académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.academy.courses.index'], [ // Registro o actualización de permiso
            'name' => 'Listado de cursos registrados (Coordinador académico)',
            'description' => 'Listado de cursos registrados',
            'description_english' => 'List of registered courses',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Formulario de registro de curso (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.academy.courses.create'], [ // Registro o actualización de permiso
            'name' => 'Formulario de registro de curso (Administrador)',
            'description' => 'Formulario de registro de curso',
            'description_english' => 'Course registration form',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Formulario de registro de curso (Coordinador académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.academy.courses.create'], [ // Registro o actualización de permiso
            'name' => 'Formulario de registro de curso (Coordinador académico)',
            'description' => 'Formulario de registro de curso',
            'description_english' => 'Course registration form',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Registrar curso (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.academy.courses.store'], [ // Registro o actualización de permiso
            'name' => 'Registrar curso (Administrador)',
            'description' => 'Registrar curso',
            'description_english' => 'Register course',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Registrar curso (Coordinador académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.academy.courses.store'], [ // Registro o actualización de permiso
            'name' => 'Registrar curso (Coordinador académico)',
            'description' => 'Registrar curso',
            'description_english' => 'Register course',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Formulario de actualización de curso (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.academy.courses.edit'], [ // Registro o actualización de permiso
            'name' => 'Formulario de actualización de curso (Administrador)',
            'description' => 'Formulario de actualización de curso',
            'description_english' => 'Course update form',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Formulario de actualización de curso (Coordinador académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.academy.courses.edit'], [ // Registro o actualización de permiso
            'name' => 'Formulario de actualización de curso (Coordinador académico)',
            'description' => 'Formulario de actualización de curso',
            'description_english' => 'Course update form',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Actualizar curso (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.academy.courses.update'], [ // Registro o actualización de permiso
            'name' => 'Actualizar curso (Administrador)',
            'description' => 'Actualizar curso',
            'description_english' => 'Update course',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Actualizar curso (Coordinador académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.academy.courses.update'], [ // Registro o actualización de permiso
            'name' => 'Actualizar curso (Coordinador académico)',
            'description' => 'Actualizar curso',
            'description_english' => 'Update course',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Formulario de eliminación de curso (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.academy.courses.delete'], [ // Registro o actualización de permiso
            'name' => 'Formulario de eliminación de curso (Administrador)',
            'description' => 'Formulario de eliminación de curso',
            'description_english' => 'Course elimination form',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Formulario de eliminación de curso (Coordinador académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.academy.courses.delete'], [ // Registro o actualización de permiso
            'name' => 'Formulario de eliminación de curso (Coordinador académico)',
            'description' => 'Formulario de eliminación de curso',
            'description_english' => 'Course elimination form',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Eliminar curso (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.academy.courses.destroy'], [ // Registro o actualización de permiso
            'name' => 'Eliminar curso (Administrador)',
            'description' => 'Eliminar curso',
            'description_english' => 'Delete course',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Eliminar curso (Coordinador académico)
        $permission = Permission::updateOrCreate(['slug' => 'sica.academic_coordinator.academy.courses.destroy'], [ // Registro o actualización de permiso
            'name' => 'Eliminar curso (Coordinador académico)',
            'description' => 'Eliminar curso',
            'description_english' => 'Delete course',
            'app_id' => $app->id
        ]);
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol */



        // Listado de unidades productivas disponibles (Gestor Unidades)
        $permission = Permission::updateOrCreate(['slug' => 'sica.unitmanager.units.productive_unit.index'], [ // Registro o actualización de permiso
            'name' => 'Listado de unidades productivas disponibles (Gestor Unidades)',
            'description' => 'Listado de unidades productivas disponibles',
            'description_english' => 'List of available productive units',
            'app_id' => $app->id
        ]);
        $permissions_unitmanager[] = $permission->id; // Almacenar permiso para rol

        // Formulario de registro de unidad productiva (Gestor Unidades)
        $permission = Permission::updateOrCreate(['slug' => 'sica.unitmanager.units.productive_unit.create'], [ // Registro o actualización de permiso
            'name' => 'Formulario de registro de unidad productiva (Gestor Unidades)',
            'description' => 'Formulario de registro de unidad productiva',
            'description_english' => 'Production unit registration form',
            'app_id' => $app->id
        ]);
        $permissions_unitmanager[] = $permission->id; // Almacenar permiso para rol

        // Registrar unidad productiva (Gestor Unidades)
        $permission = Permission::updateOrCreate(['slug' => 'sica.unitmanager.units.productive_unit.store'], [ // Registro o actualización de permiso
            'name' => 'Registrar unidad productiva (Gestor Unidades)',
            'description' => 'Registrar unidad productiva',
            'description_english' => 'Register productive unit',
            'app_id' => $app->id
        ]);
        $permissions_unitmanager[] = $permission->id; // Almacenar permiso para rol

        // Consultar unidad productiva para su actualización (Gestor Unidades)
        $permission = Permission::updateOrCreate(['slug' => 'sica.unitmanager.units.productive_unit.edit'], [ // Registro o actualización de permiso
            'name' => 'Consultar unidad productiva para su actualización (Gestor Unidades)',
            'description' => 'Consultar unidad productiva para su actualización',
            'description_english' => 'Consult productive unit for update',
            'app_id' => $app->id
        ]);
        $permissions_unitmanager[] = $permission->id; // Almacenar permiso para rol

        // Actualizar unidad productiva (Gestor Unidades)
        $permission = Permission::updateOrCreate(['slug' => 'sica.unitmanager.units.productive_unit.update'], [ // Registro o actualización de permiso
            'name' => 'Actualizar unidad productiva (Gestor Unidades)',
            'description' => 'Actualizar unidad productiva',
            'description_english' => 'Update productive unit',
            'app_id' => $app->id
        ]);
        $permissions_unitmanager[] = $permission->id; // Almacenar permiso para rol

        // Formulario de eliminacion de la unidad productiva (Gestor Unidades)
        $permission = Permission::updateOrCreate(['slug' => 'sica.unitmanager.units.productive_unit.delete'], [ // Registro o actualización de permiso
            'name' => 'Formulario de eliminacion de la unidad productiva (Gestor Unidades)',
            'description' => 'Formulario de eliminacion de la unidad productiva',
            'description_english' => 'Productive unit elimination form',
            'app_id' => $app->id
        ]);
        $permissions_unitmanager[] = $permission->id; // Almacenar permiso para rol

        // Eliminar unidad productiva (Gestor Unidades)
        $permission = Permission::updateOrCreate(['slug' => 'sica.unitmanager.units.productive_unit.destroy'], [ // Registro o actualización de permiso
            'name' => 'Eliminar unidad productiva (Gestor Unidades)',
            'description' => 'Eliminar unidad productiva',
            'description_english' => 'Delete productive unit',
            'app_id' => $app->id
        ]);
        $permissions_unitmanager[] = $permission->id; // Almacenar permiso para rol

        // Listado de unidades productivas y bodegas asociadas (Gestor Unidades)
        $permission = Permission::updateOrCreate(['slug' => 'sica.unitmanager.units.pu_warehouses.index'], [ // Registro o actualización de permiso
            'name' => 'Listado de unidades productivas y bodegas asociadas (Gestor Unidades)',
            'description' => 'Listado de unidades productivas y bodegas asociadas',
            'description_english' => 'List of productive units and associated warehouses',
            'app_id' => $app->id
        ]);
        $permissions_unitmanager[] = $permission->id; // Almacenar permiso para rol

        // Registrar asociación de unidad productiva y bodega (Gestor Unidades)
        $permission = Permission::updateOrCreate(['slug' => 'sica.unitmanager.units.pu_warehouses.store'], [ // Registro o actualización de permiso
            'name' => 'Registrar asociación de unidad productiva y bodega (Gestor Unidades)',
            'description' => 'Registrar asociación de unidad productiva y bodega',
            'description_english' => 'Register association of productive unit and warehouse',
            'app_id' => $app->id
        ]);
        $permissions_unitmanager[] = $permission->id; // Almacenar permiso para rol

        // Formulario de eliminacion de la asociación de unidad productiva y bodega (Gestor Unidades)
        $permission = Permission::updateOrCreate(['slug' => 'sica.unitmanager.units.pu_warehouses.delete'], [ // Registro o actualización de permiso
            'name' => 'Formulario de eliminacion de la asociación de unidad productiva y bodega (Gestor Unidades)',
            'description' => 'Formulario de eliminacion de la asociación de unidad productiva y bodega',
            'description_english' => 'Form for elimination of the association of productive unit and warehouse',
            'app_id' => $app->id
        ]);
        $permissions_unitmanager[] = $permission->id; // Almacenar permiso para rol

        // Eliminar asociación de unidad productiva y bodega (Gestor Unidades)
        $permission = Permission::updateOrCreate(['slug' => 'sica.unitmanager.units.pu_warehouses.destroy'], [ // Registro o actualización de permiso
            'name' => 'Eliminar asociación de unidad productiva y bodega (Gestor Unidades)',
            'description' => 'Eliminar asociación de unidad productiva y bodega',
            'description_english' => 'Delete association of productive unit and warehouse',
            'app_id' => $app->id
        ]);
        $permissions_unitmanager[] = $permission->id; // Almacenar permiso para rol

        // Listado de ambientes y unidades productivas asociadas (Gestor Unidades)
        $permission = Permission::updateOrCreate(['slug' => 'sica.unitmanager.units.productive_units.environment_pus.index'], [ // Registro o actualización de permiso
            'name' => 'Listado de ambientes y unidades productivas asociadas (Gestor Unidades)',
            'description' => 'Listado de ambientes y unidades productivas asociadas',
            'description_english' => 'List of environments and associated productive units',
            'app_id' => $app->id
        ]);
        $permissions_unitmanager[] = $permission->id; // Almacenar permiso para rol

        // Registrar asociación de ambiente y unidad productiva (Gestor Unidades)
        $permission = Permission::updateOrCreate(['slug' => 'sica.unitmanager.units.productive_units.environment_pus.store'], [ // Registro o actualización de permiso
            'name' => 'Registrar asociación de ambiente y unidad productiva (Gestor Unidades)',
            'description' => 'Registrar asociación de ambiente y unidad productiva',
            'description_english' => 'Register environment association and productive unit',
            'app_id' => $app->id
        ]);
        $permissions_unitmanager[] = $permission->id; // Almacenar permiso para rol

        // Eliminar asociación de ambiente y unidad productiva (Gestor Unidades)
        $permission = Permission::updateOrCreate(['slug' => 'sica.unitmanager.units.productive_units.environment_pus.destroy'], [ // Registro o actualización de permiso
            'name' => 'Eliminar asociación de ambiente y unidad productiva (Gestor Unidades)',
            'description' => 'Eliminar asociación de ambiente y unidad productiva',
            'description_english' => 'Delete association of environment and productive unit',
            'app_id' => $app->id
        ]);
        $permissions_unitmanager[] = $permission->id; // Almacenar permiso para rol

        // Panel de control gestor de unidades (Gestor Unidades)
        $permission = Permission::updateOrCreate(['slug' => 'sica.unitmanager.dashboard'], [ // Registro o actualización de permiso
            'name' => 'Panel de control gestor de unidades (Gestor Unidades)',
            'description' => 'Panel de control gestor de unidades',
            'description_english' => 'Unit manager control panel',
            'app_id' => $app->id
        ]);
        $permissions_unitmanager[] = $permission->id; // Almacenar permiso para rol




        // Consulta de ROLES
        /* $rol_admin = Role::where('slug', 'sica.admin')->first(); // Rol Administrador
        $rol_coordinator = Role::where('slug', 'sica.academic_coordinator')->first(); // Rol Coordinado Académico
        $rol_attendance = Role::where('slug', 'sica.attendance')->first(); // Rol Registro Asistencia */
        $rol_unitmanager = Role::where('slug', 'sica.unitmanager')->first(); // Rol Registro Asistencia

        /* // Asignación de PERMISOS para los ROLES de la aplicación SICA (Sincronización de las relaciones sin eliminar las relaciones existentes)
        $rol_admin->permissions()-> syncWithoutDetaching($permissions_admin);
        $rol_coordinator->permissions()->syncWithoutDetaching($permissions_academic_coordinator);
        $rol_attendance->permissions()->syncWithoutDetaching($permissions_attendance); */
        $rol_unitmanager->permissions()->syncWithoutDetaching($permissions_unitmanager);

    }
}
