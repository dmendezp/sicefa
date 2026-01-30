<?php

namespace Modules\CAFETO\Http\Livewire\Formulation;

use Livewire\Component;
use Modules\SICA\Entities\Category;
use Modules\SICA\Entities\Element;

class SelectProduct extends Component
{
    public $categories;
    public $category_id = 6; // default
    public $elements;
    public $element_id;

    public $useNewProduct = false;
    public $new_element_name = '';

    public function mount($formulation = null): void
    {
        $this->categories = Category::orderBy('name')->get();
        $this->elements = collect();

        if (old('category_id')) $this->category_id = (int)old('category_id');
        if (old('element_id')) $this->element_id = (int)old('element_id');
        if (old('use_new_product') !== null) $this->useNewProduct = (string)old('use_new_product') === '1';
        if (old('new_element_name') !== null) $this->new_element_name = (string)old('new_element_name');

        if (!empty($this->category_id)) {
            $this->elements = Element::where('category_id', $this->category_id)->orderBy('name')->get();
        }

        if ($this->useNewProduct) $this->element_id = null;

        // edición
        if ($formulation !== null && !old()) {
            if ($formulation->element) {
                $this->category_id = (int)$formulation->element->category_id;
                $this->elements = Element::where('category_id', $this->category_id)->orderBy('name')->get();
                $this->element_id = (int)$formulation->element_id;
                $this->new_element_name = '';
                $this->useNewProduct = false;
            }
        }
    }

    public function updatedCategoryId($value): void
    {
        $this->reset('elements', 'element_id');
        if (!empty($value)) {
            $this->elements = Element::where('category_id', $value)->orderBy('name')->get();
        }
    }

    public function updatedUseNewProduct($value): void
    {
        $this->useNewProduct = ($value === true || $value === 1 || $value === '1');
        if ($this->useNewProduct) $this->element_id = null;
        else $this->new_element_name = '';
    }

    public function render()
    {
        return view('cafeto::livewire.formulation.select-product');
    }
}
