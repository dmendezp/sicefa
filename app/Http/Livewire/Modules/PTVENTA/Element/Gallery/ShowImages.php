<?php

namespace App\Http\Livewire\Modules\PTVENTA\Element\Gallery;

use Livewire\Component;
use Modules\SICA\Entities\Element;

class ShowImages extends Component
{

    public $search;
    public $elements;

    public function mount()
    {
        $this->defaultSearch();
    }

    public function render()
    {
        return view('livewire.modules.p-t-v-e-n-t-a.element.gallery.show-images');
    }

    public function searchElements(){
        $this->elements = Element::where('name', 'like', '%'.$this->search.'%')->get();
        if ($this->elements->isEmpty()) {
            $this->elements = [];
        }
    }

    public function defaultSearch(){
        $this->elements = Element::orderBy('updated_at', 'DESC')->take(12)->get();
    }

}
