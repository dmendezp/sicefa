<?php

namespace App\Http\Livewire\Modules\PTVENTA\Element\Gallery;

use Livewire\Component;
use Modules\SICA\Entities\Element;

class ShowImages extends Component
{

    public $name;
    public $elements;
    public $loading = false;

    public function mount(){ // Todo lo que se encuentre dentro de esta función se ejecuturá únicamente cuando el componente sea llamado por primera vez
        $this->defaultSearch();
    }

    public function updatedName(){ // Se ejecuta automaticamente cuando se detecta un cambio en $name
        if(!empty($this->name)){
            $this->searchElements();
        }else{
            $this->defaultSearch();
        }
    }

    public function render(){
        return view('livewire.modules.p-t-v-e-n-t-a.element.gallery.show-images');
    }

    public function searchElements(){ // Buscar elementos por nombre
        $this->loading = true;
        $this->reset('elements');
        $this->elements = Element::where('name', 'like', '%'.$this->name.'%')->get();
        $this->loading = false;
    }

    public function defaultSearch(){ // Consulta por defecto (buscar los 9 primeros registros y ordenarlos por fecha de modificación)
        $this->elements = Element::orderBy('updated_at', 'DESC')->take(9)->get();
    }

}
