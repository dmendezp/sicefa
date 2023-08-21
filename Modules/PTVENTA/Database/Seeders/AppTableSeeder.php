<?php

namespace Modules\PTVENTA\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Country;
use Modules\SICA\Entities\Department;
use Modules\SICA\Entities\Farm;
use Modules\SICA\Entities\Municipality;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\ProductiveUnitWarehouse;
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

        /* Obtener ubicación de la granja */
        $country = Country::firstOrCreate([
            'name' => 'Colombia'
        ]);
        $department = Department::firstOrCreate([
            'country_id' => $country->id,
            'name' => 'Huila'
        ]);
        $municipality = Municipality::firstOrCreate([
            'department_id' => $department->id,
            'name' => 'Huila'
        ]);

        /* Registro o actualización de la unidad productiva para PTVENTA */
        $leader = Person::where('document_number', 52829681)->first(); // Consulta de datos personales de Lola Fernanda Herrera Hernandez
        $productive_unit = ProductiveUnit::updateOrCreate(['name' => 'Punto de venta'], [
            'description' => 'Unidad del centro de formación dedicada a la comercialización de las producción del centro',
            'icon' => 'fas fa-dolly',
            'person_id' => $leader->id,
            'sector_id' => $sector->id
        ]);

        $app->productive_units()->syncWithoutDetaching([$productive_unit->id]); // Asociar a aplicación con unidad productiva

        /* Registro o actualización de bodega Punto de venta */
        $warehouse = Warehouse::updateOrCreate(['name' => 'Punto de venta'], [
            'description' => 'Bodega de productos generados a partir de los procesos de producción del centro',
            'app_id' => $app->id
        ]);

        // Asociar a bodega con unidad unidad productiva
        ProductiveUnitWarehouse::firstOrCreate([
            'productive_unit_id' => $productive_unit->id,
            'warehouse_id' => $warehouse->id
        ]);

    }
}
