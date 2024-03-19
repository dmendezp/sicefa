<?php

namespace Modules\AGROCEFA\Http\Controllers\Reports;

use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Activity;
use Modules\SICA\Entities\Inventory;
use Modules\SICA\Entities\Labor;
use Modules\SICA\Entities\Consumable;
use Modules\SICA\Entities\EnvironmentProductiveUnit;
use Modules\AGROCEFA\Entities\CropEnvironment;
use Modules\AGROCEFA\Entities\Crop;

class ConsumableController extends Controller
{
        public function index()
    {
        $selectedUnitId = Session::get('selectedUnitId');
        
        // Obtén los EnvironmentProductiveUnit relacionados con la unidad productiva seleccionada
        $lots = EnvironmentProductiveUnit::where('productive_unit_id', $selectedUnitId)->with('environment')->get();

        // Inicializa arrays para almacenar los IDs y nombres de environment
        $environmentIds = [];
        $environmentNames = [];

        // Itera a través de los elementos de la colección
        foreach ($lots as $lot) {
            // Accede a los atributos de la relación 'environment'
            $environmentId = $lot->environment->id;
            $environmentName = $lot->environment->name;

            // Agrega los valores a los arrays
            $environmentIds[] = $environmentId;
            $environmentNames[] = $environmentName;
        }


        // Retorna la vista y pasa los arrays a la vista
        return view('agrocefa::reports.consumption', [
            'lots' => $lots,
            'environmentIds' => $environmentIds,
            'environmentNames' => $environmentNames,
        ]);
    }

    public function getCropsBylot(Request $request)
    {
        $unitId = $request->input('unit');

        // Obtén los EnvironmentProductiveUnit relacionados con la unidad productiva seleccionada
        $crops = CropEnvironment::where('environment_id', $unitId)->with('crop')->get();

        // Inicializa arrays para almacenar los IDs y nombres de environment
        $environmentIds = [];
        $environmentNames = [];

        // Itera a través de los elementos de la colección
        foreach ($crops as $lot) {
            // Accede a los atributos de la relación 'environment'
            $environmentId = $lot->crop->id;
            $environmentName = $lot->crop->name;

            // Agrega los valores a los arrays
            $cropIds[] = $environmentId;
            $cropNames[] = $environmentName;
        }


        return response()->json(['cropIds' => $cropIds , 'cropNames' => $cropNames]);
    }

    public function filterByDate(Request $request)
    {
        $selectedUnitId = Session::get('selectedUnitId');

    
        $selectedCropId = $request->input('crop');
    
        if (empty($selectedCropId)) {
            return response()->json(['error' => 'Invalid crop selection']);
        }
        
        $selectedCrop = Crop::with('labors') // Cargar las labors relacionadas
            ->findOrFail($selectedCropId);

        // Fecha de siembra y finalización del cultivo
        $startDate = $selectedCrop->seed_time;
        $endDate = $selectedCrop->finish_date ?: now(); // Si finish_date es NULL, toma la fecha actual

        // Obtener las labores relacionadas con el cultivo y dentro del rango de fechas
        $labors = $selectedCrop->labors()
            ->whereBetween('execution_date', [$startDate, $endDate])
            ->get()->pluck('id');

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

        return view('agrocefa::reports.consumption_table', [
            'groupedData' => $groupedData,
            'totalLaborSubtotal' => $totalLaborSubtotal,
            'no_found' => trans('agrocefa::balance.No_work_found_consumption')
        ]);
    }


}
