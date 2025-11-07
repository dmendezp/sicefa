<?php
namespace Modules\SICA\Database\factories;

use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\SICA\Entities\Program;

class CourseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\SICA\Entities\Course::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $fa = new DateTime(); // Fecha actual
        $fmif = clone $fa; // Clonar fecha actual para la fecha mínima de inicio de formación
        $fmif->modify('-5 years'); // Fecha mínima de inicio de formación
        $fif = $this->faker->dateTimeBetween($fmif, $fa); // Fecha de inicio de formación

        $program = Program::inRandomOrder()->first(); // Consultar un programa de manera aleatoria
        $program_type = $program->program_type; // Obtener el tipo de programa

        $fff = clone $fif; // Clonar fecha de inicio de formación
        if ($program_type == 'Técnico' or $program_type == 'Operario') {
            $fff->modify('+1 years'); // Establecer fecha de fin de formación agregando 1 año adicional a la fecha de inicio de formación
        } elseif ($program_type == 'Tecnólogo') {
            $fff->modify('+2 years'); // Establecer fecha de fin de formación agregando 2 años adicionales a la fecha de inicio de formación
        }

        $status = ($fff < $fa) ? 'Inactivo' : 'Activo'; // Obtener el statdo de acuerdo a que la fecha fin de formación sea menor o mayor a la actual

        return [
            'code' => $this->faker->unique()->randomNumber(7, true),
            'star_date' => $fif->format('Y-m-d'),
            'end_date' => $fff->format('Y-m-d'),
            'status' => $status,
            'program_id' => $program->id,
            'deschooling' => $this->faker->randomElement(getEnumValues('courses','deschooling'))
        ];
    }
}

