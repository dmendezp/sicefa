<?php

namespace Modules\SIGAC\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\Sector;
use Modules\SICA\Entities\Warehouse;

class AppTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /* Registro o actualización de la nueva aplicación Sistema Integrado de Gestión Académica  */
        App::updateOrCreate(['name' => 'SIGAC'], [
            'url' => '/sigac/index',
            'color' => '#0a2472',
            'icon' => 'fas fa-graduation-cap',
            'description' => 'Sistema Integrado de Gestión Académica',
            'description_english' => 'Integrated Academic Management System'
        ]);

    }
}