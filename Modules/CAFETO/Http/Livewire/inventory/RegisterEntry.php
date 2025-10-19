<?php

namespace Modules\CAFETO\Http\Livewire\Inventory;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Modules\SICA\Entities\Element;
use Modules\SICA\Entities\Inventory;
use Modules\SICA\Entities\Movement;
use Modules\SICA\Entities\MovementDetail;
use Modules\SICA\Entities\MovementResponsibility;
use Modules\SICA\Entities\MovementType;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\ProductiveUnitWarehouse;
use Modules\SICA\Entities\WarehouseMovement;
use Illuminate\Support\Facades\Gate;
use Modules\CAFETO\Http\Controllers\PUW;

class RegisterEntry extends Component
{
    public $puw;
    public $products;
    public $destinations;
    public $productive_units;
    public $dpu_id;
    public $puwarehouses;
    public $dpuw_id;
    public $delivery_person;
    public $product_element_id;
    public $product_price;
    public Collection $selected_products;
    public $product_amount;
    public $product_production_date;
    public $product_expiration_date;
    public $product_lot_number;
    public $product_inventory_code;
    public $observation;
    public $product_mark;
    public $product_destination = 'Producción';

    protected $rules = [
        'product_element_id' => 'required|exists:elements,id',
        'product_amount' => 'required|numeric|min:1',
        'product_production_date' => 'required|date',
        'product_expiration_date' => 'required|date|after:product_production_date',
        'product_lot_number' => 'required|string|max:255',
        'product_inventory_code' => 'nullable|string|max:255',
        'product_mark' => 'nullable|string|max:255',
        'product_destination' => 'required|string',
        'dpu_id' => 'required|exists:productive_units,id',
        'dpuw_id' => 'required|exists:productive_unit_warehouses,id',
    ];

    public function __construct()
    {
        $this->selected_products = collect();
    }

    public function mount()
    {
        $this->defaultAction();
    }

    public function render()
    {
        return view('cafeto::livewire.inventory.register-entry');
    }

    public function defaultAction()
    {
        $this->reset();
        $this->puw = PUW::getAppPuw();
        $this->products = Element::whereNotNull('price')->orderBy('name', 'ASC')->get();
        $this->productive_units = ProductiveUnit::whereHas('productive_unit_warehouses')->orderBy('name', 'ASC')->get();
        $this->destinations = getEnumValues('inventories', 'destination');
        $this->selected_products = collect();
    }

    public function updatedDpuId($value)
    {
        $this->reset('puwarehouses', 'dpuw_id', 'delivery_person');
        if (!empty($value)) {
            $this->puwarehouses = ProductiveUnitWarehouse::where('productive_unit_id', $this->dpu_id)->get();
        }
    }

    public function updatedDpuwId($value)
    {
        $this->reset('delivery_person');
        if (!empty($value)) {
            $dp_id = ProductiveUnitWarehouse::findOrFail($value)->productive_unit->person_id;
            $this->delivery_person = Person::findOrFail($dp_id);
        }
    }

    public function addProduct()
    {
        $this->validate([
            'product_element_id' => 'required|exists:elements,id',
            'product_amount' => 'required|numeric|min:1',
            'product_production_date' => 'required|date',
            'product_expiration_date' => 'required|date|after:product_production_date',
            'product_lot_number' => 'required|string|max:255',
        ]);

        $product = Element::find($this->product_element_id);
        if (!$product) {
            $this->emit('message', 'alert-warning', null, 'El producto seleccionado no es válido.');
            return;
        }

        $this->selected_products->push([
            'product_element_id' => $this->product_element_id,
            'product_name' => $product->product_name,
            'product_price' => $product->price,
            'product_amount' => $this->product_amount,
            'product_production_date' => $this->product_production_date,
            'product_expiration_date' => $this->product_expiration_date,
            'product_lot_number' => $this->product_lot_number,
            'product_inventory_code' => $this->product_inventory_code,
            'product_mark' => $this->product_mark,
            'product_destination' => $this->product_destination,
        ]);

        $this->emit('message', 'success', null, 'Producto añadido correctamente.');
        $this->resetValuesProduct();
    }

    public function resetValuesProduct()
    {
        $this->reset('product_element_id', 'product_price', 'product_amount', 'product_production_date', 'product_expiration_date', 'product_lot_number', 'product_inventory_code', 'product_mark', 'product_destination');
    }

    public function editProduct($product_index)
    {
        $product = $this->selected_products[$product_index];
        $this->product_element_id = $product['product_element_id'];
        $this->product_price = $product['product_price'];
        $this->product_amount = $product['product_amount'];
        $this->product_production_date = $product['product_production_date'];
        $this->product_expiration_date = $product['product_expiration_date'];
        $this->product_lot_number = $product['product_lot_number'];
        $this->product_inventory_code = $product['product_inventory_code'];
        $this->product_mark = $product['product_mark'];
        $this->product_destination = $product['product_destination'];
        $this->selected_products->forget($product_index);
    }

    public function deleteProduct($product_index)
    {
        $this->selected_products->forget($product_index);
        $this->emit('message', 'success', null, 'Producto eliminado correctamente.');
    }

    public function registerEntry()
    {
        Gate::authorize('haveaccess', 'cafeto.admin-cashier.inventory.store');

        $this->validate([
            'dpu_id' => 'required|exists:productive_units,id',
            'dpuw_id' => 'required|exists:productive_unit_warehouses,id',
        ]);

        if ($this->selected_products->isEmpty()) {
            $this->emit('message', 'alert-warning', null, 'Es necesario agregar al menos un producto.');
            return;
        }

        try {
            DB::beginTransaction();

            $current_datetime = now()->milliseconds(0);
            $movementType = MovementType::where('name', 'Movimiento Interno')->firstOrFail();

            $movement = Movement::create([
                'registration_date' => $current_datetime,
                'movement_type_id' => $movementType->id,
                'voucher_number' => 0,
                'state' => 'Aprobado',
                'observation' => $this->observation,
                'price' => 0,
            ]);

            $movement_price = 0;
            foreach ($this->selected_products as $product) {
                $inventory = Inventory::create([
                    'person_id' => $this->puw->productive_unit->person_id,
                    'productive_unit_warehouse_id' => $this->puw->id,
                    'element_id' => $product['product_element_id'],
                    'destination' => $product['product_destination'],
                    'price' => $product['product_price'],
                    'amount' => $product['product_amount'],
                    'stock' => 0,
                    'production_date' => $product['product_production_date'],
                    'lot_number' => $product['product_lot_number'],
                    'expiration_date' => $product['product_expiration_date'],
                    'state' => 'Disponible',
                    'mark' => $product['product_mark'],
                    'inventory_code' => $product['product_inventory_code'],
                ]);

                MovementDetail::create([
                    'movement_id' => $movement->id,
                    'inventory_id' => $inventory->id,
                    'amount' => $product['product_amount'],
                    'price' => $product['product_price'],
                ]);

                $movement_price += $product['product_amount'] * $product['product_price'];
            }

            MovementResponsibility::create([
                'person_id' => $this->delivery_person->id,
                'movement_id' => $movement->id,
                'role' => 'ENTREGA',
                'date' => $current_datetime,
            ]);

            MovementResponsibility::create([
                'person_id' => Auth::user()->person_id,
                'movement_id' => $movement->id,
                'role' => 'RECIBE',
                'date' => $current_datetime,
            ]);

            WarehouseMovement::create([
                'productive_unit_warehouse_id' => $this->dpuw_id,
                'movement_id' => $movement->id,
                'role' => 'Entrega',
            ]);

            WarehouseMovement::create([
                'productive_unit_warehouse_id' => $this->puw->id,
                'movement_id' => $movement->id,
                'role' => 'Recibe',
            ]);

            $movementType->update(['consecutive' => $movementType->consecutive + 1]);
            $movement->update([
                'voucher_number' => $movementType->consecutive,
                'price' => $movement_price,
            ]);

            DB::commit();

            $this->emit('message', 'success', 'Operación realizada', 'Entrada de inventario registrada exitosamente.');
            $final_movement = Movement::with('warehouse_movements.productive_unit_warehouse.warehouse', 'movement_details.inventory.element.measurement_unit', 'movement_responsibilities.person')->find($movement->id);
            $this->emit('printTicket', $final_movement);
            $this->defaultAction();
        } catch (Exception $e) {
            DB::rollBack();
            $this->emit('message', 'error', 'Operación rechazada', 'Ha ocurrido un error en el registro de la entrada de inventario: ' . $e->getMessage());
        }
    }
}