<?php

namespace Modules\PTVENTA\Http\Livewire\Inventory;

use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Modules\PTVENTA\Http\Controllers\PUW;
use Modules\SICA\Entities\Inventory;
use Modules\SICA\Entities\Movement;
use Modules\SICA\Entities\MovementDetail;
use Modules\SICA\Entities\MovementResponsibility;
use Modules\SICA\Entities\MovementType;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\ProductiveUnitWarehouse;
use Modules\SICA\Entities\Warehouse;
use Modules\SICA\Entities\WarehouseMovement;

class RegisterLow extends Component
{
    public $puw; // Unidad productiva y bodega de la aplicación
    public $products; // Productos (elementos) disponibles
    public $inventory_id;
    public Collection $selected_products; // Productos (elementos) seleccionados
    public $inventory;
    public $product_amount; // Cantidad del producto (elemento) seleccionado
    public $observation; // Observación del movimiento

    public function __construct()
    {
        $this->selected_products = collect(); // Inicializa la variable que contiene la información de los productos seleccionados
    }

    // La siquiente función es ejecutada cuando el componente es llamado por primera vez
    public function mount()
    {
        $this->defaultAction(); // Restablecer valores de todos los atributos y consultar productos disponibles para la venta
    }

    public function render()
    {
        return view('ptventa::livewire.inventory.register-low');
    }

    // Establecer bodega
    public function defaultAction()
    {
        $this->reset(); // Vaciar los valores de todos los atributos para evitar irregularidades en los valores de estos
        $this->puw = PUW::getAppPuw(); // Obtener unidad productiva y bodega relacionada
        $this->products = Inventory::where('productive_unit_warehouse_id', $this->puw->id)
                                    ->join('elements', 'inventories.element_id', '=', 'elements.id')
                                    ->orderBy('elements.name', 'ASC')
                                    ->select('inventories.*')
                                    ->where('inventories.amount', '>', 0)
                                    ->get();
    }

    // Detectar cambio del select de unidad productiva de origen
    public function updatedInventoryId($value)
    {
        $this->reset('inventory', 'product_amount');
        if (empty($value)) {
            $this->emit('input-product-amount', 0);
        } else {
            $this->inventory = Inventory::find($this->inventory_id);
            $selected_amount = $this->selected_products->where('inventory_id', $value)->sum('product_amount');
            $this->inventory->amount = $this->inventory->amount - $selected_amount;
            $this->emit('input-product-amount', $this->inventory->amount);
        }
    }

    // Agregar producto a la sección de los productos seleccionado
    public function addProduct()
    {
        if ($this->product_amount <> 0) {
            $found = false;
            foreach ($this->selected_products as $key => $product) {
                if ($product['inventory_id'] == $this->inventory_id) {
                    $found = true;
                    $updatedProduct = [
                        'inventory_id' => $product['inventory_id'],
                        'product_name' => $product['product_name'],
                        'product_lot_number' => $product['product_lot_number'],
                        'product_production_date' => $product['product_production_date'],
                        'product_expiration_date' => $product['product_expiration_date'],
                        'product_mark' => $product['product_mark'],
                        'product_price' => $product['product_price'],
                        'product_amount' => $product['product_amount'] + $this->product_amount,
                    ];
                    $this->selected_products[$key] = $updatedProduct;
                    break;
                }
            }

            if (!$found) {
                $this->selected_products->push([
                    'inventory_id' => $this->inventory_id,
                    'product_name' => $this->inventory->element->product_name,
                    'product_lot_number' => $this->inventory->lot_number,
                    'product_inventory_code' => $this->inventory->inventory_code,
                    'product_production_date' => $this->inventory->production_date,
                    'product_expiration_date' => $this->inventory->expiration_date,
                    'product_mark' => $this->inventory->mark,
                    'product_price' => $this->inventory->price,
                    'product_amount' => $this->product_amount,
                ]);
            }
        }
        $this->reset('inventory', 'product_amount', 'inventory_id');
        $this->emit('input-product-amount', 0); // Actualizar cantidad máxima del producto y desactivarlo
    }

    public function editProduct($product_index)
    {
        $this->reset('inventory');
        $product = $this->selected_products[$product_index];
        $inventory = Inventory::find($product['inventory_id']);
        $this->inventory_id = $inventory->id;
        $this->inventory = $inventory;
        $this->product_amount = $product['product_amount'];
        $this->selected_products->forget($product_index);
    }

    public function deleteProduct($product_index)
    {
        $this->selected_products->forget($product_index);
    }

    public function registerLow()
    {
        $this->verifySelectedProduct();
        if ($this->selected_products->isNotEmpty()) {
            try {

                DB::beginTransaction();

                // Consultar tipo de movimiento para una venta
                $error = 'TIPO DE MOVIMIENTO';
                $current_datetime = now()->milliseconds(0);
                $movement_type = MovementType::where('name', 'Baja')->firstOrFail();

                // Registrar Movimiento
                $error = 'MOVIMIENTO';
                $movement = Movement::create([
                    'registration_date' => $current_datetime,
                    'movement_type_id' => $movement_type->id,
                    'voucher_number' => 0,
                    'state' => 'Aprobado',
                    'observation' => $this->observation,
                    'price' => 0
                ]);

                // Registrar detalles de movimiento y actualizar cantidades de inventario
                $error = 'DETALLES DE MOVIMIENTO';
                $movement_price = 0;
                foreach ($this->selected_products as $product) {
                    $inventory = Inventory::find($product['inventory_id']);
                    $inventory->amount -= $product['product_amount'];
                    $inventory->state = ($inventory->amount > 0) ? 'Disponible' : 'No disponible';
                    $inventory->save();

                    MovementDetail::create([
                        'movement_id' => $movement->id,
                        'inventory_id' => $inventory->id,
                        'amount' => $product['product_amount'],
                        'price' => $inventory->price
                    ]);

                    $movement_price += $inventory->price * $product['product_amount'];
                }

                // Registrar responsables del movimiento
                $error = 'RESPONSABLES DE MOVIMIENTO';
                MovementResponsibility::create([
                    'person_id' => Auth::user()->person_id,
                    'movement_id' => $movement->id,
                    'role' => 'ENTREGA',
                    'date' => $current_datetime
                ]);

                // Registrar movimientos de bodega
                $error = 'MOVIMIENTOS DE BODEGA';
                WarehouseMovement::create([
                    'productive_unit_warehouse_id' => $this->puw->id,
                    'movement_id' => $movement->id,
                    'role' => 'Entrega'
                ]);

                // Actualizar el consecutivo del tipo de movimiento
                $error = 'NÚMERO DE COMPROBANTE';
                $movement_type->update(['consecutive' => $movement_type->consecutive + 1]);
                $movement->update([
                    'voucher_number' => $movement_type->consecutive,
                    'price' => $movement_price,
                ]);

                DB::commit(); // Confirmar cambios realizados durante la transacción

                // Transacción completada exitosamente
                $this->emit('message', 'success', 'Operación realizada', 'Baja de inventario registrada exitosamente');

                // Obtener toda la información necesario para generar la orden de impresión
                $final_movement = Movement::with('warehouse_movements.productive_unit_warehouse.warehouse','movement_details.inventory.element.measurement_unit','movement_responsibilities.person')->find($movement->id);
                $this->emit('printTicket', $final_movement); // Enviar orden de impresión

                $this->defaultAction(); // Refrescar totalmente los componentes
            } catch (Exception $e) { // Capturar error durante la transacción
                // Transacción rechazada
                DB::rollBack(); // Devolver cambios realizados durante la transacción
                $this->emit('message', 'error', 'Operación rechazada', 'Ha ocurrido un error en el registro de la baja en '.$error.'. Por favor intente nuevamente.', null);
            }
        } else {
            // Emitir mensaje de advertencia cuando el producto no esta seleccionado
            $this->emit('message', 'alert-warning', null, 'Es necesario agregar al menos un producto.');
        }
    }

    private function verifySelectedProduct()
    {
        if ($this->selected_products->isEmpty()) {
            $this->emit('message', 'alert-warning', null, 'Debe seleccionar al menos un producto para la baja de inventario.');
            $this->emit('scroll-to-element', '#register-product-title');
        }
    }
}
