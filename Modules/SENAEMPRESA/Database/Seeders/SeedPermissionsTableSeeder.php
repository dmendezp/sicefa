<?php

namespace Modules\SENAEMPRESA\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\SICA\Entities\App;

class SeedPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //crear aplicacion
        $app = App::where('name','SENAEMPRESA')->first();
        if(!$app){
            $app = App::create([
                "name" => "SENAEMPRESA",
                "url" => "/senaempresa/index",
                "color" => "#ff5e1f",
                "icon" => "fas fa-puzzle-piece",
                "description" => "En esta aplicación se administra la confgur-......",
                "description_english" => "English -> En esta aplicación se administra la confgur-......"
            ]);
        }
    }
}
