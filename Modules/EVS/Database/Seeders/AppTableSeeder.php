<?php

namespace Modules\EVS\Database\Seeders;

use Modules\SICA\Entities\App;
use Illuminate\Database\Seeder;

class AppTableSeeder extends Seeder
{
    public function run()
    {
        App::updateOrCreate(['name' => 'EVS'], [
            'url' => '/evs/index',
            'color' => '#007bff',
            'icon' => 'fas fa-vote-yea',
            'description' => 'Elecciones Virtuales SENA',
            'description_english' => 'Virtual Elections SENA',
        ]);
    }
}