<?php

namespace Modules\PTVENTA\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;


class InventoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       Model:unguard();

        // $this->call("OthersTableSeeder");
        invetories::create([

            'person_id' => '1',
            'werehouse_id' => '1',
            'element_id' => '1',
            'destination' => 'Producción',
            'description' => 'Texto largo',
            'price' => 'Número entero',
            'amount' => 'Número entero',
            'stock' => 'Número entero',
            'production_date' => 'Fecha',
            'lot_number' => 'Número entero',
            'expiration_date' => 'Fecha',
            'state' => 'Disponible',
            'mark' => 'Texto corto',
            'inventory_code' => 'Número entero no asignado',


        ]);

        
    }
}
