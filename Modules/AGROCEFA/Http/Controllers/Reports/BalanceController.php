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

public function index(Request $request)
{
    $labor = Labor::all();

    // Obtén el ID de la unidad productiva seleccionada de la sesión
    $this->selectedUnitId = Session::get('selectedUnitId');

    // ---------------- Filtro para los Lotes de esa Unidad -----------------------

    $lotData = EnvironmentProductiveUnit::where('productive_unit_id', $this->selectedUnitId)
        ->with('environment')
        ->get();

    // Inicializa un array para almacenar los nombres y IDs de los ambientes
    $environmentData = [];

    // Recorre la colección y obtén los nombres y IDs de los ambientes
    foreach ($lotData as $item) {
        $environmentId = $item->environment->id;
        $environmentName = $item->environment->name;

        // Agrega un array asociativo con el ID y el nombre del ambiente al array de datos
        $environmentData[] = [
            'id' => $environmentId,
            'name' => $environmentName,
        ];
    }

    // Obtén las fechas de inicio y fin del formulario
    $startDate = Carbon::parse($request->input('start_date'));
    $endDate = Carbon::parse($request->input('end_date'));

    // Realiza la consulta para obtener registros dentro del rango de fechas
    $filteredLabors = Labor::whereBetween('execution_date', [$startDate, $endDate])->get();

    return view('agrocefa::reports.balance', [
        'environmentData' => $environmentData,
        'labor' => $labor,
        'filteredLabors' => $filteredLabors, // Agrega los registros filtrados
    ]);
}

}
