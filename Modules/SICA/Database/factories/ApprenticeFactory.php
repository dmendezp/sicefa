<?php
namespace Modules\SICA\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\SICA\Entities\Course;
use Modules\SICA\Entities\Person;

class ApprenticeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\SICA\Entities\Apprentice::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $aprentice_status = [ // Establecer los estados para los aprendices
            'NO REGISTRA',
            'CERTIFICADO',
            'EN FORMACIÓN',
            'RETIRO VOLUNTARIO',
            'CANCELADO',
            'TRASLADADO',
            'APLAZADO',
            'INDUCCIÓN'
        ];

        return [
            'person_id' => Person::inRandomOrder()->first()->id,
            'course_id' => Course::inRandomOrder()->first()->id,
            'apprentice_status' => $this->faker->randomElement($aprentice_status)
        ];
    }
}

