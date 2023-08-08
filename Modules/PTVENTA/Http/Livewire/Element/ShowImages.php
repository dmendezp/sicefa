<?php

namespace Modules\PTVENTA\Http\Livewire\Element;

use Illuminate\Support\Facades\Route;
use Livewire\Component;
use Modules\SICA\Entities\Category;
use Modules\SICA\Entities\Element;
use Modules\SICA\Entities\KindOfPurchase;

class ShowImages extends Component
{

    public $name;
    public $elements;
    public $categories;
    public $category;
    public $loading = false;
    public $kp; // Almacena el tipo de compra de los elementos
    public $current_route_name; // Almacena el nombre de la ruta actual

    public function mount(){ // Todo lo que se encuentre dentro de esta función se ejecuturá únicamente cuando el componente sea llamado por primera vez
        $this->current_route_name = Route::currentRouteName();
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
        $this->elements = Element::where('kind_of_purchase_id', $this->kp->id)->where('name', 'like', '%'.$this->name.'%')->get();
        $this->loading = false;
    }

    public function defaultSearch(){
        $this->loading = true;
        $this->reset('elements','categories','category','kp'); // Vaciar elementos, categorías y categoría para evitar duplicación de datos
        $this->kp = KindOfPurchase::where('name','Producción de centro')->firstOrFail();
        $this->elements = Element::where('kind_of_purchase_id', $this->kp->id)->orderBy('updated_at', 'DESC')->take(9)->get(); // Consulta por defecto (buscar los 9 primeros registros de elementos y ordenarlos por fecha de modificación)
        $this->categories = Category::orderBY('name', 'ASC')->get(); // Consultar todas las categorías de elementos
        $this->loading = false;
    }

    public function searchByCategory($category_id){
        $this->loading = true;
        $this->reset('elements'); // Vaciar elementos para evitar duplicación de datos
        $this->elements = Element::where('kind_of_purchase_id', $this->kp->id)->where('category_id',$category_id)->orderBy('name', 'ASC')->get(); // Consultar por categoría
        $this->category = Category::find($category_id)->name;
        $this->loading = false;
    }

}
