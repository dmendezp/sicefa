<?php

namespace Modules\SENAEMPRESA\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\SICA\Entities\EPS;
use Modules\SICA\Entities\PensionEntity;
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

        $document_types = [ // Establecer los tipos de documentos existentes
            'Cédula de ciudadanía',
            'Tarjeta de identidad',
            'Cédula de extranjería',
            'Pasaporte',
            'Documento nacional de identidad',
            'Registro civil'
        ];

        return [
            'document_number' => $this->faker->unique()->randomNumber(rand(5, 9), true),
            'document_type' => $this->faker->randomElement($document_types),
            'first_name' => $this->faker->firstName(),
            'first_last_name' => $this->faker->lastName(),
            'second_last_name' => $this->faker->lastName(),
            'eps_id' => EPS::inRandomOrder()->first()->id,
            'population_group_id' => PopulationGroup::inRandomOrder()->first()->id,
            'pension_entity_id' => PensionEntity::inRandomOrder()->first()->id
            
        ];
    }
}
