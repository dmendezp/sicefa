<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Route;
use Modules\SICA\Entities\Category;
use Modules\SICA\Entities\Element;
use Modules\SICA\Entities\KindOfPurchase;

class Shopping extends Component
{

    public $name;
    public $elements;
    public $categories;
    public $category;
    public $loading = false;
    public $kp; 

    public function mount(){
        $this->defaultSearch();
    }


    public function render()
    {
        return view('livewire.shopping');
    }

    public function defaultSearch(){
        $this->loading = true;
        $this->reset('elements','categories','category','kp'); // Vaciar elementos, categorías y categoría para evitar duplicación de datos
        $this->kp = KindOfPurchase::where('name','Producción de centro')->firstOrFail();
        $this->elements = Element::where('kind_of_purchase_id', $this->kp->id)->orderBy('updated_at', 'DESC')->take(9)->get(); // Consulta por defecto (buscar los 9 primeros registros de elementos y ordenarlos por fecha de modificación)
        $this->categories = Category::orderBY('name', 'ASC')->get(); // Consultar todas las categorías de elementos
        $this->loading = false;
    }
}
