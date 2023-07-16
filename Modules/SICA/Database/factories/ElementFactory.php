<?php
namespace Modules\SICA\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Modules\SICA\Entities\Category;
use Modules\SICA\Entities\KindOfPurchase;
use Modules\SICA\Entities\MeasurementUnit;

class ElementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\SICA\Entities\Element::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $element_name = $this->faker->unique()->words(rand(2,5), true); // Generar nombre del elemento

        // La generación de imágenes solo se debe activar para fines de pruebas
        //$base_path = 'modules/sica/images/elements/'; // Define la ruta base donde se guardarán las imágenes.
        //$image_faker = $this->faker->image('public/' . $base_path, 600, 400, null, false); // Genera una imagen aleatoria con las dimensiones 640x480 en la ruta base definida.

        return [
            'name' => $element_name,
            'measurement_unit_id' => MeasurementUnit::inRandomOrder()->first()->id,
            'description' => rtrim($this->faker->unique()->sentence(), '.'),
            'kind_of_purchase_id' => KindOfPurchase::inRandomOrder()->first()->id,
            'category_id' => Category::inRandomOrder()->first()->id,
            'price' => $this->faker->numberBetween(10, 100) * 100,
            'slug' => Str::slug($element_name, '-'),
            //'image' => $base_path . $image_faker // Devuelve la ruta completa de la imagen guardada.
        ];

    }

}
