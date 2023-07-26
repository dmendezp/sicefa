<?php

namespace Modules\GANADERIA\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Role;

class RolesTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    // Consultar aplicación GANDERIA para registrar los roles
    $app = App::where('name','GANADERIA')->first();

    // Registrar o actualizar rol de SUPERADMINISTRADOR
    $user_super_admin = Role::updateOrCreate(['slug' => 'superadmin'], [
      'name' => 'Super Administrador',
      'description' => 'Rol Superadministrador de SICEFA',
      'description_english' => 'Role Super administrator of SICEFA',
      'full_access' => 'Si',
      'app_id' => $app->id
    ]);

    // veterinario
    // Registrar o actualizar rol de ADMINISTRADOR
    $rol_vet = Role::updateOrCreate(['slug' => 'ganaderia.admin.vet'], [
      'name' => 'Veterinario',
      'description' => 'Rol Veterinario de la aplicacion GANADERIA',
      'description_english' => 'GANADERIA Application Administrator Role',
      'app_id' => $app->id
    ]);

    // aprendiz lider
    // Registrar o actualizar rol de ADMINISTRADOR
    $rol_leader = Role::updateOrCreate(['slug' => 'ganaderia.admin.leader'], [
      'name' => 'Aprendiz Lider',
      'description' => 'Rol Aprendiz Lider de la aplicacion GANADERIA',
      'description_english' => 'GANADERIA Application Administrator Role',
      'app_id' => $app->id
    ]);

    // produccion
    // Registrar o actualizar rol de ADMINISTRADOR
    $rol_production = Role::updateOrCreate(['slug' => 'ganaderia.admin.production'], [
      'name' => 'Produccion',
      'description' => 'Rol Produccion de la aplicacion GANADERIA',
      'description_english' => 'GANADERIA Application Administrator Role',
      'app_id' => $app->id
    ]);

    // Aprendiz
    // Registrar o actualizar rol de ADMINISTRADOR
    $rol_apprentice = Role::updateOrCreate(['slug' => 'ganaderia.admin.apprentice'], [
      'name' => 'Aprendiz',
      'description' => 'Rol Aprendiz de la aplicacion GANADERIA',
      'description_english' => 'GANADERIA Application Administrator Role',
      'app_id' => $app->id
    ]);

    // Consulta de usuarios
    $user_super_admin = User::where('nickname','damendez')->first(); // Usuario Administrador con full-access (Diego Andrés Mendéz Pastrana)
    $user_vet = User::where('nickname','AnggyLo')->first(); // Usuario Administrador (Anggy Lorena Cortes)
    $user_leader = User::where('nickname','Karen2005')->first(); // Usuario Administrador (Karen Dallana Murcia Martinez)
    $user_production = User::where('nickname','FelipeDu')->first(); // Usuario Administrador (Juan Felipe Duque)
    $user_apprentice = User::where('nickname','Santiagod')->first(); // Usuario Administrador (Santiago Hernandez Martinez)

    // Asignación de ROLES para los USUARIOS de la aplicación GANADERIA (Sincronización de las relaciones sin eliminar las relaciones existentes)
    $user_super_admin->roles()->syncWithoutDetaching([$user_super_admin->id]);
    $user_vet->roles()->syncWithoutDetaching([$rol_vet->id]);
    $user_leader->roles()->syncWithoutDetaching([$rol_leader->id]);
    $user_production->roles()->syncWithoutDetaching([$rol_production->id]);
    $user_apprentice->roles()->syncWithoutDetaching([$rol_apprentice->id]);
    
  }
}