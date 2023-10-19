<?php

namespace Modules\HDC\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
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
        // Registrar o actualizar rol de administrador
        $role_userHDC = Role::firstOrCreate(['slug' => 'hdc.userHDC'], [
            'name' => 'Usuario público',
            'description' => 'Rol Usuario público de HDC',
            'description_english' => 'Role userd public of HDC',
            'app_id' => $app->id

        ]);
    }
}
