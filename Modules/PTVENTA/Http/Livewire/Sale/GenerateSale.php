<?php

namespace Modules\PTVENTA\Http\Livewire\Sale;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Collection;
use Livewire\Component;
use Modules\SICA\Entities\Element;
use Modules\SICA\Entities\Inventory;
use Modules\SICA\Entities\MovementType;
use Modules\SICA\Entities\Warehouse;

class GenerateSale extends Component
{

    public $products; // Almacena todos los productos activos del inventario
    public $product_id; // Almacena el id del elemento selecionado
    public $product_price; // Contiene el precio del producto seleccionado de acuerdo a su inventario
    public $product_amount; // Contiene la cantidad del producto seleccionado
    public $product_total_amount; // Contiene la cantidad total del producto seleccionado de acuerdo a su inventario
    public $product_subtotal; // Contiene el Subtotal del valor del producto
    public $total = 0; // Contiene el valor total de todos los productos seleccionados
    public $input_payment_value = false; //
    public $payment_value; //
    public Collection $selected_products; // Productos seleccionados

    public function __construct()
    {
        $this->selected_products = collect(); // Inicializar la varible que cotiene la información de los productos seleccionados
    }

    public function mount(){ // Ejecución del método cuando se llama por primera vez el componente
        $this->defaultAction();
    }

    public function render()
    {
        return view('ptventa::livewire.sale.generate-sale');
    }

    // Restaurar todos los valores de la variables y consultar productos disponibles en inventario para la venta
    public function defaultAction(){
        $this->reset();
        $this->reset('products'); // Vaciar variable inventories para evitar la duplicación de la información contenida
        $warehouse = Warehouse::where('name','Punto de venta')->first(); // Consultar bodega de la aplicación
        $inventories = Inventory::where('warehouse_id',$warehouse->id)
                                ->where('destination','Producción')
                                ->where('state','Disponible')
                                ->pluck('id','element_id');  // Obtener elemen_id unicos para conocer los elementos activos del inventario
        $elementIds = $inventories->keys()->toArray(); // Obtenemos solo el id de los elementos
        $this->products = Element::whereIn('id', $elementIds)->orderBy('name')->get(); // Consultar elementos para acceder a su nombre
    }

    // Consultar información del producto seleccionado (cantidad y precio unitario)
    public function inventoryProduct($element_id){
        $warehouse = Warehouse::where('name','Punto de venta')->first();
        $inventory = Inventory::where('warehouse_id',$warehouse->id)
                                ->where('element_id',$element_id)
                                ->where('destination','Producción')
                                ->where('state','Disponible')
                                ->select('element_id', DB::raw('SUM(amount) as product_total_amount'), DB::raw('MAX(price) as min_price'))
                                ->groupBy('element_id')
                                ->first();
        return $inventory;
    }

    // Detectar cambio el select de productos del formulario
    public function updatedProductId(){
        if(empty($this->product_id)){
            $this->reset('product_total_amount','product_price');
            $this->emit('input-product-amount', 0, 0, 0, 0);
        }else{
            $inventory = $this->inventoryProduct($this->product_id);
            $produc_amount_selected = $this->selected_products->where('product_element_id', $this->product_id)->sum('product_amount');
            $this->product_total_amount = $inventory->product_total_amount - $produc_amount_selected;
            $this->product_price = $inventory->min_price;
            $this->reset('product_subtotal','product_amount');
            $this->emit('input-product-amount', $this->product_total_amount, $this->product_price, $this->product_subtotal, $this->total);
        }
    }

    // Agregar producto a la lista de productos seleccionados
    public function addProduct() {
        if($this->product_amount <> 0){
            // Buscar si el product_element_id ya existe en la colección
            $found = false;
            foreach ($this->selected_products as $key => $product) {
                if ($product['product_element_id'] == $this->product_id) {
                    $found = true;
                    $updatedProduct = [
                        'product_element_id' => $product['product_element_id'],
                        'product_name' => $product['product_name'],
                        'product_amount' => $product['product_amount'] + $this->product_amount,
                        'product_price' => $product['product_price'],
                        'product_subtotal' => $product['product_subtotal'] + ($this->product_amount * $product['product_price'])
                    ];
                    $this->selected_products[$key] = $updatedProduct;
                    break;
                }
            }
            // Si el product_element_id no existe, agregar un nuevo registro
            if (!$found) {
                $this->selected_products->push([
                    'product_element_id' => $this->product_id,
                    'product_name' => Element::find($this->product_id)->name,
                    'product_amount' => $this->product_amount,
                    'product_price' => $this->product_price,
                    'product_subtotal' => $this->product_amount * $this->product_price
                ]);
            }
            $this->totalValueProducts(); // Calcular el valor total de los productos seleccionados
        }
        $this->resetValues();
    }

    // Editar producto de la tabla de productos seleccionados
    public function editProduct($product_id){
        foreach ($this->selected_products as $index => $product) {
            if ($product['product_element_id'] == $product_id) {
                $this->resetValues();
                $this->product_id = $product['product_element_id'];
                $inventory = $this->inventoryProduct($this->product_id); // Consultar información del inventario del producto
                $this->product_price = $inventory->min_price;
                $this->product_amount = $product['product_amount'];
                $this->product_total_amount = $inventory->product_total_amount;
                $this->product_subtotal = $product['product_subtotal'];
                $this->selected_products->forget($index); // Eliminar el producto encontrado
                $this->totalValueProducts(); // Calcular el valor total de los productos seleccionados
                $this->emit('input-product-amount', $this->product_total_amount, $this->product_price, $this->product_subtotal, $this->total);
                break;
            }
        }
    }

    // Eliminar producto de lo tabla de productos seleccionados
    public function deleteProduct($product_id){
        foreach ($this->selected_products as $index => $product) {
            if ($product['product_element_id'] == $product_id) {
                $this->selected_products->forget($index); // Eliminar el producto encontrado
                $this->resetValues();
                break;
            }
        }
    }

    // Calcular el valor total de los productos seleccionados
    public function totalValueProducts(){
        $this->reset('total');
        $total = 0;
        foreach ($this->selected_products as $index => $product) {
            $total += $product['product_subtotal'];
        }
        $this->total = $total;
        if($total == 0 OR $total == null){
            $this->input_payment_value = false;
        }else{
            $this->input_payment_value = true;
        }
        $this->emit('input-payment-value', $this->total); // Configuración de validación para valor de cambio de venta y activación/desactivación del botón guardar venta
    }

    // Vaciar variables del componente
    public function resetValues(){
        $this->reset('product_id','product_total_amount','product_price','product_amount','product_subtotal');
        $this->totalValueProducts(); // Calcular el valor total de los productos seleccionados
    }

    // Ristrar venta
    public function registerSale(){
        // Verificar si hay algún producto seleccionado
        if($this->product_id <> null){
            if($this->product_amount >= 1){
                $this->addProduct();
            }else{
                $this->resetValues();
            }
        }

        // Registrar venta como movimiento
        try {
            DB::beginTransaction(); // Iniciar transacción
                // Consultar y modificar el número de comprobante de venta
                $movementType = MovementType::where('name','Venta')->first();
                $movementType->update(['consecutive' => $movementType->consecutive + 1]);
            DB::commit(); // Confirmar cambios realizados durante la transacción

            // Transacción completada exitosamente
            $this->emit('message', 'error', 'Operación rechazada', 'Ha ocurrido un error en el registro de la venta. Por favor intente nuevamente ('.$this->total.').');
        } catch (Exception $e) { // Capturar error durante la transacción
            DB::rollBack(); // Devolver cambios realizados durante la transacción
            $this->defaultAction();
            $this->emit('message', 'success', 'Operación realizada', 'Venta registrada exitosamente ('.$this->total.').');
        }
    }
}
