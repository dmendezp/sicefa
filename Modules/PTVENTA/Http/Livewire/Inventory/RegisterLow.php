<?php

namespace Modules\PTVENTA\Http\Livewire\Inventory;

use Exception;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Modules\PTVENTA\Http\Controllers\InventoryController;
use Modules\SICA\Entities\Element;
use Modules\SICA\Entities\Inventory;
use Modules\SICA\Entities\Movement;
use Modules\SICA\Entities\MovementDetail;
use Modules\SICA\Entities\MovementType;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\ProductiveUnitWarehouse;
use Modules\SICA\Entities\Warehouse;

class RegisterLow extends Component
{
    public $puw; // Unidad productiva y bodega de la aplicación
    public $products; 
    public $inventory_id; // Id del producto (inventario) seleccionado
    public Collection $selected_products; // Productos (inventario) seleccionados
    public $inventory; // Inventario seleccionado
    public $product_amount; // Contiene la cantidad del producto seleccionado
   
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
        $productive_unit = ProductiveUnit::where('name', 'Punto de venta')->firstOrFail(); // Unidad productiva de la aplicación
        $warehouse = Warehouse::where('name', 'Punto de venta')->firstOrFail(); // Bodega de la aplicación
        $this->puw = ProductiveUnitWarehouse::where('productive_unit_id', $productive_unit->id)->where('warehouse_id', $warehouse->id)->firstOrFail();
        $this->products = Inventory::where('productive_unit_warehouse_id', $this->puw->id)
                                    ->join('elements', 'inventories.element_id', '=', 'elements.id')
                                    ->orderBy('elements.name', 'ASC')
                                    ->select('inventories.*')
                                    ->where('inventories.amount', '<>', 0)
                                    ->get();
    }

    // Consultar información del producto seleccionado (cantidad y precio)
    public function inventoryProduct($inventory_id){ // Consultar cantidad disponible del producto
        $inventory = Inventory::where('productive_unit_warehouse_id',$this->puw->id)
                                ->where('element_id',$inventory_id)
                                ->where('state','Disponible')
                                ->select('element_id', DB::raw('SUM(amount) as product_total_amount'))
                                ->groupBy('element_id')
                                ->first();
        $inventory->sale_price = priceFormat(Element::findOrFail($inventory_id)->price); // Consultar precio de venta del producto
        return $inventory;
    }

    /* Detectar el cambio de select en el listado de productos */
    public function updatedInventoryId($value){
        $this->reset('inventory', 'product_amount');
        if(empty($value)){
            $this->emit('input-product-amount', 0);
        } else {
            $this->inventory = Inventory::find($this->inventory_id);
            $selected_amount = $this->selected_products->where('inventory_id', $value)->sum('product_amount');
            $this->inventory->amount = $this->inventory->amount - $selected_amount;
            $this->emit('input-product-amount', $this->inventory->amount );
        }
    }

    // Agregar producto a la lista de productos seleccionados
    public function addProduct() {
        if($this->product_amount <> 0){
            // Buscar si el inventory_id ya existe en la colección
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
            // Si el inventory_id no existe, agregar un nuevo registro
            if (!$found) {
                $this->selected_products->push([
                    'inventory_id' => $this->inventory_id,
                    'product_name' => $this->inventory->element->name,
                    'product_lot_number' => $this->inventory->lot_number,
                    'product_inventory_code' => $this->inventory->inventory_code,
                    'product_production_date' => $this->inventory->production_date,
                    'product_expiration_date' => $this->inventory->expiration_date,
                    'product_mark' => $this->inventory->mark,
                    'product_price' => $this->inventory->element->price,
                    'product_amount' => $this->product_amount,
                ]);
            }
        }
        $this->reset('inventory', 'product_amount', 'inventory_id');
    }

    // Editar producto de la tabla de de productos seleccionados para la baja de inventario
    public function editProduct($product_index){
        $this->reset('inventory');
        $product = $this->selected_products[$product_index];
        $inventory = Inventory::find($product['inventory_id']); 
        $this->inventory_id = $inventory->id;
        $this->inventory = $inventory;
        $this->product_amount = $product['product_amount'];
        $this->selected_products->forget($product_index); // Eliminar el producto seleccionado para actualizar
    }

    // Eliminar producto seleccionado
    public function deleteProduct($product_index){
        $this->selected_products->forget($product_index);
    }

    // Registrar la baja de inventario
    public function registerLow(){
        if ($this->selected_products->isNotEmpty()) {
            try{ // Registrar baja como movimmiento
                DB::beginTransaction();

                $current_datetime = now()->milliseconds(0); // Generer fecha y hora actual 

                // Consultar tipo de movimineto para una baja
                $error = 'TIPO DE MOVIMIENTO';
                $movementType = MovementType::where('name','Baja')->firstOfFail();

                // Registrar Movimiento
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

                // Generar número de comprobante
                $error = 'NÚMERO DE COMPROBANTE';
                $movementType = MovementType::where('name','Baja')->first();
                $movementType->update(['consecutive' => $movementType->consecutive + 1]);
                $movement->update([
                    'voucher_number' => $movementType->consecutive,
                    'price' => $movement_price,
                ]);

                DB::commit(); // Confirmar cambios realizados durante la transacion

                // Transaccion completada exitosamente
                $this->emit('message', 'success', 'Operacion realizadad', 'Baja de inventario realizada exitosamente');
                $this->defaultAction(); // Refrescar totalmente los componentes

            } catch (Exception $e) {
                // Transacción rechazada
                DB::rollBack(); // Devolver cambios realizados durante la transacción
                $this->emit('message', 'error', 'Operación rechazada', 'Ha ocurrido un error en el registro de la entrada de inventario en '.$error.'. Por favor intente nuevamente.');
            }
        } else {
            // Emitir mensaje de advertencia cuando no hayan productos seleccionados
            $this->emit('message', 'alert-warning', null, 'Es necesario agregar al menos un producto.');
        }
    }
}