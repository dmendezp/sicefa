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
            'color' => '#239953',
            'icon' => 'fa-duotone fa-seedling',
            'description' => 'Sistema de registro y control de unidades agricolas',
            'description_english' => 'Registration and control system of agricultural units'

        ]);

        
}
}
