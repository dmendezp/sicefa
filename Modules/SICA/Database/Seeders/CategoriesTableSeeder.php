<?php

namespace Modules\SICA\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\SICA\Entities\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $number_categories = 12; // Definir la cantidad de categorías de prueba

        Category::updateOrCreate(['name' => 'Lácteos'],[  // Actualizar o registrar Unidad de medida
            'kind_of_property' => 'Bodega'
        ]);

        Category::factory()->count($number_categories)->create(); // Generar categorías de prueba de acuerdo a la cantidad requerida

    }
}
