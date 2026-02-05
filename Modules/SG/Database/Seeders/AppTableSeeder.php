<?php

namespace Modules\SG\Database\Seeders;

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
        $app = App::updateOrCreate(
            ['name' => 'SG'],
             [
            'url' => '/sg/index',
            'color' => '#2D5016',
            'icon' => 'fas fa-hat-cowboy',
            'description' => 'software de gestion ganadera',
            'description_english' => 'Livestock management software'
        ]);
    }
}
