<?php

namespace Modules\EVS\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Role;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $app = App::where('name', 'EVS')->first();

        Role::updateOrCreate(['slug' => 'evs.admin'], [
            'name' => 'Administrador EVS',
            'description' => 'Control total del sistema de elecciones',
            'description_english' => 'Full control over the election system',
            'full_access' => 'No',
            'app_id' => $app->id,
        ]);

        Role::updateOrCreate(['slug' => 'evs.jury'], [
            'name' => 'Jurado EVS',
            'description' => 'Valida y autoriza votantes',
            'description_english' => 'Validates and authorizes voters',
            'full_access' => 'No',
            'app_id' => $app->id,
        ]);

        Role::updateOrCreate(['slug' => 'evs.voter'], [
            'name' => 'Votante EVS',
            'description' => 'Usuario que puede votar',
            'description_english' => 'User allowed to vote',
            'full_access' => 'No',
            'app_id' => $app->id,
        ]);
    }
}