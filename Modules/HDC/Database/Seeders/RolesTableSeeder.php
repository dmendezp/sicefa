<?php

namespace Modules\HDC\Database\Seeders;

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
        // Consultar aplicación HDC para registrar los roles
        $app = App::where('name', 'HDC')->firstOrFail();

         // Registrar o actualizar rol de SUPERADMINISTRADOR
         $role_super_admin = Role::firstOrCreate(['slug' => 'superadmin'], [
            'name' => 'Super Administrador',
            'description' => 'Rol Superadministrador de SICEFA',
            'description_english' => 'Role Super administrator of SICEFA',
            'full_access' => 'Si',
            'app_id' => $app->id
        ]);

        // Registrar o actualizar rol de administrador
        $role_admin = Role::firstOrCreate(['slug' => 'hdc.admin'], [
            'name' => 'Administrador',
            'description' => 'Rol Administrador de HDC',
            'description_english' => 'Role Administrator of HDC',
            'app_id' => $app->id

        ]);

         // Registrar o actualizar rol de administrador
         $role_charge = Role::firstOrCreate(['slug' => 'hdc.charge'], [
            'name' => 'Encargado',
            'description' => 'Rol Encargado de HDC',
            'description_english' => 'Role charge of HDC',
            'app_id' => $app->id

        ]);

       /*  //Consulta de usuarios
        $user_admin = User::where('nickname', 'aldavi')->first(); //usuario para Mary Luz Aldana Vidarte
        $user_charge = User::where('nickname', 'jitaco')->first(); //usuario para Magaly Jimena Tafur Campos


        // Asignación de ROLES para los USUARIOS de la aplicación HDC (Sincronización de las relaciones sin eliminar las relaciones existentes)
        $user_admin->roles()->syncWithoutDetaching([$role_admin->id]);
        $user_admin->roles()->syncWithoutDetaching([$role_userHDC->id]);
        $user_charge->roles()->syncWithoutDetaching([$role_charge->id]);
        $user_charge->roles()->syncWithoutDetaching([$role_userHDC->id]); */

    }
}
