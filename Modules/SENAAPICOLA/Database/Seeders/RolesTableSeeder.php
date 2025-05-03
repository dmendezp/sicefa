<?php

namespace Modules\SENAAPICOLA\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Role;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        $app = App::where('name', 'SENAAPICOLA')->firstOrFail();

        $roleadmin = Role::updateOrCreate(['slug' => 'senaapicola.admin'], [
            'name' => 'Administrador',
            'description' => 'Rol administrador de la aplicación SENAAPICOLA',
            'description_english' => 'Administrator role of the SENAAPICOLA application',
            'full_access' => 'No',
            'app_id' => $app->id,
        ]);

        $useradministrador = User::where('nickname', 'Aaldemar')->firstOrFail();

        $useradministrador->roles()->syncWithoutDetaching([$roleadmin->id]);

        $roleintern = Role::updateOrCreate(['slug' => 'senaapicola.intern'], [
            'name' => 'Pasante',
            'description' => 'Rol pasante de la aplicación SENAAPICOLA',
            'description_english' => 'Intern role of the SENAAPICOLA application',
            'full_access' => 'No',
            'app_id' => $app->id,
        ]);

        $userintern = User::where('nickname', 'Yiselayara')->firstOrFail();

        $userintern->roles()->syncWithoutDetaching([$roleintern->id]);
        
        }
    }