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
    public $delivery_document_number; // Número de identificación de la persona que entrega
    public $delivery_warehouse_id; // ID de la bodega que recibe

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
    public function consultPersonDelive(){
        $delivery_person = Person::where('document_number',$this->delivery_document_number)->first();
        /* if($delivery_person){
            $this->customer_document_number = $customer->document_number;
            $this->customer_document_type = $customer->document_type;
            $this->customer_full_name = $customer->full_name;
        }else{
            $this->person_document_number = $this->customer_document_number; // Recuperar el número de documento ingresado para mostrar en el formulario de registro de cliente(persona)
            $this->customer_document_number = null;
            $this->customer_document_type = '----------------';
            $this->customer_full_name = '----------------';
            $this->emit('open-modal-register-customer'); // Abrir el modal con el formulario de registro
        } */
    }

}
