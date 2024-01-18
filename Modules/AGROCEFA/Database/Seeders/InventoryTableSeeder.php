<?php

namespace Modules\AGROCEFA\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Category;
use Modules\SICA\Entities\MeasurementUnit;
use Modules\SICA\Entities\KindOfPurchase;
use Modules\SICA\Entities\Element;

class InventoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // Consultar la app para realizar la creacion de roles
        $app = App::where('name', 'AGROCEFA')->first();

        $categories = [
            [
                'name' => 'Fertilizante',
                'kind_of_property' => 'Bodega',
            ],
            [
                'name' => 'Herramienta',
                'kind_of_property' => 'Devolutivo',
            ],
            [
                'name' => 'Agroquimico',
                'kind_of_property' => 'Bodega',
            ],
            [
                'name' => 'Maquinaria',
                'kind_of_property' => 'Devolutivo',
            ],
        ];

        foreach ($categories as $categoryData) {
            Category::updateOrCreate(['name' => $categoryData['name']], $categoryData);
        }

        $measurementunits = [
            [
                'name' => 'Kilos',
                'abbreviation' => 'Kg',
                'minimum_unit_measure' => 'Gramos',
                'conversion_factor' => '1000',
            ],
            [
                'name' => 'Litros',
                'abbreviation' => 'Lt',
                'minimum_unit_measure' => 'Mililitros',
                'conversion_factor' => '1000',
            ],
            [
                'name' => 'Unidades',
                'abbreviation' => 'Ud',
                'minimum_unit_measure' => 'Unidades',
                'conversion_factor' => '1',
            ],
        ];

        foreach ($measurementunits as $unitData) {
            MeasurementUnit::updateOrCreate(['name' => $unitData['name']], $unitData);
        }

        $ud = MeasurementUnit::where('name', 'Unidades')->first();
        $kg = MeasurementUnit::where('name', 'Kilos')->first();
        $lt = MeasurementUnit::where('name', 'Litros')->first();

        $fertilizante = Category::where('name', 'Fertilizante')->first();
        $herramienta = Category::where('name', 'Herramienta')->first();
        $agroquimico = Category::where('name', 'Agroquimico')->first();
        $maquinaria = Category::where('name', 'Maquinaria')->first();

        $KindOfPurchase = KindOfPurchase::where('name', 'Producción de centro')->first();

        $elements = [
            [
                'name' => 'Urea',
                'measurement_unit_id' => $kg->id,
                'kind_of_purchase_id' => $KindOfPurchase->id,
                'category_id' => $fertilizante->id,
                'price' => '11000',
                'slug' => 'urea',
            ],
            [
                'name' => 'Pala',
                'measurement_unit_id' => $ud->id,
                'kind_of_purchase_id' => $KindOfPurchase->id,
                'category_id' => $herramienta->id,
                'price' => '40000',
                'slug' => 'pala',
            ],
            [
                'name' => 'Glisofato',
                'measurement_unit_id' => $lt->id,
                'kind_of_purchase_id' => $KindOfPurchase->id,
                'category_id' => $agroquimico->id,
                'price' => '28000',
                'slug' => 'glisofato',
            ],
            [
                'name' => 'Tractor',
                'measurement_unit_id' => $ud->id,
                'kind_of_purchase_id' => $KindOfPurchase->id,
                'category_id' => $maquinaria->id,
                'price' => '135000000',
                'slug' => 'tractor.sonalika',
            ],
        ];

        foreach ($elements as $elementData) {
            Element::updateOrCreate(['name' => $elementData['name']], $elementData);
        }
    }
}
