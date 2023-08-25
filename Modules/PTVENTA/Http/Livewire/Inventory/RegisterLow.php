<?php

namespace Modules\PTVENTA\Http\Livewire\Inventory;

use Illuminate\Support\Collection;
use Livewire\Component;
use Modules\SICA\Entities\Element;
use Modules\SICA\Entities\Inventory;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\ProductiveUnitWarehouse;
use Modules\SICA\Entities\Warehouse;

class RegisterLow extends Component
{
    public $puw; // Unidad productiva y bodega de la aplicación
    public $products; 
    public $inventory_id; // Id del producto (inventario) seleccionado
    public Collection $selected_products; // Productos (inventario) seleccionados
    public $inventory; // Inventario seleccionado
   
    public function __construct()
    {
        $this->selected_products = collect(); // Inicializa la variable que contiene la información de los productos seleccionados
    }

    // La siquiente función es ejecutada cuando el componente es llamado por primera vez
    public function mount()
    {
        $this->defaultAction(); // Restablecer valores de todos los atributos y consultar productos disponibles para la venta
    }

    public function render()
    {
        return view('ptventa::livewire.inventory.register-low');
    }

    // Establecer bodega
    public function defaultAction()
    {
        $this->reset(); // Vaciar los valores de todos los atributos para evitar irregularidades en los valores de estos
        $productive_unit = ProductiveUnit::where('name', 'Punto de venta')->firstOrFail(); // Unidad productiva de la aplicación
        $warehouse = Warehouse::where('name', 'Punto de venta')->firstOrFail(); // Bodega de la aplicación
        $this->puw = ProductiveUnitWarehouse::where('productive_unit_id', $productive_unit->id)->where('warehouse_id', $warehouse->id)->firstOrFail();
        $this->products = Inventory::where('productive_unit_warehouse_id', $this->puw->id)
                                    ->join('elements', 'inventories.element_id', '=', 'elements.id')
                                    ->orderBy('elements.name', 'ASC')
                                    ->select('inventories.*')
                                    ->where('inventories.amount', '<>', 0)
                                    ->get();
    }

    /* Detectar el cambio de select en el listado de productos */
    public function updatedInventoryId($value){
        $this->reset('inventory');
        if(!empty($value)){
            $this->inventory = Inventory::find($this->inventory_id);
        }
    }
}
