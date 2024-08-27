<?php

namespace Modules\PQRS\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\SICA\Entities\App;

class AppTableSeeder extends Seeder
{
    public function run(){
        App::updateOrCreate(['name' => 'PQRS'], [
            'url' => '/pqrs/index',
            'color' => '#009dff',
            'icon' => 'fas fa-comment-dots',
            'description' => 'Sistema para el seguimiento de PQRS',
            'description_english' => 'System for monitoring PQRS'
        ]);
    }
}
