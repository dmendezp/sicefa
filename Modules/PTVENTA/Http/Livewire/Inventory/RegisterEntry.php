<?php

namespace Modules\PTVENTA\Http\Livewire\Inventory;

use Livewire\Component;
use Modules\SICA\Entities\Warehouse;
use Modules\SICA\Entities\Category;
use Modules\SICA\Entities\Person;

class RegisterEntry extends Component
{

    public $warehouse; // Bodega de defecto de la aplicación
    public $warehouses; // Bodegas disponibles
    public $delivery_warehouse_id; // ID de la bodega que recibe
    public $delivery_document_number; // Número de identificación de la persona que entrega
    public $delivery_person; // Persona que entrega los productos para la entrada del inventario

    // La siquiente función es ejecutada cuando el componente es llamado por primera vez
    public function mount(){
        $this->defaultAction(); // Restablecer valores de todos los atributos y consultar productos disponibles para la venta
    }

    public function render()
    {
        return view('ptventa::livewire.inventory.register-entry');
    }

    // Establecer bodega
    public function defaultAction(){
        $this->reset(); // Vaciar los valores de todos los atributos para evitar irregularidades en los valores de estos
        $this->warehouse = Warehouse::where('name','Punto de venta')->firstOrFail();
        $this->warehouses = Warehouse::orderBy('name')->get();
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

}
