<?php
namespace Modules\FABRICASOFT\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Sica\Entities\App;

class AppTableSeeder extends Seeder
{
    public function run()
    {
        $app = App::updateOrCreate(
            ['url' => '/fabricasoft/index'],
            [
                'name' => 'Fabricasoft', // Agrega un nombre significativo
                'color' => '#FF5733',
                'icon' => 'fas fa-laptop',
                'description' => 'Sistema para solicitar un software',
                'description_english' => 'System to request a software',
            ]
        );
    }
}