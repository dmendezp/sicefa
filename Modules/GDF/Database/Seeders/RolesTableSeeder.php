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
        $app = App::where('name', 'GDF')->firstOrFail();

        $roladmin = Role::updateOrCreate(['slug' => 'gdf.admin'], [
            'name' => 'Administrador',
            'description' => 'Rol administrador de la aplicación GDF',
            'description_english' => 'GDF application administrator role',
            'full_access' => 'No',
            'app_id' => $app->id
        ]);

        $useradministrador = User::where('nickname', 'Fabian')->firstOrFail();

        $useradministrador->roles()->syncWithoutDetaching([$roladmin->id]);
    }
}