<?php

namespace Modules\PTVENTA\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\SICA\Entities\Inventory;
use Modules\SICA\Entities\Element;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Warehouse;

 class InventoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()

    {

        $number_inventories = 50; // Definir la cantidad de registros de inventarios de prueba

        // Crear registro de inventario predeterminado por
        Inventory::create([
            'person_id' => Person::where('document_number',52829681)->firstOrFail()->id,
            'warehouse_id' => Warehouse::where('name','Punto de venta')->firstOrFail()->id,
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
        Inventory::factory()->count($number_inventories)->create();

    }
}
