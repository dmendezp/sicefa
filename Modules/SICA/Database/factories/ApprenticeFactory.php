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
        return [
            'person_id' => Person::pluck('id')->random(),
            'course_id' => Course::pluck('id')->random(),
            'apprentice_status' => $this->faker->randomElement(getEnumValues('apprentices','apprentice_status'))
        ];
    }
}

