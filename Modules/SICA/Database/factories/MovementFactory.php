<?php
namespace Modules\SICA\Database\factories;

use DateInterval;
use DateTime;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\SICA\Entities\Movement;
use Modules\SICA\Entities\MovementDetail;
use Modules\SICA\Entities\MovementResponsibility;
use Modules\SICA\Entities\MovementType;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\ProductiveUnitWarehouse;
use Modules\SICA\Entities\Warehouse;
use Modules\SICA\Entities\WarehouseMovement;

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
        $fmr->modify('-2 months'); // Fecha mínima de registros
        $fr = $this->faker->dateTimeBetween($fmr, $fa); // Fecha de registro

        return [
            'registration_date' => $fr->format('Y-m-d H:i:s'),
            'movement_type_id' => MovementType::where('name','Venta')
                                                ->orWhere('name','Movimiento Interno')
                                                ->inRandomOrder()
                                                ->first()
                                                ->id,
            'voucher_number' => function (array $attributes) {
                $movementType = MovementType::find($attributes['movement_type_id']);
                $consecutive = $movementType->consecutive + 1;
                $movementType->update(['consecutive' => $consecutive]);
                return $consecutive;
            },
            'price' => 0,
            'state' => 'Aprobado'
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        return $this->afterCreating(function (Movement $movement) {
            $md_amount = $this->faker->numberBetween(1,5); // Cantidad de detalles de movimiento
            MovementDetail::factory()->count($md_amount)->create([ // Generar detalles de movimiento
                'movement_id' => $movement->id,
            ]);
            $price = $movement->movement_details->sum(function ($movement_detail) { // Calcula valor sumatoria de valor total de los detalles de movimiento
                return $movement_detail->price * $movement_detail->amount;
            });
            $movement->update(['price' => $price]);

            // Obtener unidades productivas y bodegas de origen y destino
            $receive_productive_unit = ProductiveUnit::where('name','Punto de venta')->firstOrFail();
            $receive_warehouse = Warehouse::where('name','Punto de venta')->firstOrFail();
            $receive_puw = ProductiveUnitWarehouse::where('productive_unit_id',$receive_productive_unit->id)->where('warehouse_id',$receive_warehouse->id)->firstOrFail();
            $delivery_productive_unit = ProductiveUnit::where('name','Complejo agroindustrial')->firstOrFail();
            $delivery_warehouse = Warehouse::where('name','Agroindustria')->firstOrFail();
            $delivery_puw = ProductiveUnitWarehouse::where('productive_unit_id',$delivery_productive_unit->id)->where('warehouse_id',$delivery_warehouse->id)->firstOrFail();

            // Generar responsables de movimientos
            if($movement->movement_type->name == 'Venta'){
                MovementResponsibility::create([
                    'person_id' => Person::where('document_number',1004494010)->first()->id,
                    'movement_id' => $movement->id,
                    'role' => 'VENDEDOR',
                    'date' => $movement->registration_date
                ]);
                MovementResponsibility::create([
                    'person_id' => Person::where('document_number',123456789)->first()->id,
                    'movement_id' => $movement->id,
                    'role' => 'CLIENTE',
                    'date' => $movement->registration_date
                ]);
                WarehouseMovement::create([
                    'productive_unit_warehouse_id'=>$receive_puw->id,
                    'movement_id'=>$movement->id,
                    'role'=>'ENTREGA'
                ]);
            }else if($movement->movement_type->name == 'Movimiento Interno'){
                MovementResponsibility::create([
                    'person_id' => Person::where('document_number',7723876)->first()->id,
                    'movement_id' => $movement->id,
                    'role' => 'ENTREGA',
                    'date' => $movement->registration_date
                ]);
                MovementResponsibility::create([
                    'person_id' => Person::where('document_number',52829681)->first()->id,
                    'movement_id' => $movement->id,
                    'role' => 'RECIBE',
                    'date' => $movement->registration_date
                ]);
                WarehouseMovement::firstOrCreate([
                    'productive_unit_warehouse_id'=>$delivery_puw->id,
                    'movement_id'=>$movement->id,
                    'role'=>'ENTREGA'
                ]);
                WarehouseMovement::firstOrCreate([
                    'productive_unit_warehouse_id'=>$receive_puw->id,
                    'movement_id'=>$movement->id,
                    'role'=>'RECIBE'
                ]);
            }
            return $this;
        });
    }

}

