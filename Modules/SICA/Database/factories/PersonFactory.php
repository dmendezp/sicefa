<?php
namespace Modules\SICA\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\SICA\Entities\EPS;
use Modules\SICA\Entities\PopulationGroup;

class PersonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\SICA\Entities\Person::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'document_number' => $this->faker->unique()->randomNumber(rand(5,9), true),
            'document_type' => $this->faker->randomElement(getEnumValues('people','document_type')),
            'first_name' => $this->faker->firstName(),
            'first_last_name' => $this->faker->lastName(),
            'second_last_name' => $this->faker->lastName(),
            'eps_id' => EPS::pluck('id')->random(),
            'population_group_id' => PopulationGroup::pluck('id')->random()
        ];
    }
}

