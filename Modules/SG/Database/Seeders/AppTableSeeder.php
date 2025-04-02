<?php

namespace Modules\SG\Database\Seeders;
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

           $app = App::updateOrCreate(
            ['name'=> 'Ganaderia'],
            [
                'url'=> '/sg/index',
                'color' => '#FF5733',
                'icon' => 'fa-solid fa-bull',
                'description' => 'sistema de gestion ganadero',
                'description_english' => 'manage cow system',
                
            ],
           );
           Model::reguard();
    
            // $this->call("OthersTableSeeder");
        }
}
