<?php

namespace Modules\LOMBRISOFT\Database\Seeders;

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
      
     $app =  App::updateOrcreate([
            'name' => 'Lombrisoft'], [
            'url' => '/lombrisoft/index',
            'color' => '#FF5733',
            'icon' => 'fa fa-worm',
            'description' => 'Sistema de gestión de unidad de Lombricultivo',
            'description_english' => 'Lombricultivo management system',
        ]);
    }
}