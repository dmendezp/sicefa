<?php

namespace Modules\Toolhub\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Role;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $app = App::where('name', 'Toolhub')->firstOrFail();

        $roladmin = Role::updateOrCreate(['slug' => 'toolhub.admin'], [
            'name' => 'Administrador',
            'description' => 'Rol administrador de la aplicación TOOLHUB',
            'description_english' => 'TOOLHUB application administrator role',
            'full_access' => 'No',
            'app_id' => $app->id
        ]);

        $useradministrador = User::where('nickname', 'PEDRO')->firstOrFail();

        $useradministrador->roles()->syncWithoutDetaching([$roladmin->id]);
    }
}