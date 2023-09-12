<?php

namespace Modules\SICA\Http\Livewire\Admin\Location\Farms;

use Livewire\Component;
use Illuminate\Support\Facades\Session;
use Modules\SICA\Entities\Country;
use Modules\SICA\Entities\Department;
use Modules\SICA\Entities\Municipality;
use Modules\SICA\Entities\Person;

class ConsultResponsible extends Component
{

    public $responsible_document_number; // Número de documento de la persona responsable
    public $responsible_id; // ID de la persona responsable
    public $responsible_full_name; // Nombre completo de la persona responsable
    public $countries; // Países disponibles
    public $country_id; // Id del país seleccionado
    public $departments; // Departamentos disponibles del país seleccionado
    public $department_id; // Id del departamento seleccionado
    public $municipalities; // Municipios disponibles del departamente seleccionado
    public $municipality_id; // Id del municipio seleccionado

    public function mount($farm){
        $this->countries = Country::orderBy('name','ASC')->get(); // Consultar países
        // Verificar y asignar valores en caso de que se detecten variables de sesión para la recuperación de datos
        if (Session::has('municipality_id')) {
            $this->responsible_document_number = Session::get('responsible_document_number', '');
            $this->responsible_id = Session::get('responsible_id', '');
            $this->responsible_full_name = Session::get('responsible_full_name', '');
            $municipality = Municipality::find(Session::get('municipality_id'));
            $this->municipalities = Municipality::where('department_id',$municipality->department_id)->orderBy('name','ASC')->get();
            $this->municipality_id = $municipality->id;
            $this->departments = Department::where('country_id',$municipality->department->country_id)->orderBy('name','ASC')->get();
            $this->department_id = $municipality->department_id;
            $this->country_id = $municipality->department->country_id;
        } else {
            if ($farm !== null){ // Verificar y recuperar datos de farm en caso de que se hayan asignado
                $this->responsible_document_number = $farm->person->document_number;
                $this->responsible_id = $farm->person_id;
                $this->responsible_full_name = $farm->person->full_name;
                $this->municipalities = Municipality::where('department_id',$farm->municipality->department_id)->orderBy('name','ASC')->get();
                $this->municipality_id = $farm->municipality->id;
                $this->departments = Department::where('country_id',$farm->municipality->department->country_id)->orderBy('name','ASC')->get();
                $this->department_id = $farm->municipality->department_id;
                $this->country_id = $farm->municipality->department->country_id;
            }
        }
    }

    public function render(){
        return view('sica::livewire.admin.location.farms.consult-responsible');
    }

    // Consultar persona responsable de la finca
    public function consultResponsible(){
        $responsible = Person::where('document_number',$this->responsible_document_number)->first();
        if($responsible){
            $this->responsible_document_number = $responsible->document_number;
            $this->responsible_id = $responsible->id;
            $this->responsible_full_name = $responsible->full_name;
        }else{
            $this->responsible_document_number = null;
            $this->responsible_id = null;
            $this->responsible_full_name = 'No se encontró a la persona consultada.';
        }
    }

    // Detectar el cambio de valor del select de paises
    public function updatedCountryId($value){
        $this->reset('departments','department_id','municipalities','municipality_id');
        if(!empty($value)){
            $this->departments = Department::where('country_id',$value)->orderBy('name','ASC')->get();
        }
    }

    // Detectar el cambio de valor del select de departamentos
    public function updatedDepartmentId($value){
        $this->reset('municipalities','municipality_id');
        if(!empty($value)){
            $this->municipalities = Municipality::where('department_id',$value)->orderBy('name','ASC')->get();
        }
    }

}
