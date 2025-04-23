<?php

namespace Modules\SG\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Role;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $app = App::where('name', 'SG')->firstOrFail();

        $roladmin = Role::updateOrCreate(['slug' => 'sg.admin'], [
            'name' => 'Administrador',
            'description' => 'Rol administrador de la aplicación SG',
            'description_english' => 'SG application administrator role',
            'full_access' => 'No',
            'app_id' => $app->id
        ]);

        $useradministrador = User::where('nickname', 'Kevin')->firstOrFail();

        $useradministrador->roles()->syncWithoutDetaching([$roladmin->id]);
    }
}