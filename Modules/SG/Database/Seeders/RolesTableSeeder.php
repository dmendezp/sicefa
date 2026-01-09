<?php

namespace Modules\SG\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $app = App::where('name', 'sg')->firstOrFail();

        $roladmin = Role::updateOrCreate(['slug' => 'sg.admin'], [
            'name' => 'Administrador',
            'description' => 'Rol administrador de la aplicación sg',
            'description_english' => 'sg application administrator role',
            'full_access' => 'No',
            'app_id' => $app->id
        ]);

        $rolliderDeUnidad = Role::updateOrCreate(['slug' => 'sg.liderDeUnidad'], [
            'name' => 'liderDeUnidad',
            'description' => 'Rol liderDeUnidad de la aplicación sg',
            'description_english' => 'sg application liderDeUnidad role',
            'full_access' => 'No',
            'app_id' => $app->id
        ]);


        $rolaprendiz = Role::updateOrCreate(['slug' => 'sg.aprendiz'], [
            'name' => 'Aprendiz',
            'description' => 'Rol aprendiz de la aplicación sg',
            'description_english' => 'sg application apprentice role',
            'full_access' => 'No',
            'app_id' => $app->id
        ]);

        
        $useradministrador = User::where('nickname', 'Darwin')->firstOrFail();
        $user_liderDeUnidad = User::where('nickname', 'Oscar')->firstOrFail();
        $user_aprendiz = User::where('nickname', 'Danna')->firstOrFail();

        $useradministrador->roles()->syncWithoutDetaching([$roladmin->id]);
        $user_liderDeUnidad->roles()->syncWithoutDetaching([$rolliderDeUnidad->id]);
        $user_aprendiz->roles()->syncWithoutDetaching([$rolaprendiz->id]);

    }
}
