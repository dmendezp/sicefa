<?php
namespace Modules\AVICONTROL\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Sica\Entities\App;

class AppTableSeeder extends Seeder
{
    public function run()
    {
        $app = App::updateOrCreate(
            ['url' => '/AVICONTROL/index'],
            [
                'name' => 'AVICONTROL', // Agrega un nombre significativo
                'color' => '#FF5733',
                'icon' => 'fas fa-feather-alt',
                'description' => 'Sistema de Registro de Produccion',
                'description_english' => 'Production Registration System',
            ]
        );
    }
}