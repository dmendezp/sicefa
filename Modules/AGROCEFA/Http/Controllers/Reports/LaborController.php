<?php

namespace Modules\AGROCEFA\Http\Controllers\Reports;

use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\EnvironmentProductiveUnit;
use Modules\AGROCEFA\Entities\CropEnvironment;
use Modules\SICA\Entities\Labor;


class LaborController extends Controller
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

        // Obtén las labores que deseas mostrar (puedes adaptar esta parte según tus necesidades)
        $labors = Labor::orderBy('execution_date', 'desc')->limit(10)->get();

        // Retorna la vista y pasa los arrays a la vista
        return view('agrocefa::reports.labor', [
            'lots' => $lots,
            'environmentIds' => $environmentIds,
            'environmentNames' => $environmentNames,
            'labors' => $labors,
        ]);
    }

    public function getCropsByUnit(Request $request)
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
        return response()->json(['cropIds' => $cropIds, 'cropNames' => $cropNames]);
    }



    public function filterlabor(Request $request)
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
        return view('agrocefa::Reports.resultlabor', [
            'filteredLabors' => $filteredLabors,
        ]);
    }
}
