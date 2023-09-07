<?php

namespace Modules\SENAEMPRESA\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Permission;

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


        // Consultar aplicación SENAEMPRESA para registrar los roles
        $app = App::where('name', 'SENAEMPRESA')->first();

        // Home de administrador
        $permission = Permission::updateOrCreate(['slug' => 'senamepresa.index'], [ // Registro o actualización de permiso
            'name' => 'Admin Inicio',
            'description' => 'Puede ver el inicio de administrador',
            'description_english' => 'You can see the admin login',
            'app_id' => $app->id
        ]);
        $permission_admin[] = $permission->id; // Almacenar permiso para rol
    }
}
