<?php

namespace Modules\AGROCEFA\Http\Controllers\Reports;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Carbon;
use Modules\SICA\Entities\Environment;
use Modules\SICA\Entities\EnvironmentProductiveUnit;
use Modules\SICA\Entities\Production;
use Modules\SICA\Entities\Labor;    
use Modules\AGROCEFA\Entities\Crop;
use PDF;

class ProductionController extends Controller
{
    public function index(Request $request)
    {
        $environmentData = Environment::all();
        $current_time = Carbon::now();

        // Obtén los datos de labor que necesitas
        $labor = Labor::all(); // Puedes ajustar esto según tus necesidades

        $lotId = $request->input('lot', '');
        $cropId = $request->input('crop', '');
        $startDate = $request->input('start_date', '');
        $endDate = $request->input('end_date', '');
        $cropLabor = $request->input('crop_Labor', '');

        // Obtén los datos de los cultivos basados en el lote seleccionado
        $cropsByLot = [];
        if ($lotId) {
            $cropsByLot = Crop::where('lot_id', $lotId)->get();
        }

        // Inicializa las variables para los totales de gastos y producciones
        $totalExpenses = 0;
        $totalProductions = 0;

        return view('agrocefa::reports.production', [
            'environmentData' => $environmentData,
            'labor' => $labor,
            'totalExpenses' => $totalExpenses,
            'current_time' => $current_time,
            'cropsByLot' => $cropsByLot, // Pasa los cultivos disponibles en el lote a la vista
            'selectedLotId' => $lotId, // Pasa el ID del lote seleccionado a la vista
            'selectedCropId' => $cropId, // Pasa el ID del cultivo seleccionado a la vista
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);
    }
}
