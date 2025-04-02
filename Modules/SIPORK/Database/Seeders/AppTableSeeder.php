<?php

namespace Modules\SIPORK\Database\Seeders;

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
        $app = App::updateOrCreate(
            ['name' => 'SIPORK'],
            [
                'url' => '/sipork/index',
                'color' => '#FF5733',
                'icon' => 'fa fa-piggy-bank',
                'description' => 'Sistema de Gestión Unidad Porcinos',
                'description_english' => 'Pork Unit Management System',
            ]
        );
    }
}
