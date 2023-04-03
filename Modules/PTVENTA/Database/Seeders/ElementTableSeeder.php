<?php

namespace Modules\PTVENTA\Database\Seeders;

use Faker\Factory;
use Faker\Image;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
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
            'image' => $this->generateImage()
        ]);

        $category = Category::updateOrCreate(['name' => 'Repostería'],['kind_of_property' => 'Bodega']);
        Element::updateOrCreate(['name' => 'Dona de chocolate x 50gr'],[
            'measurement_unit_id' => $measurement_unit->id,
            'description' => 'Deliciosas donas de chocolate y crispy',
            'kind_of_purchase_id' => $kind_of_purchase->id,
            'category_id' => $category->id,
            'image' => $this->generateImage()
        ]);
    }

    private function generateImage(){ // Generar imagen utilizando faker (se guarda en el directorio => storage/app/modules/sica/elements)
        $faker = Factory::create();
        $imagePath = 'modules/sica/elements/' . uniqid() . '.jpg'; // Definir la ruta y el nombre del archivo de imagen
        $imageContents = file_get_contents($faker->imageUrl(640, 480)); // Obtener los bytes de la imagen desde una URL generada por Faker
        Storage::put($imagePath, $imageContents); // Guardar la imagen en el sistema de archivos
        return $imagePath;
    }
}
