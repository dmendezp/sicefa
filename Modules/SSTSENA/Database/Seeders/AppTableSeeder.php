<?php

namespace Modules\SSTSENA\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\SICA\Entities\App;


class AppTableSeeder extends Seeder
{


    public function run()
    {
        App::updateOrCreate(
            ['name' => 'SST'],
            [

                'url' => 'SSTSENA/index',
                'color' => '#FF5733',
                'icon' => 'fas fa-user-shield',
                'description' => 'Sistema de Gestion de Seguridad y Salud en el Trabajo',
                'description_english' => 'Occupational Health and Safety Management System',
            ]
            );
    }
}