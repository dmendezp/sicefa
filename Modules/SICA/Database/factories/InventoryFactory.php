<?php
namespace Modules\SICA\Database\factories;

use DateInterval;
use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\SICA\Entities\Element;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\Warehouse;

class InventoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\SICA\Entities\Inventory::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $fa = new DateTime(); // Fecha actual
        $fmp = $fa->sub(new DateInterval('P5Y')); // Fecha mínima de producción
        $fp = $this->faker->dateTimeBetween($fmp, $fa); // Fecha de producción
        $fmv = $fp->add(new DateInterval('P3Y')); // Fecha máxima de vencimiento
        $fv = $this->faker->dateTimeBetween($fp, $fmv); // Fecha de vencimiento

        $amount =  0;
        $state = $this->faker->randomElement(['Disponible','No disponible']);
        if($state == 'Disponible'){ // Verficar la cantidad para así establecer el estado del inventario del elemento
            $amount = $this->faker->numberBetween(0, 100);
        }

        $destinations = [ // Establecer los destinos del elemento en inventario
            'Producción',
            'Formación'
        ];

        return [
            'person_id' => Person::inRandomOrder()->first()->id,
            'warehouse_id' => Warehouse::inRandomOrder()->first()->id,
            'element_id' => Element::inRandomOrder()->first()->id,
            'destination' => $this->faker->randomElement($destinations),
            'description' => $this->faker->randomElement([null, rtrim($this->faker->unique()->sentence(), '.')]),
            'price' => $this->faker->numberBetween(10, 100) * 100,
            'amount' => $amount,
            'stock' => $this->faker->numberBetween(5, 30),
            'production_date' => $fp->format('Y-m-d'),
            'lot_number' => $this->faker->randomNumber(4, true),
            'expiration_date' => $fv->format('Y-m-d'),
            'state' => $state,
            'mark' => $this->faker->words(rand(0, 3), true),
            'inventory_code' => $this->faker->randomElement([null, $this->faker->randomNumber(7, true)])
        ];
    }
}

