<?php

namespace Modules\AGROINDUSTRIA\Database\Seeders;

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
       App::updateOrCreate(['name' => 'AGROINDUSTRIA'], [
        'url' => '/agroindustria/index',
        'color' => '#ffd1dc',
        'icon' => 'fas fa-egg',
        'description' => 'Sistema para el registro y control de insumos agroindustriales',
        'description_english' => 'System for the registration and control of agro-industrial inputs'
    ]);
    }
}
