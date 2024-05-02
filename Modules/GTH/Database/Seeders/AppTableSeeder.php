<?php

namespace Modules\GTH\Database\Seeders;

use Modules\SICA\Entities\App;
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
        App::updateOrCreate(['name' => 'GTH'], [
            'url' => '/gth/index',
            'color' => '#237286',
            'icon' => 'fas fa-user-cog',
            'description' => 'Gestion del talento humano',
            'description_english' => ' Human talent management'
        ]);
    }
}
