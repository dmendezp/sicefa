<?php

namespace Modules\SICA\Http\Livewire\Admin\Security\Responsibilities;

use Livewire\Component;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Responsibility;
use Illuminate\Support\Facades\Gate;

class ShowList extends Component
{

    public $responsibilities; // Responsabilidades disponibles
    public $apps; // Aplicaciones disponibles
    public $app_id; // Id de la aplicación seleccionada
    public $app_selected; // Aplicación seleccionada

    // Escuchador de eventos
    protected $listeners = ['upUpdatedAppId'=>'runUpdatedAppId', 'confirmDestroyResponsibility'=>'destroyResponsibility'];

    // Esta función se ejecuta cuando el componente es llamado por primera vez
    public function mount(){
        $this->defaultAction(); // Restablecer todos los valores
    }

    public function render(){
        return view('sica::livewire.admin.security.responsibilities.show-list');
    }

    // Función por defecto para reestablecer los valores iniciales de la interfaz
    public function defaultAction(){
        $this->reset();
        $this->apps = App::orderBy('name','ASC')->get();
    }

    // Detectar cambio de valor en el select de aplicación
    public function updatedAppId($value){
        $this->reset('responsibilities','app_selected');
        $this->app_id = $value;
        if(!empty($value)){
            $this->app_selected = App::find($value);
            $this->responsibilities = Responsibility::join('roles', 'responsibilities.role_id', '=', 'roles.id')
            ->join('activities', 'responsibilities.activity_id', '=', 'activities.id')
            ->join('productive_units', 'activities.productive_unit_id', '=', 'productive_units.id')
            ->where('roles.app_id', $value)
            ->select('responsibilities.*')
            ->orderBy('roles.name', 'asc')
            ->orderBy('productive_units.name', 'asc')
            ->orderBy('activities.name', 'asc')
            ->get();
        }
    }

    // Actualizar aplicación para recargar responsabilidades
    public function runUpdatedAppId($value){
        $this->updatedAppId($value);
    }

    // Eliminar responsabilidad
    public function destroyResponsibility($responsibility_id){
        Gate::authorize('haveaccess', 'sica.admin.security.roles.responsibilities.destroy'); // Verificar permiso por parte del usuario
        $responsibility = Responsibility::find($responsibility_id);
        if ($responsibility->delete()){
            $this->updatedAppId($this->app_id); // Recargar las responsabilidades de la aplicación seleccionada 
            $this->emit('message-livewire', 'success', 'Se eliminó exitosamente la responsabilidad.'); // Lanzar evento para mostrar mensaje de éxito
        } else {
            $this->emit('message-livewire', 'error', 'No se pudo eliminar la responsabilidad.'); // Lanzar evento para mostrar mensaje de éxito
        }
    }

}
