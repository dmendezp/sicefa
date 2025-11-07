<?php

namespace Modules\AGROCEFA\Http\Controllers\Reports;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\EnvironmentProductiveUnit;
use Modules\AGROCEFA\Entities\CropEnvironment;
use Modules\SICA\Entities\Labor;
use Modules\SICA\Entities\Equipment;
use Modules\SICA\Entities\Consumable;
use Modules\SICA\Entities\Executor;
use Modules\SICA\Entities\Tool;
use Modules\SICA\Entities\Production;
use Carbon\Carbon; // Asegúrate de importar la clase Carbon
use Barryvdh\DomPDF\Facade\Pdf;


class LaborController extends Controller
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

        return view('agrocefa::reports.labor', [
            'environmentData' => $environmentData,
            'labor' => $labor,
            'totalExpenses' => $totalExpenses,
            'totalProductions' => $totalProductions,
        ]);
    }

    public function filterlabor(Request $request)
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

                // Asegúrate de que la relación 'crops' esté cargada y tenga al menos un elemento
                if ($labor->crops->isNotEmpty()) {
                    $seedTime = $labor->crops->first()->seed_time;
                    $finishDate = $labor->crops->first()->finish_date ?? now();

                    // Verifica si es una labor de producción
                    if ($labor->activity && $labor->activity->activity_type) {
                        if ($labor->activity->activity_type->name === 'Producción') {
                            $totalProductionPrice = 0;

                            // Recorre las producciones de esta labor
                            foreach ($labor->productions as $production) {
                                // Asegúrate de que la relación 'element' esté cargada
                                if ($production->element) {
                                    $totalProductionPrice += $production->amount * $production->element->price;
                                }
                            }

                            $labor->totalProductionPrice = $totalProductionPrice;

                            // Agrupa los componentes por labor id
                            $componentsByLaborId = $labor->equipments
                                ->concat($labor->consumables)
                                ->concat($labor->executors)
                                ->concat($labor->tools)
                                ->groupBy('labor_id');

                            // Calcula el costo total de cada componente por labor
                            $componentTotalCosts = [];
                            foreach ($componentsByLaborId as $laborId => $components) {
                                $totalCost = $components->sum(function ($component) {
                                    return $component->amount * $component->price;
                                });

                                $componentTotalCosts[$laborId] = $totalCost;
                            }

                            $labor->componentTotalCosts = $componentTotalCosts;
                        }
                    }

                    return $executionDate >= $seedTime && $executionDate <= $finishDate;
                }

                return false; // Devuelve false si 'crops' no está cargado o está vacío
            });
        }

        // Inicializa las variables para los totales de gastos y producciones
        $totalExpenses = 0;
        $totalProductions = 0;

        if (!empty($filteredLabors) && count($filteredLabors) > 0) {
            foreach ($filteredLabors as $labor) {
                // Calcula los totales de gastos y producciones
                $totalExpenses += $labor->price;
                if ($labor->activity && $labor->activity->activity_type && $labor->activity->activity_type->name === 'Producción') {
                    $totalProductions += $labor->totalProductionPrice;
                }
            }
        }

        // Almacena los datos filtrados y los totales en variables de sesión
        session(['filteredLabors' => $filteredLabors]);
        session(['totalExpenses' => $totalExpenses]);
        session(['totalProductions' => $totalProductions]);

        // Devuelve la vista con las labores filtradas y los totales
        return view('agrocefa::reports.resultlabor', [
            'filteredLabors' => $filteredLabors,
            'totalExpenses' => $totalExpenses,
            'totalProductions' => $totalProductions,
            'no_found' => trans('agrocefa::balance.No_work_found_labor')
        ]);
    }

    public function getLaborDetails(Request $request)
    {
        $laborId = $request->input('laborId');
        $labor = Labor::with('activity', 'equipments', 'consumables', 'executors', 'tools')->find($laborId);

        return view('agrocefa::reports.laborDetails', ['labor' => $labor,'no_found' => trans('agrocefa::balance.No_work_found_labor')]);
    }

    public function laborpdf(Request $request)
{
    // Verifica si existen datos filtrados en la variable de sesión
    if (session()->has('filteredLabors')) {
        $filteredLabors = session('filteredLabors');
        $totalExpenses = session('totalExpenses');
        $totalProductions = session('totalProductions');

        // Obtén los detalles de la labor directamente en esta función
        $laborId = $request->input('laborId');
        $labor = Labor::with('activity', 'equipments', 'consumables', 'executors', 'tools')->find($laborId);

        // Si hay detalles de la labor, almacénalos en una variable
        if ($labor) {
            // Obtén detalles adicionales de la labor utilizando getLaborDetails
            $additionalDetails = $this->getLaborDetails($request);

            // Almacena los datos adicionales en la variable $laborDetails
            $laborDetails = $additionalDetails->getData()['labor'];

            
            // Inicializa el objeto PDF
            $pdf = PDF::loadView('agrocefa::reports.laborpdf', [
                'filteredLabors' => $filteredLabors,
                'totalExpenses' => $totalExpenses,
                'totalProductions' => $totalProductions,
                'labor' => $labor,
                'laborDetails' => $laborDetails, // Pasa los detalles de la labor a la vista del PDF
            ]);

            // Personaliza opciones del PDF si es necesario
            $pdf->setOptions(['isHtml5ParserEnabled' => true, 'isPhpEnabled' => true]);

            // Devuelve el PDF para verlo o descargar
            return $pdf->stream('labor.pdf');
        } else {
            // Maneja la situación en la que no se encontraron detalles de la labor
            return redirect()
                ->back()
                ->with('error', 'No se encontraron detalles de la labor para generar el PDF.');
        }
    } else {
        // Maneja la situación en la que no se encontraron datos filtrados
        return redirect()
            ->back()
            ->with('error', 'No se encontraron datos filtrados para generar el PDF.');
    }
}
}
