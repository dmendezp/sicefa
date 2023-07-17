<?php

namespace Modules\PTVENTA\Http\Livewire\Inventory;

use Illuminate\Support\Collection;
use Livewire\Component;
use Modules\SICA\Entities\Element;
use Modules\SICA\Entities\Warehouse;
use Modules\SICA\Entities\Person;

class RegisterEntry extends Component
{

    public $warehouse; // Bodega de defecto de la aplicación
    public $warehouses; // Bodegas disponibles
    public $delivery_warehouse_id; // ID de la bodega que recibe
    public $delivery_document_number; // Número de identificación de la persona que entrega
    public $delivery_person; // Persona que entrega los productos para la entrada del inventario
    public $products; // Productos (elementos) disponibles
    public $product_element_id; // Producto (elemento) seleccionado
    public $product_name; // Nombre del producto (elemento) seleccionado
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
    public $product_destination; // Destino del producto (elemento) seleccionado

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

    // Detectar cambio el select de productos del formulario
    public function updatedProductElementId(){
        if(empty($this->product_element_id)){
            $this->reset('product_price');
        }else{
            // Consultar precio del elemento seleccionado
            $this->product_price = Element::find($this->product_element_id)->price;
        }
    }

    // Agregar productos a la sección de los productos seleccionados
    public function addProduct(){
            $this->selected_products->push([
                'product_element_id' => $this->product_element_id,
                'product_name' => Element::find($this->product_element_id)->product_name,
                'product_price' => $this->product_price,
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
        $this->reset(
            'product_element_id',
            'product_name',
            'product_price',
            'product_amount',
            'product_production_date',
            'product_expiration_date',
            'product_lot_number',
            'product_inventory_code',
            'product_description',
            'product_mark',
            'product_destination'
        );
    }

}
