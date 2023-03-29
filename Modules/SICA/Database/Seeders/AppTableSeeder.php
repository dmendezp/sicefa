<?php

namespace Modules\SICA\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\SICA\Entities\App;

class AppTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /* Registro o actualización de la nueva aplicación Sistema Integrado de Control Administrativo */
        App::updateOrCreate(['name' => 'SICA'], [
            'url' => '/sica/index',
            'color' => '#ff5e1f',
            'icon' => 'fas fa-puzzle-piece',
            'description' => 'Sistema Integrado de Control Administrativo',
            'description_english' => 'Integrated Administrative Control Systeme'
        ]);

    }
}
