<?php

namespace Modules\SENAEMPRESA\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\SICA\Entities\Category;
use Modules\SICA\Entities\KindOfPurchase;
use Modules\SICA\Entities\MeasurementUnit;
use Modules\SICA\Entities\Element;
use Modules\SICA\Entities\Inventory;

class InventoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Crea una categoría
        $category = Category::create([
            'name' => 'SENAEMPRESA_EPP',
            'kind_of_property' => 'Devolutivo', // Ajusta según tus necesidades
        ]);

        // Crea un tipo de compra
        $kindOfPurchase = KindOfPurchase::create([
            'name' => 'Tipo de Compra Ejemplo',
            'description' => 'Descripción del tipo de compra',
        ]);

        // Crea una unidad de medida
        $measurementUnit = MeasurementUnit::create([
            'name' => 'Unidad de Medida Ejemplo',
            'abbreviation' => 'UME',
            'minimum_unit_measure' => 'Mínimo',
            'conversion_factor' => 1.0,
        ]);

        // Crea un elemento asociado a la categoría, tipo de compra y unidad de medida
        Element::create([
            'name' => 'Elemento de Inventario',
            'measurement_unit_id' => $measurementUnit->id,
            'description' => 'Descripción del elemento',
            'kind_of_purchase_id' => $kindOfPurchase->id,
            'category_id' => $category->id,
            'price' => 100, // Ajusta según tus necesidades
            'UNSPSC_code' => 123456, // Ajusta según tus necesidades
            'image' => 'ruta/a/la/imagen.jpg', // Ajusta según tus necesidades
            'slug' => 'elemento-inventario',
        ]);
    }
}
