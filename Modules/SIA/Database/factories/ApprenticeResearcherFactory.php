<?php

namespace Modules\SIA\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\SIA\Entities\ApprenticeResearcher;
use Modules\SICA\Entities\Person;
use App\Models\User;
use Modules\SICA\Entities\Program;
use Modules\SICA\Entities\Course;
use Modules\SIA\Entities\Group;
use Modules\SIA\Entities\Project;

class ApprenticeResearcherFactory extends Factory
{
    protected $model = ApprenticeResearcher::class;

    public function definition()
    {
        $person = Person::factory()->create();
        $user = User::factory()->create(['person_id' => $person->id]);
        $program = Program::factory()->create();
        $course = Course::factory()->create(['program_id' => $program->id]);
        $group = Group::factory()->create();

        return [
            'person_id' => $person->id,
            'user_id' => $user->id,
            'program_id' => $program->id,
            'course_id' => $course->id,
            'group_id' => $group->id,
            'project_id' => $this->faker->optional()->randomElement([1, 2, null]), // Opcional, puede ser nulo
            'institution' => $this->faker->company(),
            'default_role_id' => $this->faker->numberBetween(40, 50), // Rango realista para roles
        ];
    }
}