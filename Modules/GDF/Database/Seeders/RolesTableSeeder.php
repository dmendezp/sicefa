<?php

namespace Modules\GDF\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Role;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        /// Crear una lista para el rol
        $app = App::where('name', 'GDF')->firstOrFail();

        $roladmin = Role::updateOrCreate(['slug' => 'gdf.admin'], [
            'name' => 'Administrador',
            'description' => 'Rol administrador de la aplicación GDF',
            'description_english' => 'GDF application administrator role',
            'full_access' => 'No',
            'app_id' => $app->id
        ]);

        $useradministrador = User::where('nickname', 'FABIAN')->firstOrFail();

        $useradministrador->roles()->syncWithoutDetaching([$roladmin->id]);


        /// Crear una lista para el rol
        $app = App::where('name', 'GDF')->firstOrFail();

        $roladmin = Role::updateOrCreate(['slug' => 'gdf.funcionario'], [
            'name' => 'Funcionario',
            'description' => 'Rol funcionario de la aplicación GDF',
            'description_english' => 'GDF application Employee role',
            'full_access' => 'No',
            'app_id' => $app->id
        ]);

        $useradministrador = User::where('nickname', 'ANDREY')->firstOrFail();

        $useradministrador->roles()->syncWithoutDetaching([$roladmin->id]);

        /// Crear una lista para el rol
        $app = App::where('name', 'GDF')->firstOrFail();

        $roladmin = Role::updateOrCreate(['slug' => 'gdf.superadmin'], [
            'name' => 'Super Administrador',
            'description' => 'Rol super administrador de la aplicación GDF',
            'description' => 'Rol super administrador de la aplicación GDF',
            'description_english' => 'GDF application super administrator role',
            'full_access' => 'No',
            'app_id' => $app->id
        ]);

        $useradministrador = User::where('nickname', 'LEONEL')->firstOrFail();

        $useradministrador->roles()->syncWithoutDetaching([$roladmin->id]);
    }
}