<?php

namespace Modules\CEFAMAPS\Database\Seeders;

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
    // Consultar aplicación CEFAMAPS para registrar los roles
    $app = App::where('name','CEFAMAPS')->first();

    // Registrar o actualizar rol de SUPERADMINISTRADOR
    $user_super_admin = Role::updateOrCreate(['slug' => 'superadmin'], [
      'name' => 'Super Administrador',
      'description' => 'Rol Superadministrador de SICEFA',
      'description_english' => 'Role Super administrator of SICEFA',
      'full_access' => 'Si',
      'app_id' => $app->id
    ]);

    // Registrar o actualizar rol de ADMINISTRADOR
    $rol_admin = Role::updateOrCreate(['slug' => 'cefamaps.admin'], [
      'name' => 'Administrador CEFAMAPS',
      'description' => 'Rol Administrador de la aplicacion CEFAMAPS',
      'description_english' => 'CEFAMAPS Application Administrator Role',
      'app_id' => $app->id
    ]);

    // Registrar o actualizar rol de GESTOR AMBIENTES
    $rol_admin = Role::updateOrCreate(['slug' => 'cefamaps.environmentmanager'], [
      'name' => 'Gestor Ambientes CEFAMAPS',
      'description' => 'Rol Gestor de ambientes de la aplicacion CEFAMAPS',
      'description_english' => 'Environment manager role of the CEFAMAPS application',
      'app_id' => $app->id
    ]);

    // Registrar o actualizar rol de SST (Segurida y Salud en el Trabajo)
    $rol_admin = Role::updateOrCreate(['slug' => 'cefamaps.sst'], [
      'name' => 'SST CEFAMAPS',
      'description' => 'Rol SST de la aplicacion CEFAMAPS',
      'description_english' => 'SST role of the CEFAMAPS application',
      'app_id' => $app->id
    ]);

/*     // Consulta de usuarios
    $user_super_admin = User::where('nickname','damendez')->first(); // Usuario Administrador con full-access (Diego Andrés Mendéz Pastrana)
    $user_admin = User::where('nickname','LolaFernanda')->first(); // Usuario Administrador (Neythan Sabogal Gaitan)

    // Asignación de ROLES para los USUARIOS de la aplicación CEFAMAPS (Sincronización de las relaciones sin eliminar las relaciones existentes)
    $user_super_admin->roles()->syncWithoutDetaching([$user_super_admin->id]);
    $user_admin->roles()->syncWithoutDetaching([$rol_admin->id]); */

  }
}
