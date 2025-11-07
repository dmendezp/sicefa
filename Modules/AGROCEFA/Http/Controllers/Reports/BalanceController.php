<?php

namespace Modules\AGROCEFA\Http\Controllers\Reports;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Modules\SICA\Entities\EnvironmentProductiveUnit;
use Modules\SICA\Entities\Labor;
use Carbon\Carbon; // Asegúrate de importar la clase Carbon
use Barryvdh\DomPDF\Facade\Pdf;
use Modules\AGROCEFA\Entities\CropEnvironment;


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

        // Inicializa las variables para los totales de gastos y producciones
        $totalExpenses = 0;
        $totalProductions = 0;

        return view('agrocefa::reports.Balance.balance', [
            'environmentData' => $environmentData,
            'labor' => $labor,
            'totalExpenses' => $totalExpenses,
            'totalProductions' => $totalProductions,
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


        return response()->json(['cropIds' => $cropIds, 'cropNames' => $cropNames]);
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
               

                // Verifica si hay fecha final, si no, usa la fecha actual
                $finishDate = $finishDate ?? now(); // now() obtiene la fecha y hora actual

                return $executionDate >= $seedTime && $executionDate <= $finishDate;
            });
        }

        // Inicializa las variables para los totales de gastos y producciones
        $totalExpenses = 0;
        $totalProductions = 0;

        if (!empty($filteredLabors) && count($filteredLabors) > 0) {
            foreach ($filteredLabors as $labor) {
                // Calcula los totales de gastos y producciones
                $totalExpenses += $labor->price;
                if ($labor->activity->activity_type->name === 'Producción') {
                    $totalProductions += $labor->totalProductionPrice;
                }
            }
        }

        // Almacena los datos filtrados y los totales en variables de sesión
        session(['filteredLabors' => $filteredLabors]);
        session(['totalExpenses' => $totalExpenses]);
        session(['totalProductions' => $totalProductions]);

        // Devuelve la vista con las labores filtradas y los totales
        return view('agrocefa::reports.Balance.resultsbalance', [
            'filteredLabors' => $filteredLabors,
            'totalExpenses' => $totalExpenses,
            'totalProductions' => $totalProductions,
            'no_found' => trans('agrocefa::balance.No_work_found_balance')
        ]);
    }

    public function balancepdf(Request $request)
    {
        // Verifica si existen datos filtrados en la variable de sesión
        if (session()->has('filteredLabors')) {
            $filteredLabors = session('filteredLabors');
            $totalExpenses = session('totalExpenses');
            $totalProductions = session('totalProductions');

            // Inicializa el objeto PDF
            $pdf = PDF::loadView('agrocefa::reports.Balance.balancepdf', [
                'filteredLabors' => $filteredLabors,
                'totalExpenses' => $totalExpenses,
                'totalProductions' => $totalProductions,
            ]);

            // Personaliza opciones del PDF si es necesario
            $pdf->setOptions(['isHtml5ParserEnabled' => true, 'isPhpEnabled' => true]);


            // Devuelve el PDF para verlo o descargar
            return $pdf->stream('Balance.PDF');
        } else {
            // Maneja la situación en la que no se encontraron datos filtrados
            return redirect()
                ->back()
                ->with('error', 'No se encontraron datos filtrados para generar el PDF.');
        }
    }
}
