<?php

namespace Modules\AGROCEFA\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
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

        /* Registro o actualización de la nueva aplicación AGROCEFA*/
        App::updateOrCreate(['name' => 'AGROCEFA'], [
            'url' => '/agrocefa/index',
            'color' => '#008F39',
            'icon' => 'fas fa-tractor',
            'description' => 'Sistema de Registro y Control de Unidades Agrícolas',
            'description_english' => 'Registration and Control System of Agricultural Units'

        ]);

        
}
}
