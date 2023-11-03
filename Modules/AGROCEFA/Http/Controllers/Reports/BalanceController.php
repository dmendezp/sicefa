<?php

namespace Modules\AGROCEFA\Http\Controllers\Reports;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\SICA\Entities\EnvironmentProductiveUnit;
use Modules\SICA\Entities\Labor;
use Carbon\Carbon; // Asegúrate de importar la clase Carbon

class BalanceController extends Controller
{
    public function index()
    {
        $labor = Labor::all();
        $this->selectedUnitId = Session::get('selectedUnitId');
        $lotData = EnvironmentProductiveUnit::where('productive_unit_id', $this->selectedUnitId)
            ->with('environment')
            ->get();

        $environmentData = [];

        foreach ($lotData as $item) {
            $environmentId = $item->environment->id;
            $environmentName = $item->environment->name;

            $environmentData[] = [
                'id' => $environmentId,
                'name' => $environmentName,
            ];
        }

        return view('agrocefa::reports.balance', [
            'environmentData' => $environmentData,
            'labor' => $labor,
        ]);
    }

    public function filterbalance(Request $request)
    {
        // Obtén el ID del cultivo seleccionado desde la solicitud AJAX
        $selectedCropId = $request->input('crop');

        // Inicializa la variable para los resultados filtrados
        $filteredLabors = null;

        // Verifica si se ha seleccionado un cultivo
        if ($selectedCropId) {
            // Realiza una consulta para obtener todas las labores relacionadas con el cultivo seleccionado
            $allLabors = Labor::whereHas('crops', function ($query) use ($selectedCropId) {
                $query->where('crop_id', $selectedCropId);
            })->get();

            // Filtra las labores por fechas
            $filteredLabors = $allLabors->filter(function ($labor) {
                $executionDate = $labor->execution_date;
                $seedTime = $labor->crops->first()->seed_time;
                $finishDate = $labor->crops->first()->finish_date;

                // Verifica si es una labor de producción
                if ($labor->activity->activity_type->name === 'Producción') {
                    $totalProductionPrice = 0;

                    // Recorre las producciones de esta labor
                    foreach ($labor->productions as $production) {
                        // Asegúrate de que la relación 'element' esté cargada
                        if (!is_null($production->element)) {
                            $totalProductionPrice += $production->amount * $production->element->price;
                        }
                    }

                    $labor->totalProductionPrice = $totalProductionPrice;
                }

                return $executionDate >= $seedTime && $executionDate <= $finishDate;
            });
        }

        // Devuelve la vista con las labores filtradas
        return view('agrocefa::reports.resultsbalance', [
            'filteredLabors' => $filteredLabors,
        ]);
    }
}
