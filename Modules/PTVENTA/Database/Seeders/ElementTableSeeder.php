<?php

namespace Modules\PTVENTA\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\SICA\Entities\Category;
use Modules\SICA\Entities\KindOfPurchase;
use Modules\SICA\Entities\Element;
use Modules\SICA\Entities\MeasurementUnit;
use Modules\SICA\Database\factories\ElementFactory;

class ElementTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category = Category::updateOrCreate(['name' => 'Lácteos'],['kind_of_property' => 'Bodega']); // Registrar o registrar Categoría
        $kind_of_purchase = KindOfPurchase::updateOrCreate(['name' => 'Producción de centro'],['description' => 'Elementos de consumo que provienen de producción de centro']); // Actualizar o registrar Tipo de compra
        $measurement_unit = MeasurementUnit::updateOrCreate(['name' => 'Unidad'],[ // Actualizar o crear Unidad de medida
            'minimum_unit_measure' => 'Unidad',
            'conversion_factor' => 1
        ]);
        $e = new Element(['name' => 'Yogurt de mora x 225ml']);  // Instanciar Elemento y definir su Nombre
        Element::updateOrCreate(['name' => $e->name],[  // Actualizar o registrar Elemento
            'measurement_unit_id' => $measurement_unit->id,
            'description' => 'Delicioso yogurt con sabor a Mora y trocitos de fruta',
            'kind_of_purchase_id' => $kind_of_purchase->id,
            'category_id' => $category->id,
            'image' => ElementFactory::new()->withName($e->slug)->make()->image  // Generar imagen de acuerdo al slug generado por la instacia del Elemento al establecer un valor en el atributo na🤼‍♂️
        ]);

        $e = new Element(['name' => 'Dona de chocolate x 50gr']); // Instanciar Elemento y definir su Nombre
        Element::updateOrCreate(['name' => $e->name],[ // Actualizar o registrar Elemento
            'measurement_unit_id' => $measurement_unit->id,
            'description' => 'Deliciosas donas de chocolate y crispy',
            'kind_of_purchase_id' => $kind_of_purchase->id,
            'category_id' => $category->id,
            'image' => ElementFactory::new()->withName($e->slug)->make()->image // // Generar imagen de acuerdo al slug generado por la instacia del Elemento al establecer un valor en el atributo na🤼‍♂️
        ]);
    }
}
