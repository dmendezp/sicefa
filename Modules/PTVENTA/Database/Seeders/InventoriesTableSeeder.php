<?php

namespace Modules\PTVENTA\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\SICA\Entities\Element;
use Modules\SICA\Entities\Inventory;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\ProductiveUnitWarehouse;
use Modules\SICA\Entities\Warehouse;
use Symfony\Component\CssSelector\Node\ElementNode;

class InventoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $inventories_number = 50; // Definir la cantidad de registros de inventarios de prueba

        $warehouse = Warehouse::where('name','Punto de venta')->firstOrFail(); // Consultar granja
        $productive_unit = ProductiveUnit::where('name','Punto de venta')->firstOrFail(); // Consultar unidad productiva
        $productive_unit_warehouse = ProductiveUnitWarehouse::where('warehouse_id',$warehouse->id)
                                                            ->where('productive_unit_id',$productive_unit->id)
                                                            ->firstOrFail(); // Obtener unidad productiva y bodega relacionada

        // Crear registro de inventario predeterminado por
        Inventory::create([
            'person_id' => $productive_unit->person_id,
            'productive_unit_warehouse_id' => $productive_unit_warehouse->id,
            'element_id' => Element::where('name','Yogurt de mora x 225ml')->firstOrFail()->id,
            'destination' => 'Producción',
            'price' => 1200,
            'amount' => 18,
            'stock' => 12,
            'production_date' => '2023-03-27',
            'lot_number' => 2112,
            'expiration_date' => '2023-04-04',
            'mark' => 'CEFA'
        ]);

        // Generar inventarios de prueba de acuerdo a la cantidad requerida
        Inventory::factory()->count($inventories_number)->create([
            'person_id'=>$warehouse->id,
            'productive_unit_warehouse_id'=>$productive_unit_warehouse->id
        ]);

    }
}
