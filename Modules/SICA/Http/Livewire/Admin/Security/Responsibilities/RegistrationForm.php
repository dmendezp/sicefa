<?php

namespace Modules\SICA\Http\Livewire\Admin\Security\Responsibilities;

use Livewire\Component;
use Modules\SICA\Entities\Activity;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\Responsibility;
use Modules\SICA\Entities\Role;
use Illuminate\Support\Facades\Gate;

class RegistrationForm extends Component
{

    public $apps; // Aplicaciones disponibles
    public $productive_units; // Unidades productivas disponibles
    public $app_id; // Aplicación seleccionada
    public $productive_unit_id; // Unidad productiva seleccionada
    public $roles; // Roles disponibles
    public $activities; // Actividades disponibles
    public $role_id; // Rol seleccionado
    public $activity_id; // Actividad seleccionada
    public $message_responsibility; // Mensaje relacionado con alguna operación de responsiblity
    public $color_message_responsibility; // Color del mensaje relacionado con alguna operación de responsiblity
    protected $rules = [ // Definir reglas de validación para registro de responsabilidad
        'app_id'=>'required',
        'role_id'=>'required',
        'productive_unit_id'=>'required',
        'activity_id'=>'required'
    ];

    // Escuchador de eventos
    protected $listeners = ['resetForm' => 'resetForm'];

    // Esta función se ejecuta cuando el componente es llamado por primera vez
    public function mount(){
        $this->defaultAction(); // Restablecer todos los valores
    }

    public function render(){
        return view('sica::livewire.admin.security.responsibilities.registration-form');
    }

    // Función por defecto para reestablecer los valores iniciales de la interfaz
    public function defaultAction(){
        $this->reset();
        $this->apps = App::orderBy('name','ASC')->get();
    }

    // Detectar cambio de valor en el select de aplicación
    public function updatedAppId($value){
        $this->resetExcept(['apps','app_id']);
        if(!empty($value)){
            $this->roles = Role::where('app_id', $this->app_id)->orderBy('name','ASC')->get();
            $this->productive_units = ProductiveUnit::whereHas('app_productive_units', function ($query) {
                $query->where('app_id', $this->app_id);
            })->orderBy('name','ASC')->get();
        }
    }

    // Detectar cambio de valor en el select de unidad productiva
    public function updatedProductiveUnitId($value){
        $this->reset('activities','activity_id');
        if(!empty($value)){
            $this->activities = Activity::where('productive_unit_id', $this->productive_unit_id)->orderBy('name','ASC')->get();
        }
    }

    // Registrar responsabilidad
    public function storeResponsibility(){
        Gate::authorize('haveaccess', 'sica.admin.security.roles.responsibilities.store'); // Verificar permiso por parte del usuario
        $this->validate(); // Ejecutar validación con los atributos definidos en la función rules()

        // Verificar que no exista un registro con los datos recibidos en la base de datos
        $existingRecord = Responsibility::where([
            'role_id' => $this->role_id,
            'activity_id' => $this->activity_id
        ])->exists();
        if (!$existingRecord) {
            /* Realizar el registro */
            $responsibility = new Responsibility();
            $responsibility->role_id = $this->role_id;
            $responsibility->activity_id = $this->activity_id;
            if ($responsibility->save()) {
                $this->emit('close-registration-modal'); // Lanzar evento para cerrar el modal de registro de responsabilidad
                $this->emit('upUpdatedAppId', $this->app_id); // Lanzar evento para recargar responsabilidades por aplicación
                $this->emit('message-livewire', 'success', 'Se registró exitosamente la responsabilidad.'); // Lanzar evento para mostrar mensaje de éxito
            } else {
                $this->message_responsibility = 'No se pudo registrar la responsabilidad.';
                $this->color_message_responsibility = 'danger';
                $this->emit('close_alert_message_responsability');

            }
        } else {
            $this->message_responsibility = 'Ya existe un registro con los datos enviados.';
            $this->color_message_responsibility = 'warning';
            $this->emit('close_alert_message_responsability');
        }
    }

    // Eliminar todas las variables utilizadas en el formulario
    public function resetForm(){
        $this->resetExcept(['apps']);
        $this->resetValidation();
    }

}
