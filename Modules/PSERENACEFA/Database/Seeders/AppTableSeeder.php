<?php

namespace Modules\PSERENACEFA\Database\Seeders;

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
        /* Registro o actualización de la nueva aplicación para Estación de Café */
        $app = App::updateOrCreate(['name' => 'PSERENACEFA'], [
            'url' => '/pserenacefa/index',
            'color' => '#ffc107',
            'icon' => 'far fa-building',
            'description' => 'Solicitudes de espacios y recursos',
            'description_english' => 'Requests for spaces and resources',
        ]);

        

    }
}

