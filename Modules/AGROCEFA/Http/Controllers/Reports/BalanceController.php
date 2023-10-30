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

        // Verifica si se ha seleccionado un cultivo
        if ($selectedCropId) {
            // Utiliza Eloquent para obtener las labores relacionadas con el cultivo seleccionado
            $filteredLabors = Labor::whereHas('crops', function ($query) use ($selectedCropId) {
                $query->where('crop_id', $selectedCropId);
            })->get();
        } else {
            // Si no se seleccionó un cultivo, puedes manejarlo según tus requisitos. Por ejemplo, mostrar todas las labores.
            $filteredLabors = Labor::all();
        }

        // Devuelve la vista con las labores filtradas
        return view('agrocefa::reports.resultsbalance', [
            'filteredLabors' => $filteredLabors,
        ]);
    }
}
