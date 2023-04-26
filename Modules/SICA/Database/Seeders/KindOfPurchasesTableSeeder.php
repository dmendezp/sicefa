<?php

namespace Modules\SICA\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\SICA\Entities\KindOfPurchase;

class KindOfPurchasesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $number_kind_of_purchases = 6; // Definir la cantidad de tipos de compra de prueba

        KindOfPurchase::updateOrCreate(['name' => 'Producción de centro'],[  // Actualizar o registrar tipo de compra
            'description' => 'Elementos de consumo que provienen de producción de centro'
        ]);

        KindOfPurchase::factory()->count($number_kind_of_purchases)->create(); // Generar tipos de compra de prueba de acuerdo a la cantidad requerida

    }
}
