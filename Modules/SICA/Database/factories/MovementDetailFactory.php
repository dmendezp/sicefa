<?php
namespace Modules\SICA\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\SICA\Entities\Inventory;

class MovementDetailFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\SICA\Entities\MovementDetail::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'inventory_id' => Inventory::pluck('id')->random(),
            'amount' => $this->faker->numberBetween(1,10),
            'price' => function (array $attributes) {
                return Inventory::with('element')->find($attributes['inventory_id'])->element->price;
            },
        ];
    }
}

