<?php

namespace Modules\PTVENTA\Http\Livewire\Element;

use Livewire\Component;
use Modules\SICA\Entities\Category;
use Modules\SICA\Entities\Element;

class ShowImages extends Component
{

    public $name;
    public $elements;
    public $categories;
    public $category;
    public $loading = false;

    public function mount(){ // Todo lo que se encuentre dentro de esta función se ejecuturá únicamente cuando el componente sea llamado por primera vez
        $this->defaultSearch();
    }

    public function updatedName(){ // Se ejecuta automaticamente cuando se detecta un cambio en $name
        if(!empty($this->name)){
            $this->searchByName();
        }else{
            $this->defaultSearch();
        }
    }

    public function render(){
        return view('ptventa::livewire.element.show-images');
    }

    public function searchByName(){ // Buscar elementos por nombre
        $this->loading = true;
        $this->reset('elements','category'); // Vaciar elementos para evitar duplicación de datos
        $this->elements = Element::where('name', 'like', '%'.$this->name.'%')->get();
        $this->loading = false;
    }

    public function defaultSearch(){
        $this->loading = true;
        $this->reset('elements','categories','category'); // Vaciar elementos, categorías y categoría para evitar duplicación de datos
        $this->elements = Element::orderBy('updated_at', 'DESC')->take(9)->get(); // Consulta por defecto (buscar los 9 primeros registros de elementos y ordenarlos por fecha de modificación)
        $this->categories = Category::orderBY('name', 'ASC')->get(); // Consultar todas las categorías de elementos
        $this->loading = false;
    }

    public function searchByCategory($category_id){
        $this->loading = true;
        $this->reset('elements'); // Vaciar elementos para evitar duplicación de datos
        $this->elements = Element::where('category_id',$category_id)->orderBy('updated_at', 'DESC')->get(); // Consultar por categoría
        $this->category = Category::find($category_id)->name;
        $this->loading = false;
    }

}
