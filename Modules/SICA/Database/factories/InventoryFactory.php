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

        $fmp = clone $fa; // Clonar fecha actual para fecha mínima de producción
        $fmp->modify('-1 week'); // Generar fecha mínima de producción
        $fp = $this->faker->dateTimeBetween($fmp, $fa); // Fecha de producción

        $fmv = clone $fp; // Clonar fecha de producción para fecha de vencimiento
        $fmv->modify('+1 week'); // Generar fecha máxima de vencimiento
        $fv = $this->faker->dateTimeBetween($fp, $fmv); // Fecha de vencimiento

        $amount =  0;
        $state = $this->faker->randomElement(['Disponible','No disponible']);
        if($state == 'Disponible'){ // Verficar la cantidad para así establecer el estado del inventario del elemento
            $amount = $this->faker->numberBetween(1, 100);
        }

        return [
<<<<<<< HEAD
            'person_id' => Person::pluck('id')->random(),
            'warehouse_id' => Warehouse::pluck('id')->random(),
            'element_id' => Element::pluck('id')->random(),
            'destination' => $this->faker->randomElement(getEnumValues('inventories','destination')),
=======
            'element_id' => Element::whereNotNull('price')->pluck('id')->random(),
            'destination' => 'Producción',
>>>>>>> FABRICA4
            'description' => $this->faker->randomElement([null, rtrim($this->faker->unique()->sentence(), '.')]),
            'price' => $this->faker->numberBetween(10, 1000) * 100,
            'amount' => $amount,
            'stock' => $this->faker->numberBetween(5, 30),
            'production_date' => $fp->format('Y-m-d'),
            'lot_number' => $this->faker->randomNumber(4, true),
            'expiration_date' => $fv->format('Y-m-d'),
            'state' => $state,
            'mark' => 'CEFA'
        ];
    }
}

