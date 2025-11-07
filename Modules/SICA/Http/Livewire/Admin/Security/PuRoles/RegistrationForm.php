<?php

namespace Modules\SICA\Http\Livewire\Admin\Security\PuRoles;

use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Farm;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\Role;

class RegistrationForm extends Component
{

    public $apps; // Aplicaciones disponibles
    public $farms; // Fincas disponibles
    public $app_id; // Id de la aplicación seleccionada
    public $farm_id; // Id de la finca seleccionada
    public $roles; // Roles disponibles
    public $role_id; // Id del rol selecionado
    public $productive_units; // Unidades productivas disponibles
    public $productive_unit_id; // Id de la unidad productiva seleccionada
    public $message_pu_role; // Mensaje relacionado con alguna operación de pu_role
    public $color_message_pu_role; // Color del mensaje relacionado con alguna operación de pu_role
    protected $rules = [ // Definir reglas de validación para registro de asociación de unidad productiva y rol
        'app_id'=>'required',
        'role_id'=>'required',
        'farm_id'=>'required',
        'productive_unit_id'=>'required'
    ];

    // Escuchador de eventos
    protected $listeners = ['resetForm' => 'resetForm'];

    // Esta función se ejecuta cuando el componente es llamado por primera vez
    public function mount(){
        $this->defaultAction(); // Restablecer todos los valores
    }

    public function render(){
        return view('sica::livewire.admin.security.pu-roles.registration-form');
    }

    // Función por defecto para reestablecer los valores iniciales de la interfaz
    public function defaultAction(){
        $this->reset();
        $this->apps = App::orderBy('name')->get();
        $this->farms = Farm::orderBy('name')->get();
    }

    // Detectar cambio de valor en el select de aplicación
    public function updatedAppId($value){
        $this->reset(['roles','role_id']);
        if(!empty($value)){
            $this->roles = Role::where('app_id', $this->app_id)->orderBy('name')->get();
        }
    }

    // Detectar cambio de valor en el select de finca
    public function updatedFarmId($value){
        $this->reset(['productive_units','productive_unit_id']);
        if(!empty($value)){
            $this->productive_units = ProductiveUnit::where('farm_id', $this->farm_id)->orderBy('name')->get();
        }
    }

    // Registrar asociación de unidad productiva y rol
    public function storePuRole(){
        Gate::authorize('haveaccess', 'sica.admin.security.roles.pu_roles.store'); // Verificar permiso por parte del usuario
        $this->validate(); // Ejecutar validación con los atributos definidos en la función rules()

        // Verificar que no exista un registro con los datos recibidos en la base de datos
        $role = Role::find($this->role_id);
        if (!$role->productive_units->contains($this->productive_unit_id)) {
            /* Realizar el registro */
            try {
                $role->productive_units()->syncWithoutDetaching([$this->productive_unit_id]);
                $this->emit('close-registration-modal'); // Lanzar evento para cerrar el modal de registro de de asociación de unidad productiva y rol
                $this->emit('upUpdatedAppId', $this->app_id); // Lanzar evento para recargar las asociaciones de unidades productivas y roles por aplicación
                $this->emit('message-livewire', 'success', 'Se registró exitosamente la asociación de la unidad productiva y el rol.'); // Lanzar evento para mostrar mensaje de éxito
            } catch (\Exception $e) {
                $this->message_pu_role = 'No se pudo registrar la asociación de unidad productiva y rol.';
                $this->color_message_pu_role = 'danger';
                $this->emit('close_alert_message_pu_role');
            }
        } else {
            $this->message_pu_role = 'Ya existe un registro con los datos enviados.';
            $this->color_message_pu_role = 'warning';
            $this->emit('close_alert_message_pu_role');
        }
    }

    // Eliminar todas las variables utilizadas en el formulario
    public function resetForm(){
        $this->resetExcept(['apps','farms']);
        $this->resetValidation();
    }

}
