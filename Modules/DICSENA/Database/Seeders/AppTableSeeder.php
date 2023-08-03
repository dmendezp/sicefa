<?php

namespace Modules\DICSENA\Database\Seeders;

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
        App::updateOrCreate(['name' => 'DICSENA'], [
            'url' => '/dicsena/index',
            'color' => '#ff5e1f',
            'icon' => 'fa-solid fa-globe',
            'description' => 'Diccionario epico del sena',
            'description_english' => 'Dicctionary epic of sena'
        ]);
    }
}
