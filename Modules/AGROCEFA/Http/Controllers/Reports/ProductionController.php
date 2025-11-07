<?php

namespace Modules\AGROCEFA\Http\Controllers\Reports;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;
use Modules\SICA\Entities\Environment;
use Modules\SICA\Entities\EnvironmentProductiveUnit;
use Modules\AGROCEFA\Entities\CropEnvironment;
use Modules\SICA\Entities\Production;
use Modules\SICA\Entities\Labor;
use Barryvdh\DomPDF\Facade\Pdf;

class ProductionController extends Controller
{
    public function index()
    {
        $labor = Labor::all();
        $this->selectedUnitId = Session::get('selectedUnitId');
        $lotData = EnvironmentProductiveUnit::where('productive_unit_id', $this->selectedUnitId)
            ->with('environment')
            ->get();

        $environmentData = [];

        $filterproductions = Production::all();

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

        return view('agrocefa::reports.production', [
            'cropsByLot' => $filterproductions,  // Cambia el nombre de la variable aquí
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

        return response()->json(['cropIds' => $cropIds , 'cropNames' => $cropNames]);
    }

    public function filterproduction(Request $request)
    {
        // Obtén el ID del cultivo seleccionado desde la solicitud AJAX
        $selectedCropId = $request->input('crop');

        // Inicializa las variables para los resultados filtrados y los totales
        $filterproductions = null;
        $totalExpenses = 0;
        $totalProductions = 0;

        // Verifica si se ha seleccionado un cultivo
        if ($selectedCropId) {
            // Realiza una consulta para obtener todas las producciones relacionadas con el cultivo seleccionado
            $allProductions = Production::whereHas('labor.crops', function ($query) use ($selectedCropId) {
                $query->where('crop_id', $selectedCropId);
            })->with('element')->get(); // Asegúrate de cargar la relación 'element'

            // Filtra las prodcciones según tus criterios
            $filterproductions = $allProductions->filter(function ($production) {
                return true;
            });
            
            // Calcula los totales de gastos y producciones
            if (!empty($filterproductions) && count($filterproductions) > 0) {
                foreach ($filterproductions as $production) {
                    // Asegúrate de que la relación 'element' esté cargada
                    if (!is_null($production->element)) {
                        $totalExpenses += $production->amount * $production->element->price;
                    }
                }
            }
        }

        // Almacena los totales en variables de sesión (o como desees manejarlos)
        session(['totalProductions' => $totalExpenses]);
        session(['filterproductions' => $filterproductions]);
        // Devuelve la vista con las producciones filtradas y los totales
        return view('agrocefa::reports.resultproduction', [
            'filterproductions' => $filterproductions,
            'totalExpenses' => $totalExpenses,
            'totalProductions' => $totalProductions,
            'selectedCropId' => $selectedCropId,
            'no_found' => trans('agrocefa::balance.No_work_found_production')
        ]);
    }

    public function productionpdf(Request $request)
    {
        $id = $request->input('id');
        // Verifica si existen datos filtrados en la variable de sesión
        if (session()->has('filterproductions')) {
            $filterproductions = session('filterproductions');
            $totalExpenses = session('totalExpenses');

            // Inicializa el objeto PDF
            $pdf = PDF::loadView('agrocefa::reports.productionpdf', [
                'filterproductions' => $filterproductions,
                'totalExpenses' => $totalExpenses,
            ]);
            // Personaliza opciones del PDF si es necesario
            $pdf->setOptions(['isHtml5ParserEnabled' => true, 'isPhpEnabled' => true]);

            // Devuelve el PDF para verlo o descargar
            return $pdf->stream('production.PDF');
        } else {
            // Maneja la situación en la que no se encontraron datos filtrados
            return redirect()
                ->back()
                ->with('error', 'No se encontraron datos filtrados para generar el PDF.');
        }
    }
}
