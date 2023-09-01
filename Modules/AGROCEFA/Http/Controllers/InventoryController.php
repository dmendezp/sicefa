<?php

namespace Modules\AGROCEFA\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Inventory;
use Modules\SICA\Entities\ProductiveUnitWarehouse;
use Modules\SICA\Entities\Element;


class InventoryController extends Controller


{

    public function showInventoryByCategory($category_id)
    {
        // Realiza tu consulta para obtener el inventario filtrado por categoría
        $inventory = Inventory::where('category_id', $category_id)->get();

        // Pasa la variable $inventory a la vista
        return view('inventory', ['inventory' => $inventory]);
    }


    public function inventory() 
    {
        // Obtén el inventario con ID 1
        $inventory = Inventory::find(1);

        if ($inventory) {
            // Se encontró el inventario con ID 1, puedes pasar los resultados a la vista
            return view('agrocefa::inventory', ['inventory' => $inventory]);
        } else {
            // No se encontró el inventario con ID 1
            return view('agrocefa::inventory', ['inventory' => null]);
        }
    }

}
