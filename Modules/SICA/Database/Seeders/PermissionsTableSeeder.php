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


        // Consultar aplicación SICA para registrar los roles
        $app = App::where('name','SICA')->first();


        // ===================== Registro de todos los permisos de la aplicación SICA ==================
        // Panel de control del administrador (Administrador)
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

        // Acutalizar EPS (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.people.config.eps.update'], [ // Registro o actualización de permiso
            'name' => 'Actualizar EPS (Administrador)',
            'description' => 'Actualizar EPS',
            'description_english' => 'Update EPS',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol

        // Acutalizar EPS (Coordiandor académico)
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




        /*
        // Panel de control de asistencias de eventos (Administrador)
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.events_attendance_dashboard'], [ // Registro o actualización de permiso
            'name' => 'Panel de control de asistencias de eventos (Administrador)',
            'description' => 'Panel de control de asistenciaa de eventos',j
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

        // Listar Trimestres
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.academy.quarters'], [ // Registro o actualización de permiso
            'name' => 'Listar Trimestres',
            'description' => 'Puede acceder a lista de trimestres académicos',
            'description_english' => 'You can access the list of academic quarters',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Listar Programas
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.academy.curriculums'], [ // Registro o actualización de permiso
            'name' => 'Listar Programas',
            'description' => 'Puede acceder a lista de Programas de formación',
            'description_english' => 'You can access the list of training programs',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol

        // Listar Cursos
        $permission = Permission::updateOrCreate(['slug' => 'sica.admin.academy.courses'], [ // Registro o actualización de permiso
            'name' => 'Listar Cursos',
            'description' => 'Puede acceder a lista de Titulaciones',
            'description_english' => 'You can access the list of Programs',
            'app_id' => $app->id
        ]);
        $permissions_admin[] = $permission->id; // Almacenar permiso para rol
        $permissions_academic_coordinator[] = $permission->id; // Almacenar permiso para rol
        */

        // Consulta de ROLES
        $rol_admin = Role::where('slug', 'sica.admin')->first(); // Rol Administrador
        $rol_coordinator = Role::where('slug', 'sica.academic_coordinator')->first(); // Rol Coordinado Académico
        $rol_attendance = Role::where('slug', 'sica.attendance')->first(); // Rol Registro Asistencia

        // Asignación de PERMISOS para los ROLES de la aplicación SICA (Sincronización de las relaciones sin eliminar las relaciones existentes)
        $rol_admin->permissions()-> syncWithoutDetaching($permissions_admin);
        $rol_coordinator->permissions()->syncWithoutDetaching($permissions_academic_coordinator);
        $rol_attendance->permissions()->syncWithoutDetaching($permissions_attendance);

    }
}
