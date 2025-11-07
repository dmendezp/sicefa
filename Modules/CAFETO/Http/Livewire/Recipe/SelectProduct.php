<?php

namespace Modules\CAFETO\Http\Livewire\Recipe;

use Illuminate\Support\Facades\Session;
use Livewire\Component;
use Modules\SICA\Entities\Category;
use Modules\SICA\Entities\Element;

class SelectProduct extends Component
{

    public $categories; // Categorias disponibles
    public $category_id; // Id de la categoría seleccionada
    public $elements; // Elementos disponibles
    public $element_id; // Id del elemento seleccionado

    /* Ejecución de acciones antes de renderización del componente */
    public function mount($formulation){
        $this->categories = Category::orderBy('name')->get(); // Consultar categorias
        // Verificar y asignar valores en caso de que se detecten variables de sesión para la recuperación de datos
        if(Session::has('element_id')){
            $element = Element::find(Session::get('element_id'));
            $this->elements = $element->category->elements()->orderBy('name')->get();
            $this->element_id = $element->id;
            $this->category_id = $element->category_id;
        } else {
            // Verificar y recuperear datos de formulation en cao de que se hayan asignado
            if($formulation !== null){
                $this->elements = $formulation->element->category->elements()->orderBy('name')->get();
                $this->element_id = $formulation->element_id;
                $this->category_id = $formulation->element->category_id;
            }
        }
    }

    public function render()
    {
        return view('cafeto::livewire.recipe.select-product');
    }

    /* Detectar el cambio de valor del select de Categorias */
    public function updatedCategoryId($value){
        $this->reset('elements','element_id');
        if(!empty($value)){
            $this->elements = Element::where('category_id',$value)->orderBy('name')->get();
        }
    }

}
