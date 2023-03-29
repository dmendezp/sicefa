<?php

namespace Modules\CPD\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\SICA\Entities\App;

class CPDTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // Create app CPD
        $app = App::where('name','CPD')->first();
        if(!$app){
            $app = App::create([
                "name" => "CPD",
                "url" => "/cpd/home",
                "color" => "#DC7633",
                "icon" => "fas fa-seedling",
                "description" => "Datos de producción de cacao",
                "description_english" => "Cacao data production"
            ]);
        }

    }
}
