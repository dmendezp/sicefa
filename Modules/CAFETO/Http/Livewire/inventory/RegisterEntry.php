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
    public $puw; // Unidad productiva y bodega de la aplicación
    public $products; // Productos (elementos) disponibles
    public $destinations; // Destinos disponibles para inventario
    public $productive_units; // Unidades productivas registradas
    public $dpu_id; // ID de la unidad productiva responsable de entrega
    public $puwarehouses; // Unidades productivas y bodegas disponibles a partir de la selección de la uniad productiva que entrega
    public $dpuw_id; // ID de la unidad productiva y bodega responsable de entrega
    public $delivery_person; // Persona responsable que entrega
    public $product_element_id; // Producto (elemento) seleccionado
    public $product_price; // Precio del producto (elemento) seleccionado
    public Collection $selected_products; // Productos (elementos) seleccionados
    public $product_amount; // Cantidad del producto (elemento) seleccionado
    public $product_production_date; // Fecha de produccón del producto (elemento) seleccionado
    public $product_expiration_date; // Fecha de vencimiento del producto (elemento) seleccionado
    public $product_lot_number; // Número de lote de producción del producto (elemento) seleccionado
    public $product_inventory_code; // Número de inventario del producto (elemento) seleccionado
    public $observation; // Observación del movimiento
    public $product_mark; // Marca del producto (elemento) seleccionado
    public $product_destination = 'Producción'; // Destino del producto (elemento) seleccionado

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
        return view('cafeto::livewire.inventory.register-entry');
    }

    // Establecer bodega
    public function defaultAction()
    {
        $this->reset(); // Vaciar los valores de todos los atributos para evitar irregularidades en los valores de estos
        $this->puw = PUW::getAppPuw(); // Obtener unidad productiva y bodega relacionada
        $this->products = Element::whereNotNull('price')->orderBy('name', 'ASC')->get();
        $this->productive_units = ProductiveUnit::whereHas('productive_unit_warehouses')->orderBy('name', 'ASC')->get();
        $this->destinations = getEnumValues('inventories', 'destination'); // Consultar destinos para elementos de inventario
    }

    // Detectar cambio del select de unidad productiva de origen
    public function updatedDpuId($value)
    {
        $this->reset('puwarehouses', 'dpuw_id', 'delivery_person');
        if (!empty($value)) {
            $this->puwarehouses = ProductiveUnitWarehouse::where('productive_unit_id', $this->dpu_id)->get();
        }
    }

    // Detectar cambio del select de bodega de origen
    public function updatedDpuwId($value)
    {
        $this->reset('delivery_person');
        if (!empty($value)) {
            $dp_id = ProductiveUnitWarehouse::findOrFail($value)->productive_unit->person_id;
            $this->delivery_person = Person::findOrFail($dp_id);
        }
    }

    // Agregar producto a la sección de los productos seleccionados
    public function addProduct()
    {
        if ($this->product_amount == 0) {
            // Emitir mensaje de advertencia cuando la bodega de origen no está seleccionada
            $this->emit('message', 'alert-warning', null, 'El producto que intentas agregar debe tener una cantidad superior a 0.');
        } else {
            $product = Element::find($this->product_element_id);
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
                'product_destination' => $this->product_destination
            ]);
            $this->resetValuesProduct();
        }
    }

    // Vaciar variables del formulario de producto
    public function resetValuesProduct()
    {
        $this->reset('product_element_id', 'product_price', 'product_amount', 'product_production_date', 'product_expiration_date', 'product_lot_number', 'product_inventory_code', 'product_mark', 'product_destination');
    }

    // Editar producto selecionado
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
        $this->selected_products->forget($product_index); // Eliminar el producto seleccionado para actualizar
    }

    // Eliminar producto seleccionado
    public function deleteProduct($product_index)
    {
        $this->selected_products->forget($product_index);
    }

    // Registrar entrada de inventario
    public function registerEntry()
    {
        Gate::authorize('haveaccess', 'cafeto.admin-cashier.inventory.store'); // Verificar permiso por parte del usuario
        if ($this->selected_products->isNotEmpty()) {
            if (!empty($this->dpu_id)) { // Validad que una unidad productiva de origen esté seleccionada
                if (!empty($this->dpuw_id)) { // Validad que la bodega de origen esté seleccionada
                    try { // Registrar venta como movimiento
                        DB::beginTransaction(); // Iniciar transacción

                        $current_datetime = now()->milliseconds(0); // Generer fecha y hora actual

                        // Consultar tipo de movimiento para una venta
                        $error = 'TIPO DE MOVIMIENTO';
                        $movementType = MovementType::where('name', 'Movimiento Interno')->firstOrFail();

                        // Registrar movimiento
                        $error = 'MOVIMIENTO';
                        $movement = Movement::create([
                            'registration_date' => $current_datetime,
                            'movement_type_id' => $movementType->id,
                            'voucher_number' => 0,
                            'state' => 'Aprobado',
                            'observation' => $this->observation,
                            'price' => 0
                        ]);

                        // Registrar detalles de movimiento (productos, cantidades y precios)
                        $error = 'REGISTRO DE INVENTARIOS Y DETALLES DE MOVIMIENTO';
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
                                'inventory_code' => $product['product_inventory_code']
                            ]);
                            MovementDetail::create([ // Registrar detalle de movimiento
                                'movement_id' => $movement->id,
                                'inventory_id' => $inventory->id,
                                'amount' => $product['product_amount'],
                                'price' => $product['product_price']
                            ]);
                            $movement_price += $product['product_amount'] * $product['product_price'];
                        }

                        // Registrar responsables del movimiento
                        $error = 'RESPONSABLES DE MOVIMIENTO';
                        MovementResponsibility::create([ // Registrar responsable que entrega los productos
                            'person_id' => $this->delivery_person->id,
                            'movement_id' => $movement->id,
                            'role' => 'ENTREGA',
                            'date' => $current_datetime
                        ]);
                        MovementResponsibility::create([ // Registrar persona que recibe los productos
                            'person_id' => Auth::user()->person_id,
                            'movement_id' => $movement->id,
                            'role' => 'RECIBE',
                            'date' => $current_datetime
                        ]);

                        // Registrar movimientos de bodega
                        $error = 'MOVIMIENTOS DE BODEGA';
                        WarehouseMovement::create([
                            'productive_unit_warehouse_id' => $this->dpuw_id,
                            'movement_id' => $movement->id,
                            'role' => 'Entrega'
                        ]);
                        WarehouseMovement::create([
                            'productive_unit_warehouse_id' => $this->puw->id,
                            'movement_id' => $movement->id,
                            'role' => 'Recibe'
                        ]);

                        // Generar número de comprobante
                        $error = 'NÚMERO DE COMPROBANTE';
                        $movementType = MovementType::where('name', 'Movimiento Interno')->first();
                        $movementType->update(['consecutive' => $movementType->consecutive + 1]);
                        $movement->update([
                            'voucher_number' => $movementType->consecutive,
                            'price' => $movement_price,
                        ]);

                        DB::commit(); // Confirmar cambios realizados durante la transacción

                        // Transacción completada exitosamente
                        $this->emit('message', 'success', 'Operación realizada', 'Entrada de inventario registrado exitosamente.');

                        // Obtener toda la información necesario para generar la orden de impresión
                        $final_movement = Movement::with('warehouse_movements.productive_unit_warehouse.warehouse', 'movement_details.inventory.element.measurement_unit', 'movement_responsibilities.person')->find($movement->id);
                        $this->emit('printTicket', $final_movement); // Enviar orden de impresión

                        $this->defaultAction(); // Refrescar totalmente los componentes
                    } catch (Exception $e) { // Capturar error durante la transacción
                        // Transacción rechazada
                        DB::rollBack(); // Devolver cambios realizados durante la transacción
                        $this->emit('message', 'error', 'Operación rechazada', 'Ha ocurrido un error en el registro de la entrada de inventario en ' . $error . '. Por favor intente nuevamente.');
                    }
                } else {
                    // Emitir mensaje de advertencia cuando la bodega de origen no está seleccionada
                    $this->emit('message', 'alert-warning', null, 'Es necesario seleccionar una bodega de origen.');
                }
            } else {
                // Emitir mensaje de advertencia cuando la unidad productiva de origen no esté seleccionada
                $this->emit('message', 'alert-warning', null, 'Es necesario seleccionar una unidad productiva de origen.');
            }
        } else {
            // Emitir mensaje de advertencia cuando no hayan productos seleccionados
            $this->emit('message', 'alert-warning', null, 'Es necesario agregar al menos un producto.');
        }
    }
}
