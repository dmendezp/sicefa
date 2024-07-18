<?php

namespace Modules\CEFAMAPS\Database\Seeders;

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
    $permission_environmentmanager = []; // Permisos para Gestor Ambientes

     // Consultar aplicación CEFAMAPS para registrar los roles
    $app = App::where('name','CEFAMAPS')->first();

    /* // ===================== Registro de todos los permisos de la aplicación CEFAMAPS ==================
    // Dashboard de administrador
    $permission = Permission::updateOrCreate(['slug' => 'cefamaps.admin.dashboard'], [ // Registro o actualización de permiso
      'name' => 'Admin Dashboard CEFAMAPS',
      'description' => 'Puede ver el dashboard de administrador',
      'description_english' => 'You can see the admin dashboard',
      'app_id' => $app->id
    ]);
    $permission_admin[] = $permission->id; // Almacenar permiso para rol

    // Administrara vista de ambientes (Admin)
    $permission = Permission::updateOrCreate(['slug' => 'cefamaps.admin.config.environment.index'], [ // Registro o actualización de permiso
      'name' => 'Administrar datos del ambiente',
      'description' => 'Puede gestionar la información de los ambientes',
      'description_english' => "You can manage the information of the environments",
      'app_id' => $app->id
    ]);
    $permission_admin[] = $permission->id; // Almacenar permiso para rol

    // Agregar Ambientes (Admin)
    $permission = Permission::updateOrCreate(['slug' => 'cefamaps.admin.config.environment.add'], [ // Registro o actualizacion de permiso
      'name' => 'Agregar un Ambiente',
      'description' => 'Puede agregar ambientes',
      'description_english' => "You can add environments",
      'app_id' => $app->id
    ]);
    $permission_admin[] = $permission->id; // Almacenar permiso para rol

    // Editar Ambientes (Admin)
    $permission = Permission::updateOrCreate(['slug' => 'cefamaps.admin.environment.edit'], [ // Registro o actualizacion de permiso
      'name' => 'Editar un Ambiente',
      'description' => 'Puede editar ambientes',
      'description_english' => "You can edit environments",
      'app_id' => $app->id
    ]);
    $permission_admin[] = $permission->id; // Almacenar permiso para rol

    // Editar Ambientes (Admin)
    $permission = Permission::updateOrCreate(['slug' => 'cefamaps.admin.config.environment.edit'], [ // Registro o actualizacion de permiso
      'name' => 'Actuallizar un Ambiente',
      'description' => 'Puede actualizar ambientes',
      'description_english' => "You can update environments",
      'app_id' => $app->id
    ]);
    $permission_admin[] = $permission->id; // Almacenar permiso para rol

    // Borrar Ambiente (Admin)
    $permission = Permission::updateOrCreate(['slug' => 'cefamaps.admin.environment.delete'], [
      'name' => 'Eliminar un Ambiente',
      'description' => 'Puede eliminar ambientes',
      'description_english' => "You can delete environments",
      'app_id' => $app->id
    ]);
    $permission_admin[] = $permission->id; // Almacenar permiso para rol

    // Administrara vista de unidades (Admin)
    $permission = Permission::updateOrCreate(['slug' => 'cefamaps.admin.config.unit.index'], [ // Registro o actualización de permiso
      'name' => 'Administrar datos de las unidades',
      'description' => 'Puede gestionar la información de las unidades',
      'description_english' => "You can manage the information of the units",
      'app_id' => $app->id
    ]);
    $permission_admin[] = $permission->id; // Almacenar permiso para rol

    // Agregar Unidades (Admin)
    $permission = Permission::updateOrCreate(['slug' => 'cefamaps.admin.config.unit.add'], [ // Registro o actualizacion de permiso
      'name' => 'Agregar una unidad',
      'description' => 'Puede agregar unidades',
      'description_english' => "You can add units",
      'app_id' => $app->id
    ]);
    $permission_admin[] = $permission->id; // Almacenar permiso para rol

    // Editar Unidades (Admin)
    $permission = Permission::updateOrCreate(['slug' => 'cefamaps.admin.config.unit.edit'], [ // Registro o actualizacion de permiso
      'name' => 'Editar una aunidad',
      'description' => 'Puede editar unidades',
      'description_english' => "You can edit units",
      'app_id' => $app->id
    ]);
    $permission_admin[] = $permission->id; // Almacenar permiso para rol

    // Editar Unidades (Admin)
    $permission = Permission::updateOrCreate(['slug' => 'cefamaps.admin.unit.edit'], [ // Registro o actualizacion de permiso
      'name' => 'Actualizar una unidad',
      'description' => 'Puede actualizar unidades',
      'description_english' => "You can update units",
      'app_id' => $app->id
    ]);
    $permission_admin[] = $permission->id; // Almacenar permiso para rol

    // Borrar Unidades (Admin)
    $permission = Permission::updateOrCreate(['slug' => 'cefamaps.admin.unit.delete'], [
      'name' => 'Eliminar una Unidad',
      'description' => 'Puede eliminar unidades',
      'description_english' => "You can delete units",
      'app_id' => $app->id
    ]);
    $permission_admin[] = $permission->id; // Almacenar permiso para rol

    // Buscar personas por numero de documento (Admin)
    $permission = Permission::updateOrCreate(['slug' => 'cefamaps.admin.unit.search'], [
      'name' => 'Buscar documento',
      'description' => 'Puede buscar por numero de documento',
      'description_english' => "You can search by document number",
      'app_id' => $app->id
    ]);
    $permission_admin[] = $permission->id; // Almacenar permiso para rol

    // Administrara vista de sector (Admin)
    $permission = Permission::updateOrCreate(['slug' => 'cefamaps.admin.config.sector.index'], [ // Registro o actualización de permiso
      'name' => 'Administrar datos de los sectores',
      'description' => 'Puede gestionar la información de los sectores',
      'description_english' => "You can manage the information of the sectors",
      'app_id' => $app->id
    ]);
    $permission_admin[] = $permission->id; // Almacenar permiso para rol

    // Agregar Sector (Admin)
    $permission = Permission::updateOrCreate(['slug' => 'cefamaps.admin.config.sector.add'], [ // Registro o actualizacion de permiso
      'name' => 'Agregar un sector',
      'description' => 'Puede agregar sectores',
      'description_english' => "You can add sectors",
      'app_id' => $app->id
    ]);
    $permission_admin[] = $permission->id; // Almacenar permiso para rol

    // Editar Sector (Admin)
    $permission = Permission::updateOrCreate(['slug' => 'cefamaps.admin.config.sector.edit'], [ // Registro o actualizacion de permiso
      'name' => 'Editar un sector',
      'description' => 'Puede editar sectores',
      'description_english' => "You can edit sectors",
      'app_id' => $app->id
    ]);
    $permission_admin[] = $permission->id; // Almacenar permiso para rol

    // Editar Sector (Admin)
    $permission = Permission::updateOrCreate(['slug' => 'cefamaps.admin.sector.edit'], [ // Registro o actualizacion de permiso
      'name' => 'Actualizar un sector',
      'description' => 'Puede actualizar sectores',
      'description_english' => "You can update sectors",
      'app_id' => $app->id
    ]);
    $permission_admin[] = $permission->id; // Almacenar permiso para rol

    // Borrar Sector (Admin)
    $permission = Permission::updateOrCreate(['slug' => 'cefamaps.admin.sector.delete'], [
      'name' => 'Eliminar un sector',
      'description' => 'Puede eliminar sectores',
      'description_english' => "You can delete sectors",
      'app_id' => $app->id
    ]);
    $permission_admin[] = $permission->id; // Almacenar permiso para rol

    // Administrara vista de Paginas (Admin)
    $permission = Permission::updateOrCreate(['slug' => 'cefamaps.admin.config.page.index'], [ // Registro o actualización de permiso
      'name' => 'Administrar datos de las Paginas',
      'description' => 'Puede gestionar la información de las paginas',
      'description_english' => "You can manage the information of the pages",
      'app_id' => $app->id
    ]);
    $permission_admin[] = $permission->id; // Almacenar permiso para rol

    // Agregar Pagina (Admin)
    $permission = Permission::updateOrCreate(['slug' => 'cefamaps.admin.config.page.add'], [ // Registro o actualizacion de permiso
      'name' => 'Agregar una pagina',
      'description' => 'Puede agregar paginas',
      'description_english' => "You can add pages",
      'app_id' => $app->id
    ]);
    $permission_admin[] = $permission->id; // Almacenar permiso para rol

    // Editar Pagina (Admin)
    $permission = Permission::updateOrCreate(['slug' => 'cefamaps.admin.config.page.edit'], [ // Registro o actualizacion de permiso
      'name' => 'Editar una pagina',
      'description' => 'Puede editar paginas',
      'description_english' => "You can edit pages",
      'app_id' => $app->id
    ]);
    $permission_admin[] = $permission->id; // Almacenar permiso para rol

    // Borrar Pagina (Admin)
    $permission = Permission::updateOrCreate(['slug' => 'cefamaps.admin.page.delete'], [
      'name' => 'Eliminar una pagina',
      'description' => 'Puede eliminar paginas',
      'description_english' => "You can delete pages",
      'app_id' => $app->id
    ]);
    $permission_admin[] = $permission->id; // Almacenar permiso para rol

    // Administrara vista de sector (Admin)
    $permission = Permission::updateOrCreate(['slug' => 'cefamaps.admin.config.class.index'], [ // Registro o actualización de permiso
      'name' => 'Administrar datos de las clases de ambientes',
      'description' => 'Puede gestionar la información de las clases de ambientes',
      'description_english' => "You can manage the information of the class environment",
      'app_id' => $app->id
    ]);
    $permission_admin[] = $permission->id; // Almacenar permiso para rol

    // Agregar Sector (Admin)
    $permission = Permission::updateOrCreate(['slug' => 'cefamaps.admin.config.class.add'], [ // Registro o actualizacion de permiso
      'name' => 'Vista Agregar clase de ambiente',
      'description' => 'Puede agregar clase de ambiente',
      'description_english' => "You can add class environment",
      'app_id' => $app->id
    ]);
    $permission_admin[] = $permission->id; // Almacenar permiso para rol

    // Agregar Sector (Admin)
    $permission = Permission::updateOrCreate(['slug' => 'cefamaps.admin.config.class.store'], [ // Registro o actualizacion de permiso
      'name' => 'Agregar clase de ambiente',
      'description' => 'Puede agregar clase de ambiente',
      'description_english' => "You can add class environment",
      'app_id' => $app->id
    ]);
    $permission_admin[] = $permission->id; // Almacenar permiso para rol

    // Editar Sector (Admin)
    $permission = Permission::updateOrCreate(['slug' => 'cefamaps.admin.config.class.edit'], [ // Registro o actualizacion de permiso
      'name' => 'Vista Editar clase de ambiente',
      'description' => 'Puede editar sectores',
      'description_english' => "You can edit class environment",
      'app_id' => $app->id
    ]);
    $permission_admin[] = $permission->id; // Almacenar permiso para rol
    // Editar Sector (Admin)
    $permission = Permission::updateOrCreate(['slug' => 'cefamaps.admin.config.class.update'], [ // Registro o actualizacion de permiso
      'name' => 'Editar clase de ambiente',
      'description' => 'Puede editar sectores',
      'description_english' => "You can edit class environment",
      'app_id' => $app->id
    ]);
    $permission_admin[] = $permission->id; // Almacenar permiso para rol

    // Borrar Sector (Admin)
    $permission = Permission::updateOrCreate(['slug' => 'cefamaps.admin.class.destroy'], [
      'name' => 'Eliminar clase de ambiente',
      'description' => 'Puede eliminar sectores',
      'description_english' => "You can delete class environment",
      'app_id' => $app->id
    ]);
    $permission_admin[] = $permission->id; // Almacenar permiso para rol */


    // Administrara vista de ambientes (Gestor Ambientes)
    $permission = Permission::updateOrCreate(['slug' => 'cefamaps.environmentmanager.config.environment.index'], [ // Registro o actualización de permiso
      'name' => 'Administrar datos del ambiente (Gestor Ambientes)',
      'description' => 'Puede gestionar la información de los ambientes',
      'description_english' => "You can manage the information of the environments",
      'app_id' => $app->id
    ]);
    $permission_environmentmanager[] = $permission->id; // Almacenar permiso para rol

    // Agregar Ambientes (Gestor Ambientes)
    $permission = Permission::updateOrCreate(['slug' => 'cefamaps.environmentmanager.config.environment.add'], [ // Registro o actualizacion de permiso
      'name' => 'Agregar un Ambiente (Gestor Ambientes)',
      'description' => 'Puede agregar ambientes',
      'description_english' => "You can add environments",
      'app_id' => $app->id
    ]);
    $permission_environmentmanager[] = $permission->id; // Almacenar permiso para rol

    // Editar Ambientes (Gestor Ambientes)
    $permission = Permission::updateOrCreate(['slug' => 'cefamaps.environmentmanager.environment.edit'], [ // Registro o actualizacion de permiso
      'name' => 'Editar un Ambiente (Gestor Ambientes)',
      'description' => 'Puede editar ambientes',
      'description_english' => "You can edit environments",
      'app_id' => $app->id
    ]);
    $permission_environmentmanager[] = $permission->id; // Almacenar permiso para rol

    // Editar Ambientes (Gestor Ambientes)
    $permission = Permission::updateOrCreate(['slug' => 'cefamaps.environmentmanager.config.environment.edit'], [ // Registro o actualizacion de permiso
      'name' => 'Actuallizar un Ambiente (Gestor Ambientes)',
      'description' => 'Puede actualizar ambientes',
      'description_english' => "You can update environments",
      'app_id' => $app->id
    ]);
    $permission_environmentmanager[] = $permission->id; // Almacenar permiso para rol

    // Borrar Ambiente (Gestor Ambientes)
    $permission = Permission::updateOrCreate(['slug' => 'cefamaps.environmentmanager.environment.delete'], [
      'name' => 'Eliminar un Ambiente (Gestor Ambientes)',
      'description' => 'Puede eliminar ambientes',
      'description_english' => "You can delete environments",
      'app_id' => $app->id
    ]);
    $permission_environmentmanager[] = $permission->id; // Almacenar permiso para rol

    


    // Administrara vista de clase de ambientes (Gestor Ambientes)
    $permission = Permission::updateOrCreate(['slug' => 'cefamaps.environmentmanager.config.class.index'], [ // Registro o actualización de permiso
      'name' => 'Administrara vista de clase de ambientes (Gestor Ambientes)',
      'description' => 'Puede gestionar la información de las clase de ambientes',
      'description_english' => "You can manage the information of the environment classes",
      'app_id' => $app->id
    ]);
    $permission_environmentmanager[] = $permission->id; // Almacenar permiso para rol

    // Vista agregar Clase de Ambiente (Gestor Ambientes)
    $permission = Permission::updateOrCreate(['slug' => 'cefamaps.environmentmanager.config.class.add'], [ // Registro o actualizacion de permiso
      'name' => 'Vista agregar Clase de Ambiente',
      'description' => 'Vista agregar Clase de Ambiente',
      'description_english' => "View add Environment Class",
      'app_id' => $app->id
    ]);
    $permission_environmentmanager[] = $permission->id; // Almacenar permiso para rol

    // Registrar Clase de Ambiente (Gestor Ambientes)
    $permission = Permission::updateOrCreate(['slug' => 'cefamaps.environmentmanager.config.class.store'], [ // Registro o actualizacion de permiso
      'name' => 'Registrar Clase de Ambiente (Gestor Ambientes)',
      'description' => 'Registrar Clase de Ambiente',
      'description_english' => "Register Environment Class",
      'app_id' => $app->id
    ]);
    $permission_environmentmanager[] = $permission->id; // Almacenar permiso para rol

    // Vista editar Clase de Ambiente (Gestor Ambientes)
    $permission = Permission::updateOrCreate(['slug' => 'cefamaps.environmentmanager.config.class.edit'], [ // Registro o actualizacion de permiso
      'name' => 'Vista editar Clase de Ambiente (Gestor Ambientes)',
      'description' => 'Vista editar Clase de Ambiente',
      'description_english' => "View edit Environment Class",
      'app_id' => $app->id
    ]);
    $permission_environmentmanager[] = $permission->id; // Almacenar permiso para rol

    // Actualizar Clase de Ambiente (Gestor Ambientes)
    $permission = Permission::updateOrCreate(['slug' => 'cefamaps.environmentmanager.config.class.update'], [
      'name' => 'Actualizar Clase de Ambiente (Gestor Ambientes)',
      'description' => 'Actualizar Clase de Ambiente',
      'description_english' => "Update Environment Class",
      'app_id' => $app->id
    ]);
    $permission_environmentmanager[] = $permission->id; // Almacenar permiso para rol

    // Eliminar Clase de Ambiente (Gestor Ambientes)
    $permission = Permission::updateOrCreate(['slug' => 'cefamaps.environmentmanager.class.destroy'], [
      'name' => 'Eliminar Clase de Ambiente (Gestor Ambientes)',
      'description' => 'Eliminar Clase de Ambiente',
      'description_english' => "Delete Environment Class",
      'app_id' => $app->id
    ]);
    $permission_environmentmanager[] = $permission->id; // Almacenar permiso para rol

    // Panel de control Gestor de Ambientes (Gestor Ambientes)
    $permission = Permission::updateOrCreate(['slug' => 'cefamaps.environmentmanager.dashboard'], [
      'name' => 'Panel de control Gestor de Ambientes (Gestor Ambientes)',
      'description' => 'Panel de control Gestor de Ambientes',
      'description_english' => "Environment Manager Control Panel",
      'app_id' => $app->id
    ]);
    $permission_environmentmanager[] = $permission->id; // Almacenar permiso para rol


    // Consulta de ROLES
    $rol_admin = Role::where('slug', 'cefamaps.admin')->first(); // Rol Administrador
    $rol_environmentmanager = Role::where('slug', 'cefamaps.environmentmanager')->first(); // Rol Gesto Ambientes

    // Asignación de PERMISOS para los ROLES de la aplicación CEFAMAPS (Sincronización de las relaciones sin eliminar las relaciones existentes)
/*     $rol_admin->permissions()-> syncWithoutDetaching($permission_admin); */
    $rol_environmentmanager->permissions()-> syncWithoutDetaching($permission_environmentmanager);

  }
}
