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

        return [
            'person_id' => Person::pluck('id')->random(),
            'warehouse_id' => Warehouse::pluck('id')->random(),
            'element_id' => Element::pluck('id')->random(),
            'destination' => $this->faker->randomElement(getEnumValues('inventories','destination')),
            'description' => $this->faker->randomElement([null, rtrim($this->faker->unique()->sentence(), '.')]),
            'price' => $this->faker->numberBetween(50, 10000000),
            'amount' => $this->faker->numberBetween(0, 1000),
            'stock' => $this->faker->numberBetween(0, 1000),
            'production_date' => $fp->format('Y-m-d'),
            'lot_number' => $this->faker->randomNumber(4, true),
            'expiration_date' => $fv->format('Y-m-d'),
            'state' => $this->faker->randomElement(getEnumValues('inventories','state')),
            'mark' => $this->faker->words(rand(0, 3), true),
            'inventory_code' => $this->faker->randomElement([null, $this->faker->randomNumber(7, true)])
        ];
    }
}

