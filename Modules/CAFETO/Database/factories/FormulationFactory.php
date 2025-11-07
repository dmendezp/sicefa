<?php
namespace Modules\CAFETO\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\CAFETO\Http\Controllers\PUW;
use Modules\SICA\Entities\Element;
use Modules\SICA\Entities\Person;

class FormulationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\AGROINDUSTRIA\Entities\Formulation::class;
    protected $element_ids;
    protected $person_ids;
    protected $pu_id;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {

        if(!$this->element_ids){
            $this->element_ids = Element::pluck('id')->toArray();
        }
        if(!$this->person_ids){
            $this->person_ids = Person::pluck('id')->toArray();
        }
        if(!$this->pu_id){
            $this->pu_id = PUW::getAppPuw()->productive_unit->id;
        }

        return [
            'element_id' => $this->faker->unique()->randomElement($this->element_ids),
            'person_id' => $this->faker->randomElement($this->person_ids),
            'productive_unit_id' => $this->pu_id,
            'proccess' => $this->faker->unique()->paragraph(),
            'amount' => $this->faker->numberBetween(1, 10),
            'date' => $this->faker->date()
        ];
    }
}

