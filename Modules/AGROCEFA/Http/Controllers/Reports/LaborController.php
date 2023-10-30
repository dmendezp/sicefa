<?php

namespace Modules\AGROCEFA\Http\Controllers\Reports;

use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\EnvironmentProductiveUnit;
use Modules\AGROCEFA\Entities\CropEnvironment;
use Modules\SICA\Entities\Activity;
use Modules\SICA\Entities\Labor;
use Modules\SICA\Entities\Consumable;





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


    // Retorna la vista y pasa los arrays a la vista
    return view('agrocefa::reports.labor', [
        'lots' => $lots,
        'environmentIds' => $environmentIds,
        'environmentNames' => $environmentNames,
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


    return response()->json(['cropIds' => $cropIds , 'cropNames' => $cropNames]);
}



/* funcion para atraer las labores relacionadas dentro de las fechas selecionadas */
public function filterByFecha(Request $request)
{
    // Obtén las fechas de inicio y fin desde la solicitud
    $startDate = $request->input('startDate');
    $endDate = $request->input('endDate');

    // Obtén todas las labores que cumplen con la condición de fechas
    $labors = Labor::where('execution_date', '>=', $startDate)
        ->where('execution_date', '<=', $endDate)
        ->get();

    // Verifica si se encontraron labores que cumplan con los criterios de fecha
    if ($labors->isEmpty()) {
        return redirect()->back()->with('error', 'No se encontraron labores para las fechas seleccionadas.');
    }

    // Procesa los datos y crea las variables $groupedData y $totalLaborSubtotal
    $groupedData = []; // Puedes agregar aquí la lógica para procesar los datos y crear la estructura deseada
    $totalLaborSubtotal = 0; // Puedes calcular el subtotal total aquí

    // Una vez que hayas procesado los datos y tengas la información necesaria, puedes retornar la vista con los resultados.
    return view('agrocefa::reports.labor', [
        'groupedData' => $groupedData,
        'totalLaborSubtotal' => $totalLaborSubtotal,
    ]);
}


}
