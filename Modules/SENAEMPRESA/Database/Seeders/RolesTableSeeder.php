<?php

namespace Modules\SENAEMPRESA\Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
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
        $app = App::where('name', 'SENAEMPRESA')->first();

        //crear rol administrador
        $roladmin = Role::where('slug', 'senaempresa.admin')->first();
        if (!$roladmin) {
            $roladmin = Role::create([
                "name" => "Administrador Senaempresa",
                "slug" => "senaempresa",
                "description" => "Rol administrador de la aplicacion SENAEMPRESA",
                "description_english" => "English - Rol administrador de la aplicacion SENAEMPRESA",
                "full_access" => "Si",
                "app_id" => $app->id
            ]);
        }
    }
}
