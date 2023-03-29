<?php

namespace Modules\PTVENTA\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;
use Modules\SICA\Entities\Category;
use Modules\SICA\Entities\KindOfPurchase;
use Modules\SICA\Entities\Element;
use Modules\SICA\Entities\MeasurementUnit;

class ElementTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = Category::updateOrCreate(['name' => 'Lácteos'],['kind_of_property' => 'Bodega']); 
        $kind_of_purchase = KindOfPurchase::updateOrCreate(['name' => 'Producción de centro'],['description' => 'Elementos de consumo que provienen de producción de centro']); 
        $measurement_unit = MeasurementUnit::updateOrCreate(['name' => 'Unidad'],[
            'minimum_unit_measure' => 'Unidad',
            'conversion_factor' => 1
        ]);
        Element::updateOrCreate(['name' => 'Yogurt de mora x 225ml'],[
            'measurement_unit_id' => $measurement_unit->id,
            'description' => 'Delicioso yogurt con sabor a Mora y trocitos de fruta',
            'kind_of_purchase_id' => $kind_of_purchase->id,
            'category_id' => $category->id,
        ]);

        $category = Category::updateOrCreate(['name' => 'Repostería'],['kind_of_property' => 'Bodega']); 
        Element::updateOrCreate(['name' => 'Dona de chocolate x 50gr'],[
            'measurement_unit_id' => $measurement_unit->id,
            'description' => 'Deliciosas donas de chocolate y crispy',
            'kind_of_purchase_id' => $kind_of_purchase->id,
            'category_id' => $category->id,
        ]);
    }
}
