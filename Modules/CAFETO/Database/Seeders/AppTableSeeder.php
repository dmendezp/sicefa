<?php

namespace Modules\CAFETO\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\AppProductiveUnit;
use Modules\SICA\Entities\Country;
use Modules\SICA\Entities\Department;
use Modules\SICA\Entities\Farm;
use Modules\SICA\Entities\KindOfPurchase;
use Modules\SICA\Entities\MovementType;
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
        /* Registro o actualización de la nueva aplicación para Estación de Café */
        $app = App::updateOrCreate(['name' => 'CAFETO'], [
            'url' => '/cafeto/index',
            'color' => '#76250C',
            'icon' => 'fas fa-mug-hot',
            'description' => 'Registro de ventas en Estación de Café del CEFA',
            'description_english' => 'Sales record at CEFA Coffee Station'
        ]);

        /* Registro a actualización de sector para la unidad productiva Estación de Café */
        $sector = Sector::updateOrCreate(['name' => 'Comercial'], [
            'description' => 'Unidades encargadas de comercializar o vender productos directos o por producción de centro'
        ]);

        /* Persona líder de finca y unidad productiva */
        $leader = Person::where('document_number', 52829681)->first(); // Consulta de datos personales de Lola Fernanda Herrera Hernandez

        /* Obtener ubicación de la finca */
        $country = Country::firstOrCreate([
            'name' => 'Colombia'
        ]);
        $department = Department::firstOrCreate([
            'country_id' => $country->id,
            'name' => 'Huila'
        ]);
        $municipality = Municipality::firstOrCreate([
            'department_id' => $department->id,
            'name' => 'Campoalegre'
        ]);
        $farm = Farm::firstOrCreate(['name'=>'CEFA'],[
            'description'=>'Centro de Formación Agroindustrial La Angostura',
            'area'=>100000,
            'person_id'=>$leader->id,
            'municipality_id'=>$municipality->id,
        ]);

        /* Registro o actualización de la unidad productiva para CAFETO */
        $productive_unit = ProductiveUnit::updateOrCreate(['name' => 'Estación de Café'], [
            'description' => 'Unidad del centro de formación dedicada a la comercialización de las producción del centro',
            'icon' => 'fas fa-mug-hot',
            'person_id' => $leader->id,
            'sector_id' => $sector->id,
            'farm_id' => $farm->id
        ]);

        // Asociar a aplicación con unidad productiva
        AppProductiveUnit::firstOrCreate([
            'app_id' => $app->id,
            'productive_unit_id' => $productive_unit->id
        ]);

        /* Registro o actualización de bodega Estación de Café */
        $warehouse = Warehouse::updateOrCreate(['name' => 'Estación de Café'], [
            'description' => 'Bodega de productos generados a partir de los procesos de producción del centro',
            'app_id' => $app->id
        ]);

        // Asociar a bodega con unidad unidad productiva
        ProductiveUnitWarehouse::firstOrCreate([
            'productive_unit_id' => $productive_unit->id,
            'warehouse_id' => $warehouse->id
        ]);

        // Verificar o registrar tipo de compra
        KindOfPurchase::firstOrCreate([
            'name' => 'Producción de centro',
            'description' => 'Elementos de consumo que provienen de producción de centro'
        ]);

        // Verficar o registrar tipos de movimientos
        MovementType::firstOrCreate(['name' => 'Baja'],[
            'consecutive' => 0
        ]);
        MovementType::firstOrCreate(['name' => 'Venta'],[
            'consecutive' => 0
        ]);
        MovementType::firstOrCreate(['name' => 'Movimiento Interno'],[
            'consecutive' => 0
        ]);

    }
}
