<?php

namespace Modules\RADIOCEFA\Database\Seeders;

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
        // Consultar aplicación SICA para registrar los roles
        $app = App::where('name','RADIOCEFA')->first();

        $Locutor = Role::updateOrCreate(['slug' => 'Locutor'],[
            'name' => 'locutor',
            'description' => 'Rol locutor de radi-CEFA encargadod erevisar y administrar mensajes',
            'description_english' => 'Role announcer radio-CEFA in charge of reviewing and managing messages',
            'app_id' => $app->id

        ]);

        $oyente = Role::updateOrCreate(['slug' => 'oyente'],[
            'name' => 'oyente',
            'description' => 'Rol dedicado a los visitantes de la pagina',
            'description_english' => 'Role dedicated to page visitors',
            'app_id' => $app->id

        ]);


    }
}
