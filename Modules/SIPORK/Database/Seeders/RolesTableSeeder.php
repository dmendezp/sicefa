<?php

namespace Modules\SIPORK\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Role;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $app = App::where('name', 'SIPORK')->firstOrFail();

        $roladmin = Role::updateOrCreate(['slug' => 'sipork.admin'], [
            'name' => 'Administrador',
            'description' => 'Rol administrador de la aplicación SIPORK',
            'description_english' => 'SIPORK application administrator role',
            'full_access' => 'No',
            'app_id' => $app->id
        ]);

        $rolliderDeUnidad = Role::updateOrCreate(['slug' => 'sipork.liderDeUnidad'], [
            'name' => 'liderDeUnidad',
            'description' => 'Rol liderDeUnidad de la aplicación SIPORK',
            'description_english' => 'SIPORK application liderDeUnidad role',
            'full_access' => 'No',
            'app_id' => $app->id
        ]);

        $rolaprendiz = Role::updateOrCreate(['slug' => 'sipork.aprendiz'], [
            'name' => 'Aprendiz',
            'description' => 'Rol aprendiz de la aplicación SIPORK',
            'description_english' => 'SIPORK application apprentice role',
            'full_access' => 'No',
            'app_id' => $app->id
        ]);

        $useradministrador = User::where('nickname', 'Darwin')->firstOrFail();
        $user_liderDeUnidad = User::where('nickname', 'Juan')->firstOrFail();
        $user_aprendiz = User::where('nickname', 'Nicolle')->firstOrFail();
        $user_aprendiz2 = User::where('nickname', 'Jeifrey')->firstOrFail();
        $user_aprendiz3 = User::where('nickname', 'Cristian')->firstOrFail();

        $useradministrador->roles()->syncWithoutDetaching([$roladmin->id]);
        $user_liderDeUnidad->roles()->syncWithoutDetaching([$rolliderDeUnidad->id]);
        $user_aprendiz->roles()->syncWithoutDetaching([$rolaprendiz->id]);
        $user_aprendiz2->roles()->syncWithoutDetaching([$rolaprendiz->id]);
        $user_aprendiz3->roles()->syncWithoutDetaching([$rolaprendiz->id]);
    }
}
