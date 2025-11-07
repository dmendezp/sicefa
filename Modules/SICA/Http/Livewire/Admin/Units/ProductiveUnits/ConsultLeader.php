<?php

namespace Modules\SICA\Http\Livewire\Admin\Units\ProductiveUnits;

use Livewire\Component;
use Modules\SICA\Entities\Person;
use Illuminate\Support\Facades\Session;

class ConsultLeader extends Component
{

    public $leader_document_number; // Número de documento de la persona líder
    public $leader_id; // ID de la persona líder
    public $leader_full_name; // Nombre completo de la persona líder

    public function mount($productive_unit){
        // Verificar y asignar valores en caso de que se detecten variables de sesión para la recuperación de datos
        if (Session::has('leader_full_name')) {
            $this->leader_document_number = Session::get('leader_document_number', '');
            $this->leader_id = Session::get('leader_id', '');
            $this->leader_full_name = Session::get('leader_full_name', '');
        } else {
            if ($productive_unit !== null){ // Verificar y recuperar datos de productive_unit en caso de que se hayan asignado
                $this->leader_document_number = $productive_unit->person->document_number;
                $this->leader_id = $productive_unit->person_id;
                $this->leader_full_name = $productive_unit->person->full_name;
            } else {
                // Asignación de valores por defecto
                $this->leader_document_number = '';
                $this->leader_id = '';
                $this->leader_full_name = '';
            }
        }
    }

    public function render()
    {
        return view('sica::livewire.admin.units.productive-units.consult-leader');
    }

    // Consultar persona para liderar la unidad productiva
    public function consultLeader(){
        $leader = Person::where('document_number',$this->leader_document_number)->first();
        if($leader){
            $this->leader_document_number = $leader->document_number;
            $this->leader_id = $leader->id;
            $this->leader_full_name = $leader->full_name;
        }else{
            $this->leader_document_number = null;
            $this->leader_id = null;
            $this->leader_full_name = 'No se encontró a la persona consultada.';
        }
    }

}
