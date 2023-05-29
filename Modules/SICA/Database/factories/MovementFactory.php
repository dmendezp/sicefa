<?php
namespace Modules\SICA\Database\factories;

use DateInterval;
use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\SICA\Entities\MovementType;

class MovementFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\SICA\Entities\Movement::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        $fa = new DateTime(); // Fecha actual
        $fmr = clone $fa; // Clonar fecha actual para la fecha mínima de inicio de registro
        $fmr->modify('-1 week'); // Fecha mínima de registros
        $fr = $this->faker->dateTimeBetween($fmr, $fa); // Fecha de registro
        $states = ['Anulado','Aprobado','Devuelto','Solicitado'];

        return [
            'registration_date' => $fr->format('Y-m-d H:i:s'),
            'movement_type_id' => MovementType::inRandomOrder()->first()->id,
            'voucher_number' => function (array $attributes) {
                $movementType = MovementType::find($attributes['movement_type_id']);
                $consecutive = $movementType->consecutive + 1;
                $movementType->update(['consecutive' => $consecutive]);
                return $consecutive;
            },
            'price' => $this->faker->numberBetween(10, 20000) * 100,
            'state' => $this->faker->randomElement($states)
        ];
    }
}

