<?php

namespace Modules\PTVENTA\Http\Livewire\Sale;

use Livewire\Component;
use Modules\SICA\Entities\Inventory;
use Modules\SICA\Entities\Warehouse;

class GenerateSale extends Component
{

    public $products; // Almacena todos los productos activos del inventario

    public function mount(){ // Ejecución del método cuando se llama por primera vez el componente
        $this->defaultAction();
    }

    public function render()
    {
        return view('ptventa::livewire.sale.generate-sale');
    }

    public function defaultAction(){
        $this->reset('products'); // Vaciar variable inventories para evitar la duplicación de la información contenida
        $warehouse = Warehouse::where('name','Punto de venta')->first(); // Consultar bodega de la aplicación
        $inventories = Inventory::where('warehouse_id',$warehouse->id)
                                ->where('destination','Producción')
                                ->where('state','Disponible')
                                ->join('elements', 'inventories.element_id', '=', 'elements.id')
                                ->orderBy('elements.name', 'ASC')
                                ->orderBy('inventories.production_date', 'ASC')
                                ->get(); // Consultar productos disponibles para la venta (Elementos de producción)
        $this->products = $inventories->pluck('elements.name','inventories.id'); // Obtener el nombre del producto y el id del inventario en una colección
    }
}
