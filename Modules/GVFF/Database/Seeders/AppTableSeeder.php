<?php

namespace Modules\GVFF\Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\SICA\Entities\App;


class AppTableSeeder extends Seeder
{
    public function run()
    {
        App::updateOrCreate(
            ['name' => 'GVFF'],
            [
            'url' => '/GVFF/index',
            'color' => '#FF5733',
            'icon' => 'fas fa-frog',
            'description' => 'Sistema de gestion de vivero fauna y flora',
            'description_english' => 'Pork unit Management System',
            ]
        
        );

        Model::reguard();
          
        
        
    }

}