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
            'color' => '#76250C',
            'icon' => 'fas fa-mug-hot',
            'description' => 'Sistema de ganaderia',
            'description_english' => 'Sales record at CEFA Coffee Station'
        ]);

   
    
    }
}
