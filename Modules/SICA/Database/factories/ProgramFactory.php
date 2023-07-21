<?php
namespace Modules\SICA\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\SICA\Entities\Network;

class ProgramFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\SICA\Entities\Program::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => rtrim($this->faker->unique()->sentence(),'.'),
            'network_id' => Network::pluck('id')->random(),
            'program_type' => $this->faker->randomElement(['Tecnólogo','Técnico','Operario']),
            'sofia_code' => $this->faker->unique()->randomNumber(6, true)
        ];
    }
}

