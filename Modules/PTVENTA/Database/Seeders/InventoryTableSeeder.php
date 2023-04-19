<?php

namespace Modules\PTVENTA\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\SICA\Entities\Inventory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


 class InventoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()

    {
        Inventory::create([

            'person_id' => 1,
            'warehouse_id' => 1,
            'element_id' => 1,
            'destination' => 'Producción',
            'description' => null,
            'price' => 1200,
            'amount' => 6,
            'stock' => 12,
            'production_date' => '2023-04-17',
            'lot_number' => 2112,
            'expiration_date' => '2023-04-24',
            'state' => 'Disponible',
            'mark' => 'CEFA',
            'inventory_code' => null,
        ]);    
    }
}
