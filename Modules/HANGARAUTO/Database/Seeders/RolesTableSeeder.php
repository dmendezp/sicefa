<?php

namespace Modules\HANGARAUTO\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $app = App::where('name', 'HANGARAUTO')->firstOrFail();

        // Registrar O Actualizar Rol De SUPERADMINISTRADOR
        $role_super_admin = Role::firstOrCreate(['slug' => 'superadmin'], [
            'name' => 'Super Administrador',
            'description' => 'Rol Superadministrador De SICEFA',
            'description_english' => 'Role Super Administrator Of SICEFA',
            'full_access' => 'Si',
            'app_id' => $app->id
        ]);
        // Registrar O Actualizar Rol De Administrador
        $role_admin = Role::firstOrCreate(['slug' => 'hangarauto.admin'], [
            'name' => 'Administrador',
            'description' => 'Rol Administrador De HANGARAUTO',
            'description_english' => 'Role Administrator Of HANGARAUTO',
            'app_id' => $app->id
        ]);
    }
}
