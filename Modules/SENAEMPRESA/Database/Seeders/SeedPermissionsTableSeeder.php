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
                "color" => "#237286",
                "icon" => "fas fa-desktop",
                "description" => "Actividades de senaempresa y relacionado con asistencias",
                "description_english" => "English -> Actividades de senaempresa y relacionado con asistencias"
            ]);
        }

        $rolattendanceTurn = Role::where('slug','sica.attendanceTurn')->first();
        if(!$rolattendanceTurn){
            $rolattendanceTurn = Role::create([
                "name" => "Asistencia Turnos",
                "slug" => "sica.attendanceTurn",
                "description" => "Rol Encargado de las asistencias de turnos",
                "description_english" => "English - Rol Encargado de las asistencias de turnos",
                "full-access" => "no",
                "app_id" => $app->id
            ]);
        } 
    }
}
