<?php

namespace Modules\Toolhub\Database\Seeders;

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
        $app = App::updateOrCreate(['name' => 'TOOLHUB'], [
            'url' => '/toolhub/index',
            'color' => '#76250C',
            'icon' => 'fas fa-tools',
            'description' => 'Registro de Presamos de herramientas',
            'description_english' => 'Tool Loan Registry'
        ]);
  

    }
}
