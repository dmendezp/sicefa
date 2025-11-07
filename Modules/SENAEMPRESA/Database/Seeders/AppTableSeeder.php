<?php

namespace Modules\SENAEMPRESA\Database\Seeders;

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
        //crear aplicacion
        $app = App::where('name', 'SENAEMPRESA')->first();
        if (!$app) {
            $app = App::create([
                "name" => "SENAEMPRESA",
                "url" => "/senaempresa/index",
                "color" => "#2ea29c",
                "icon" => "fas fa-desktop",
                "description" => "Actividades de senaempresa y relacionado con asistencias",
                "description_english" => "English -> Actividades de senaempresa y relacionado con asistencias"
            ]);
        }
    }
}
