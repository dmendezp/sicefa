<?php

namespace Modules\GVFF\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Role;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $app = App::where('name', 'GVFF')->firstOrFail();

        $roladmin = Role::updateOrCreate(['slug' => 'gvff.admin'], [
            'name' => 'Administrador',
            'description' => 'Rol administrador de la aplicación GVFF ',
            'description_english' => 'GVFF application administrator role',
            'full_access' => 'No',
            'app_id' => $app->id
        ]);

        $useradministrador = User::where('nickname', 'Dquiza')->firstOrFail();

        $useradministrador->roles()->syncWithoutDetaching([$roladmin->id]);
    }
}