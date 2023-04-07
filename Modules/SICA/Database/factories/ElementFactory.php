<?php
namespace Modules\SICA\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image; // composer require intervention/image

class ElementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\SICA\Entities\Element::class;

    /**
     * The name of the element.
     *
     * @var string
     */
    protected $name;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $faker = \Faker\Factory::create(); // Crea una instancia del objeto Faker.

        $base_path = 'modules/sica/images/elements/'; // Define la ruta base donde se guardarán las imágenes.
        $image_faker = $faker->image('public/' . $base_path, 600, 400, null, false); // Genera una imagen aleatoria con las dimensiones 640x480 en la ruta base definida.
        $image_file = new File(public_path($base_path . $image_faker)); // Crea un objeto File a partir de la imagen generada.
        Storage::disk('public')->putFileAs($base_path, $image_file, $image_faker); // Almacena la imagen en el disco público de Laravel.

        // Se requiere ejecutar los siguientes comando para manipular la imagen: composer require intervention/image
        $new_image_file = Image::make(public_path($base_path . $image_faker)); // Carga la imagen generada con Intervention Image para su posterior manipulación.
        $image_extension = pathinfo($image_faker, PATHINFO_EXTENSION); // Obtiene la extensión de la imagen generada.
        $newName = $this->name.'.'.$image_extension; // Define el nuevo nombre de la imagen con la extensión.
        $new_image_file->save(public_path($base_path . $newName)); // Guarda la imagen con el nuevo nombre.
        unlink(public_path($base_path . $image_faker)); // Elimina la imagen original.

        return [
            'image' => $base_path . $newName // Devuelve la ruta completa de la imagen guardada.
        ];

    }

    /**
     * Set the name of the element.
     *
     * @param  string  $name
     * @return $this
     */
    public function withName($name)  // Recibir parametro name(slug) para renombrar la imagen generada por el faker
    {
        $this->name = $name;
        return $this;
    }

}
