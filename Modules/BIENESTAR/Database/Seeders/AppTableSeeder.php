<?php

namespace Modules\BIENESTAR\Database\Seeders;

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
        App::updateOrCreate(['name' => 'BIENESTAR'], [
        'url' => '/bienestar/home',
        'color' => '#33105D',
        'icon' => 'fas fa-hand-holding-heart',
        'description' => 'Sistema de Gestión de Bienestar al aprendiz',
        'description_english' => 'Trainee Welfare Management System'
    ]);
    }
}
