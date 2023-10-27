<?php

namespace Modules\RADIOCEFA\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\RADIOCEFA\Entities\App;

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
        App::updateOrCreate(['name' => 'RADIOCEFA'], [
            'url' => '/radiocefa/index',
            'color' => '#42F227',
            'icon' => 'fa-solid fa-microphone',
            'description' => 'Aplicativo web de interacción al espacio radial Radio-CEFA',
            'description_english' => 'Integrated Administrative Control Systeme'
        ]);
    }
}
