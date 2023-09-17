<?php

namespace Modules\SICA\Http\Livewire\Admin\Security\PuRoles;

use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Modules\SICA\Entities\App;
use Modules\SICA\Entities\Role;

class ShowList extends Component
{

    public $apps; // Aplicaciones disponibles
    public $app_id; // ID de la aplicación seleccionada
    public $app_selected; // Informacion de la aplicación seleccionada

    // Escuchador de eventos
    protected $listeners = ['upUpdatedAppId'=>'runUpdatedAppId', 'confirmDestroyPuRole'=>'destroyPuRole'];

    // Esta función se ejecuta cuando el componente es llamado por primera vez
    public function mount(){
        $this->defaultAction(); // Restablecer todos los valores
    }

    public function render()
    {
        return view('sica::livewire.admin.security.pu-roles.show-list');
    }

    // Función por defecto para reestablecer los valores iniciales de la interfaz
    public function defaultAction(){
        $this->reset();
        $this->apps = App::orderBy('name')->get();
    }

    // Detectar cambio de valor en el select de aplicación
    public function updatedAppId($value){
        $this->reset('app_selected');
        $this->app_id = $value;
        if(!empty($value)){
            $this->app_selected = App::find($value);
        }
    }

    // Actualizar aplicación para recargar responsabilidades
    public function runUpdatedAppId($value){
        $this->updatedAppId($value);
    }

    // Eliminar asociación de unidad productiva y rol
    public function destroyPuRole($role_id, $productive_unit_id){
        Gate::authorize('haveaccess', 'sica.admin.security.roles.pu_roles.destroy'); // Verificar permiso por parte del usuario
        try {
            $role = Role::find($role_id);
            $role->productive_units()->detach($productive_unit_id);
            $this->updatedAppId($this->app_id); // Recargar las responsabilidades de la aplicación seleccionada
            $this->emit('message-livewire', 'success', 'Se eliminó exitosamente la asociación de unidad productiva y rol.'); // Lanzar evento para mostrar mensaje de éxito
        } catch (\Exception $e) {
            $this->emit('message-livewire', 'error', 'No se pudo eliminar la asociación de unidad productiva y rol.'); // Lanzar evento para mostrar mensaje de error1
        }
    }

}
