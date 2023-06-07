<?php

namespace Modules\DICSENA\Database\Seeders;

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
        App::updateOrCreate(['name' => 'SICA'], [
            'url' => '/dicsena/index',
            'color' => '#ff5e1f',
            'icon' => 'fas fa-puzzle-piece',
            'description' => 'Diccionario epico del sena',
            'description_english' => 'Dicctionary epic of sena'
        ]);
    }
}
