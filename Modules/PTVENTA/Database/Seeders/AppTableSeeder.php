<?php

namespace Modules\PTVENTA\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\Sector;
use Modules\SICA\Entities\Warehouse;

class AppTableSeeder extends Seeder
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
        $app = App::updateOrCreate(['name' => 'PTVENTA'], [
            'url' => '/ptventa/index',
            'color' => '#809848',
            'icon' => 'fas fa-dolly',
            'description' => 'Registro de ventas en Punto de venta del CEFA',
            'description_english' => 'Sales record of the CEFA point of sale'
        ]);

        /* Registro a actualización de sector para la unidad productiva Punto de venta */
        $sector = Sector::updateOrCreate(['name' => 'Comercial'], [
            'description' => 'Unidades encargadas de comercializar o vender productos directos o por producción de centro'
        ]);

        /* Registro o actualización de la unidad productiva para PTVENTA */
        $leader = Person::where('document_number', 52829681)->first(); // Consulta de datos personales de Lola Fernanda Herrera Hernandez
        $productive_unit = ProductiveUnit::updateOrCreate(['name' => 'Punto de venta'], [
            'person_id' => $leader->id,
            'description' => 'Unidad del centro de formación dedicada a la comercialización de las producción del centro',
            'sector_id' => $sector->id
        ]);

        $app->productive_units()->syncWithoutDetaching([$productive_unit->id]); // Asociar a aplicación con unidad productiva

        /* Registro o actualización de bodega Punto de venta */
        $warehouse = Warehouse::updateOrCreate(['name' => 'Punto de venta'], [
            'description' => 'Bodega de productos generados a partir de los procesos de producción del centro',
            'app_id' => $app->id
        ]);

        $warehouse->productive_units()->syncWithoutDetaching([$productive_unit->id]); // Asociar a bodega con unidad unidad productiva

    }
}
