<?php

namespace Modules\PSERENACEFA\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Role;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $app = App::where('name', 'PSERENACEFA')->firstOrFail();

        $roladmin = Role::updateOrCreate(['slug' => 'pserenacefa.admin'], [
            'name' => 'Administrador',
            'description' => 'Rol administrador de la aplicación PSERENACEFA',
            'description_english' => 'PSERENACEFA application administrator role',
            'full_access' => 'No',
            'app_id' => $app->id
        ]);

        $useradministrador = User::where('nickname', 'Chimbaco02')->firstOrFail();

        $useradministrador->roles()->syncWithoutDetaching([$roladmin->id]);
    }
}