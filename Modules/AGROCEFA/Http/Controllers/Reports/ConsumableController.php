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
    public function index(Request $request)
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
        
        // Obtén los consumibles relacionados con esas labors
        $consumables = Consumable::whereIn('labor_id', $laborsIds)
            ->with('inventory.element','labor') // Carga la relación 'inventorie' y 'element' de manera eficiente
            ->get();

        
        // Crear un array asociativo para almacenar toda la información agrupada por labor
        $groupedData = [];
        $totalLaborSubtotal = 0;

        foreach ($consumables as $consumable) {
            $laborId = $consumable->labor->id;

            if (!isset($groupedData[$laborId])) {
                // Inicializa el array para esta labor si aún no existe
                $groupedData[$laborId] = [
                    'laborDescription' => $consumable->labor->description,
                    'laborDate' => $consumable->labor->execution_date,
                    'elements' => [],
                    'laborSubtotal' => 0, // Inicializa el subtotal de labor
                ];
            }

            $elementName = $consumable->inventory->element->name;
            $consumableAmount = $consumable->amount;
            $consumablePrice = $consumable->price;

            // Calcular el subtotal por elemento
            $elementSubtotal = $consumableAmount * $consumablePrice;

            // Agregar información al array asociativo
            $groupedData[$laborId]['elements'][] = [
                'elementName' => $elementName,
                'consumableAmount' => $consumableAmount,
                'consumablePrice' => $consumablePrice,
                'elementSubtotal' => $elementSubtotal, // Agregar el subtotal al elemento
            ];

            // Sumar el subtotal del elemento al subtotal de labor
            $groupedData[$laborId]['laborSubtotal'] += $elementSubtotal;
            $totalLaborSubtotal += $elementSubtotal; // Sumar al total de subtotales de labor
        }

        return view('agrocefa::reports.consumption', [
            'groupedData' => $groupedData,
            'totalLaborSubtotal' => $totalLaborSubtotal,
        ]);
    }
    

    public function filterByDate(Request $request)
    {
        $selectedUnitId = Session::get('selectedUnitId');

        // Obtén las fechas de inicio y fin desde la solicitud
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');

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

        $labors = Labor::whereBetween('execution_date', [$startDate, $endDate])->get()->pluck('id');

        // Obtén los consumibles relacionados con esas labors
        $consumables = Consumable::whereIn('labor_id', $labors)
            ->with('inventory.element','labor') // Carga la relación 'inventorie' y 'element' de manera eficiente
            ->get();

        
        // Crear un array asociativo para almacenar toda la información agrupada por labor
        $groupedData = [];
        $totalLaborSubtotal = 0;

        foreach ($consumables as $consumable) {
            $laborId = $consumable->labor->id;

            if (!isset($groupedData[$laborId])) {
                // Inicializa el array para esta labor si aún no existe
                $groupedData[$laborId] = [
                    'laborDescription' => $consumable->labor->description,
                    'laborDate' => $consumable->labor->execution_date,
                    'elements' => [],
                    'laborSubtotal' => 0, // Inicializa el subtotal de labor
                ];
            }

            $elementName = $consumable->inventory->element->name;
            $consumableAmount = $consumable->amount;
            $consumablePrice = $consumable->price;

            // Calcular el subtotal por elemento
            $elementSubtotal = $consumableAmount * $consumablePrice;

            // Agregar información al array asociativo
            $groupedData[$laborId]['elements'][] = [
                'elementName' => $elementName,
                'consumableAmount' => $consumableAmount,
                'consumablePrice' => $consumablePrice,
                'elementSubtotal' => $elementSubtotal, // Agregar el subtotal al elemento
            ];

            // Sumar el subtotal del elemento al subtotal de labor
            $groupedData[$laborId]['laborSubtotal'] += $elementSubtotal;
            $totalLaborSubtotal += $elementSubtotal; // Sumar al total de subtotales de labor
        }

        return view('agrocefa::reports.consumption', [
            'groupedData' => $groupedData,
            'totalLaborSubtotal' => $totalLaborSubtotal,
        ]);
    }


}
