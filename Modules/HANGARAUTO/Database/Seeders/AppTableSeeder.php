<?php

namespace Modules\HANGARAUTO\Database\Seeders;

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
        App::updateOrCreate(['name' => 'HANGARAUTO'], [
            'url' => '/hangarauto/index',
            'color' => '#795548',
            'icon' => 'fas fa-bus-alt',
            'description' => 'Servicio De Prestamo De Vehiculo Y Maquinaria',
            'description_english' => 'Vehicle and Machinery Loan Service'
        ]);

    }
}
