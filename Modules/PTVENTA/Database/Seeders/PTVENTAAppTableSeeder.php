<?php

namespace Modules\PTVENTA\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\SICA\Entities\App;

class PTVENTAAppTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        /* Eliminar punto de venta versión de prueba */
        $app_old = App::where('name', 'PTOVENTA')->first();
        if($app_old){ // Comprobar de que realmente exista un registro de la anterior consulta
            $app_old->delete(); // Eliminar registro de la aplicación punto de venta de prueba
        }

        /* Registro o actualización de la nueva aplicación para punto de venta */
        $app = App::where('name', 'PTVENTA')->first();
        if(!$app){
            $app = new App();
        }
        $app->name = "PTVENTA";
        $app->url = "/ptventa/index";
        $app->color = "#809848";
        $app->icon = "fas fa-dolly";
        $app->description = "Registro de ventas en Punto de venta del CEFA";
        $app->description_english = "Sales record of the CEFA point of sale";
        $app->save();

    }
}
