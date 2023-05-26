<?php
namespace Modules\SICA\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class KindOfPurchaseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\SICA\Entities\KindOfPurchase::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->words(rand(1,3), true),
            'description' => rtrim($this->faker->unique()->sentence(), '.')
        ];
    }
}

