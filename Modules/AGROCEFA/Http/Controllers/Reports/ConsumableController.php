<?php

namespace Modules\AGROCEFA\Http\Controllers\Reports;

use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Activity;
use Modules\SICA\Entities\Inventory;
use Modules\SICA\Entities\Labor;
use Modules\AGROCEFA\Entities\Consumable;

class ConsumableController extends Controller
{
    public function index()
    {

        $selectedUnitId = Session::get('selectedUnitId');

        // Obtén todos los IDs de las labors relacionadas con actividades que cumplan con la condición
        $laborsIds = Activity::where('productive_unit_id', $selectedUnitId)
            ->with('labors')
            ->get()
            ->flatMap(function ($activity) {
                return $activity->labors->pluck('id');
            })
            ->toArray();
        if (empty($laborsIds)) {
            return redirect()->back()->with('error', 'No se encontraron actividades para la unidad seleccionada.');
        }

       // Obtén los consumables relacionados con esas labors
        $consumables = Consumable::whereIn('labor_id', $laborsIds)
        ->get();

        // Obtén la información del inventario de los consumables
        $inventoryIds = $consumables->pluck('inventory_id')->toArray();

        // Consulta los inventarios utilizando los IDs obtenidos anteriormente
        $inventories = Inventory::whereIn('id', $inventoryIds)->get();

        dd($inventories);

        return view('agrocefa::reports.consumption');
    }

}
