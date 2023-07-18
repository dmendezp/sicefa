<?php

namespace Modules\PTVENTA\Http\Livewire\Inventory;

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
use Modules\SICA\Entities\Warehouse;
use Modules\SICA\Entities\Person;
use Modules\SICA\Entities\WarehouseMovement;

class RegisterEntry extends Component
{

    public $warehouse; // Bodega de defecto de la aplicación
    public $warehouses; // Bodegas disponibles
    public $delivery_warehouse_id; // ID de la bodega que entrega
    public $delivery_document_number; // Número de identificación de la persona que entrega
    public $delivery_person; // Persona que entrega los productos para la entrada del inventario
    public $products; // Productos (elementos) disponibles
    public $product_element_id; // Producto (elemento) seleccionado
    public $product_price; // Precio del producto (elemento) seleccionado
    public $destinations; // Destinos disponibles para inventario
    public Collection $selected_products; // Productos (elementos) seleccionados
    public $product_amount; // Cantidad del producto (elemento) seleccionado
    public $product_production_date; // Fecha de produccón del producto (elemento) seleccionado
    public $product_expiration_date; // Fecha de vencimiento del producto (elemento) seleccionado
    public $product_lot_number; // Número de lote de producción del producto (elemento) seleccionado
    public $product_inventory_code; // Número de inventario del producto (elemento) seleccionado
    public $product_description; // Descripción del producto (elemento) sleccionado
    public $product_mark; // Marca del producto (elemento) seleccionado
    public $product_destination = 'Producción'; // Destino del producto (elemento) seleccionado

    public function __construct(){
        $this->selected_products = collect(); // Inicializa la variable que contiene la información de los productos seleccionados
    }

    // La siquiente función es ejecutada cuando el componente es llamado por primera vez
    public function mount(){
        $this->defaultAction(); // Restablecer valores de todos los atributos y consultar productos disponibles para la venta
    }

    public function render(){
        return view('ptventa::livewire.inventory.register-entry');
    }

    // Establecer bodega
    public function defaultAction(){
        $this->reset(); // Vaciar los valores de todos los atributos para evitar irregularidades en los valores de estos
        $this->warehouse = Warehouse::where('name','Punto de venta')->firstOrFail();
        $this->warehouses = Warehouse::orderBy('name')->get();
        $this->products = Element::whereNotNull('price')->orderBy('name')->get();
        $this->destinations = getEnumValues('inventories','destination'); // Consultar destinos para elementos de inventario
    }

    // Consultar persona que entrega
    public function consultPersonDelivery(){
        $delivery_person = Person::where('document_number',$this->delivery_document_number)->first();
        if($delivery_person){
            $this->delivery_person = $delivery_person;
        }else{
            $this->reset('delivery_person','delivery_document_number');
            $this->emit('message', 'alert-warning', null, 'La persona consultada no se encuentra registrada.'); // Emitir mensaje de advertencia para seleccionar un reponsable de entrega registrado
        }
    }

    // Agregar producto a la sección de los productos seleccionados
    public function addProduct(){
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
            'product_description' => $this->product_description,
            'product_mark' => $this->product_mark,
            'product_destination' => $this->product_destination
        ]);
        $this->resetValuesProduct();
    }

    // Vaciar variables del formulario de producto
    public function resetValuesProduct(){
        $this->reset('product_element_id','product_price','product_amount','product_production_date','product_expiration_date','product_lot_number','product_inventory_code','product_description','product_mark','product_destination');
    }

    // Editar producto selecionado
    public function editProduct($product_index){
        $product = $this->selected_products[$product_index];
        $this->product_element_id = $product['product_element_id'];
        $this->product_price = $product['product_price'];
        $this->product_amount = $product['product_amount'];
        $this->product_production_date = $product['product_production_date'];
        $this->product_expiration_date = $product['product_expiration_date'];
        $this->product_lot_number = $product['product_lot_number'];
        $this->product_inventory_code = $product['product_inventory_code'];
        $this->product_description = $product['product_description'];
        $this->product_mark = $product['product_mark'];
        $this->product_destination = $product['product_destination'];
        $this->selected_products->forget($product_index); // Eliminar el producto seleccionado para actualizar
    }

    // Eliminar producto seleccionado
    public function deleteProduct($product_index){
        $this->selected_products->forget($product_index);
    }

    // Registrar entrada de inventario
    public function registerEntry(){
        if($this->selected_products->isNotEmpty()){
            $person_delivery = Person::where('document_number',$this->delivery_document_number)->first();
            if($person_delivery){
                if(!empty($this->delivery_warehouse_id)){
                    // Registrar venta como movimiento
                    try {
                        DB::beginTransaction(); // Iniciar transacción

                        $current_datetime = now()->milliseconds(0); // Generer fecha y hora actual
                        $warehouse = Warehouse::where('name', 'Punto de venta')->first();

                        // Consultar tipo de movimiento para una venta
                        $error = 'TIPO DE MOVIMIENTO';
                        $movementType = MovementType::where('name','Movimiento Interno')->firstOrFail();

                        // Registrar movimiento
                        $error = 'MOVIMIENTO';
                        $movement = Movement::create([
                            'registration_date' => $current_datetime,
                            'movement_type_id' => $movementType->id,
                            'voucher_number' => 0,
                            'state' => 'Aprobado',
                            'price' => 0
                        ]);

                        // Registrar detalles de movimiento (productos, cantidades y precios)
                        $error = 'REGISTRO DE INVENTARIOS Y DETALLES DE MOVIMIENTO';
                        $movement_price = 0;
                        foreach ($this->selected_products as $product) {
                            $inventory = Inventory::create([
                                'person_id'=>Auth::user()->person_id,
                                'warehouse_id'=>$warehouse->id,
                                'element_id'=>$product['product_element_id'],
                                'destination'=>$product['product_destination'],
                                'description'=>$product['product_description'],
                                'price'=>$product['product_price'],
                                'amount'=>$product['product_amount'],
                                'stock'=>0,
                                'production_date'=>$product['product_production_date'],
                                'lot_number'=>$product['product_lot_number'],
                                'expiration_date'=>$product['product_expiration_date'],
                                'state'=>'Disponible',
                                'mark'=>$product['product_mark'],
                                'inventory_code'=>$product['product_inventory_code']
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
                            'person_id' => Auth::user()->person_id,
                            'movement_id' => $movement->id,
                            'role' => 'ENTREGA',
                            'date' => $current_datetime
                        ]);
                        MovementResponsibility::create([ // Registrar persona que recibe los productos
                            'person_id' => $person_delivery->id,
                            'movement_id' => $movement->id,
                            'role' => 'RECIBE',
                            'date' => $current_datetime
                        ]);

                        // Registrar movimientos de bodega
                        $error = 'MOVIMIENTOS DE BODEGA';
                        WarehouseMovement::create([
                            'warehouse_id' => $this->delivery_warehouse_id,
                            'movement_id' => $movement->id,
                            'role' => 'Entrega'
                        ]);
                        WarehouseMovement::create([
                            'warehouse_id' => $warehouse->id,
                            'movement_id' => $movement->id,
                            'role' => 'Recibe'
                        ]);

                        // Generar número de comprobante
                        $error = 'NÚMERO DE COMPROBANTE';
                        $movementType = MovementType::where('name','Movimiento Interno')->first();
                        $movementType->update(['consecutive' => $movementType->consecutive + 1]);
                        $movement->update([
                            'voucher_number' => $movementType->consecutive,
                            'price' => $movement_price,
                        ]);

                        DB::commit(); // Confirmar cambios realizados durante la transacción

                        // Transacción completada exitosamente
                        $this->emit('message', 'success', 'Operación realizada', 'Entrada de inventario registrado exitosamente.');
                        $this->defaultAction();
                    } catch (Exception $e) { // Capturar error durante la transacción
                        // Transacción rechazada
                        DB::rollBack(); // Devolver cambios realizados durante la transacción
                        $this->emit('message', 'error', 'Operación rechazada', 'Ha ocurrido un error en el registro de la entrada de inventario en '.$error.'. Por favor intente nuevamente.');
                    }
                } else {
                    $this->emit('message', 'alert-warning', null, 'Es necesario seleccionar una bodega de origen.'); // Emitir mensaje de advertencia cuando la bodega de origen no está seleccionado
                }
            }else{
                $this->emit('message', 'alert-warning', null, 'Es necesario seleccionar un responsable de entrega existente.'); // Emitir mensaje de advertencia cuando el responsable de entrega no esté seleccionado
            }
        } else {
            $this->emit('message', 'alert-warning', null, 'Es necesario agregar al menos un producto.'); // Emitir mensaje de advertencia cuando no hayan productos seleccionados
        }
    }

}
