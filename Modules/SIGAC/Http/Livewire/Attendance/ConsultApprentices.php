<?php

namespace Modules\SIGAC\Http\Livewire\Attendance;

use Livewire\Component;
use Modules\SICA\Entities\Apprentice;

class ConsultApprentices extends Component
{

    public $environments; // Lista de ambientes disponibles
    public $programs; // Lista cursos disponibles
    public $course_id; // Curso seleccionado
    public $apprentices; // Curso seleccionado

    public function mount($environments, $programs){
        $this->environments = $environments;
        $this->programs = $programs;
    }

    public function render()
    {
        return view('sigac::livewire.attendance.consult-apprentices');
    }

    // Detectar cambio de valor en la propiedad course_id
    public function updatedCourseId($value){
        if(empty($value)){
            $this->apprentices = null;
        }else{
            $this->apprentices = Apprentice::where('course_id',$value)->get();
        }
    }

}
