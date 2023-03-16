<?php

namespace Modules\CAFETO\Database\Seeders;

use Illuminate\Database\Seeder;
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
        // Elimina la version de prueba de CAFETO
        $app_old = App::where('name', 'CAFETO')->first();
        if($app_old){ // Comprobar de que realmente exista un registro de la anterior consulta
            $app_old->delete(); // Eliminar registro de la aplicación CAFETO de prueba
        }

        /* Registro o actualización de la nueva aplicación para estación de café */
        $app = App::where('name', 'CAFETO')->first();
        if(!$app){
            $app = new App();
        }
        $app->name = "CAFETO";
        $app->url = "/cafeto/index";
        $app->color = "#76250C";
        $app->icon = "fas fa-mug-hot";
        $app->description = "Registro de ventas en Estación de Café del CEFA";
        $app->description_english = "Sales record at CEFA Coffee Station";
        $app->save();

    }
}
