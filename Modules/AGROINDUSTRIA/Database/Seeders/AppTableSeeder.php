<?php

namespace Modules\AGROINDUSTRIA\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class AppTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       /* Registro o actualización de la nueva aplicación Sistema Integrado de Control Administrativo */
       App::updateOrCreate(['name' => 'DATAGRO'], [
        'url' => '/agroindustria/index',
        'color' => '#ffd1dc',
        'icon' => 'fa-thin fa-egg',
        'description' => 'Descubre el poder de controlar tus insumos en la industria',
        'description_english' => 'Discover the power of controlling your inputs in the industry'
    ]);
    }
}
