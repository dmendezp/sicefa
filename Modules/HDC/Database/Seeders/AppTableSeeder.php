<?php

namespace Modules\HDC\Database\Seeders;

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
       /* Registro o actualización de la nueva aplicación Huella De Carbono */
       App::updateOrCreate(['name' => 'HDC'], [
        'url' => '/hdc/index',
        'color' => '#00a14b',
        'icon' => 'fas fa-hand-holding-water',
        'description' => 'Huella De Carbono',
        'description_english' => 'Carbon Footprint'
    ]);


        // $this->call("OthersTableSeeder");
    }
}
