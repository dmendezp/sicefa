<?php

namespace Modules\PTVENTA\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\SICA\Database\factories\ElementFactory;
use Modules\SICA\Entities\Category;
use Modules\SICA\Entities\Element;
use Modules\SICA\Entities\KindOfPurchase;
use Modules\SICA\Entities\MeasurementUnit;

class ElementsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $number_elements = 100; // Definir la cantidad de elementos de prueba

        // La siguiente línea se recomienda dejarla al iniciar todo los registros que son generados en este seeder
        $this->cleanImages(); // Limpiar imágenes no registradas en la base de datos

        $category = Category::updateOrCreate(['name' => 'Lácteos'],['kind_of_property' => 'Bodega']); // Registrar o registrar Categoría
        $kind_of_purchase = KindOfPurchase::updateOrCreate(['name' => 'Producción de centro'],['description' => 'Elementos de consumo que provienen de producción de centro']); // Actualizar o registrar Tipo de compra
        $measurement_unit = MeasurementUnit::updateOrCreate(['name' => 'Unidad'],[ // Actualizar o crear Unidad de medida
            'abbreviation' => 'Ud',
            'minimum_unit_measure' => 'Unidad',
            'conversion_factor' => 1
        ]);
        Element::updateOrCreate(['name' => 'Yogurt de mora x 225ml'],[  // Actualizar o registrar Elemento
            'measurement_unit_id' => $measurement_unit->id,
            'description' => 'Delicioso yogurt con sabor a Mora y trocitos de fruta',
            'kind_of_purchase_id' => $kind_of_purchase->id,
            'category_id' => $category->id,
            'price' => 2000,
            //'image' => ElementFactory::new()->make()->image  // Generar imagen faker
        ]);

        Element::updateOrCreate(['name' => 'Dona de chocolate x 50gr'],[ // Actualizar o registrar Elemento
            'measurement_unit_id' => $measurement_unit->id,
            'description' => 'Deliciosas donas de chocolate y crispy',
            'kind_of_purchase_id' => $kind_of_purchase->id,
            'category_id' => $category->id,
            'price' => 2500,
            //'image' => ElementFactory::new()->make()->image // // Generar imagen faker
        ]);

        $this->createElements($number_elements); // Generar elementos de prueba de acuerdo a la cantidad requerida

    }


    /* Algoritmo para eliminar las imágenes guardadas que no existen en la base de datos */
    public function cleanImages(){
        error_log('Eliminando imágenes de elementos del directorio (public/modules/sica/images/elements) que no se encuentran registrados en la base de datos.');
        error_log('---------');
        $allImages = array_map(function($path) { // Obtener todos los elementos existentes del directroio public/modules/sica/images/elements
            return str_replace(public_path(), '', $path);
        }, glob(public_path('modules/sica/images/elements/*')));

        $allImages = array_map(function($path) { // Eliminar signo \ de las rutas relativas anteriormente generadas
            return str_replace('\\', '', $path);
        }, $allImages);

        $registeredImages = Element::pluck('image')->toArray(); // Consultar todas las imágenes registradas en la tabla elements de la base de datos

        foreach ($allImages as $image) {
            if (!in_array($image, $registeredImages)) { // Verificación de imágenes que no existen en la tabla elements de la base de datos
                unlink(public_path($image)); // Eliminar imágenes que no están registradas
            }
        }
    }

    // Crear elementos faker de prueba de acuerdo a la cantidad de registros recibida
    public function createElements($amount){
        error_log("La correcta ejecución de este seeder será de acuerdo a su conexión de internet ya que se debe generar las imágenes faker de $amount elementos.");
        $count = 0;
        for ($i = 0; $i < $amount; $i++) {
            Element::factory()->create();
            $count++;
            error_log("Elemento $count de $amount creado.");
        }
    }
}
