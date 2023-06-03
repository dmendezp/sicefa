<?php

namespace Modules\PTVENTA\Http\Livewire\Sale;

use Livewire\Component;

class RegisterCustomer extends Component
{

    public $modal_state = false; // Define el estado del modal (para abrir o cerrarlo)
    public $document_types; // Tipos de documento
    public $document_type; // Tipo de documento
    public $document_number; // Número de documento
    public $first_name; // Primer y/o segundo nombre
    public $first_last_name; // Primer apellido
    public $second_last_name; // Segundo apellido

    protected $listeners = [
        'register-customer' => 'openModal',
    ];

    public function render(){
        $this->document_types = getEnumValues('people','document_type');
        return view('ptventa::livewire.sale.register-customer');
    }

    public function openModal()
    {
        $this->modal_state = true;
    }

    public function closeModal()
    {
        $this->modal_state = false;
    }
}
