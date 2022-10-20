<?php

namespace Modules\CEFAMAPS\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
//Para crear la aplicacion
use Modules\CEFAMAPS\Entities\App;

class CEFAMAPSDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Model::unguard();

        //*crear aplicacion
        $app = App::where('name','CEFAMAPS')->first();
        if(!$app){
            $app = App::create([
                "name" => "CEFAMAPS",
                "url" => "/cefamaps/index",
                "color" => "#4FB1D9",
                "icon" => "fas fa-map",
                "description" => "En esta aplicación se mostra el mapa del S-......",
                "description_english" => "English -> En esta aplicación se mostra el mapa del S-......"
            ]);
        }
    }
}
