<?php

namespace Modules\GANADERIA\Database\Seeders;

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
    $permission_vet = []; // Permisos para Administrador
    $permission_leader = []; // Permisos para Administrador
    $permission_production = []; // Permisos para Administrador
    $permission_apprentice = []; // Permisos para Administrador

    // Consultar aplicación GANADERIA para registrar los roles
    $app = App::where('name','GANADERIA')->first();

    // ===================== Registro de todos los permisos de la aplicación GANADERIA ==================
    // Dashboard de administrador
    $permission = Permission::updateOrCreate(['slug' => 'ganaderia.admin.dashboard'], [ // Registro o actualización de permiso
      'name' => 'Admin Dashboard GANADERIA',
      'description' => 'Puede ver el dashboard de administrador',
      'description_english' => 'You can see the admin dashboard',
      'app_id' => $app->id
    ]);
    $permission_admin[] = $permission->id; // Almacenar permiso para rol

    // Consulta de ROLES
    $rol_vet = Role::where('slug', 'ganaderia.admin.vet')->first(); // Rol Administrador Veterinaria
    $rol_leader = Role::where('slug', 'ganaderia.admin.leader')->first(); // Rol Administrador Aprendiz Lider
    $rol_production = Role::where('slug', 'ganaderia.admin.production')->first(); // Rol Administrador Produccion
    $rol_apprentice = Role::where('slug', 'ganaderia.admin.apprentice')->first(); // Rol Administrador Aprendiz

    // Asignación de PERMISOS para los ROLES de la aplicación GANADERIA (Sincronización de las relaciones sin eliminar las relaciones existentes)
    $rol_vet->permissions()-> syncWithoutDetaching($permission_vet);
    $rol_leader->permissions()-> syncWithoutDetaching($permission_leader);
    $rol_production->permissions()-> syncWithoutDetaching($permission_production);
    $rol_apprentice->permissions()-> syncWithoutDetaching($permission_apprentice);

  }
}
