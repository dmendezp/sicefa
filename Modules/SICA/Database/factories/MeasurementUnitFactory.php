<?php
namespace Modules\SICA\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MeasurementUnitFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\SICA\Entities\MeasurementUnit::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->word(),
            'minimum_unit_measure' => $this->faker->unique()->word(),
            'conversion_factor' => $this->faker->numberBetween(1, 12500)
        ];
    }
}
