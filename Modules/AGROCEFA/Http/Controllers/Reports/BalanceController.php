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

    public function filterBalance(Request $request)
    {
        $labor = Labor::all();
        $this->selectedUnitId = Session::get('selectedUnitId');
        $lotData = EnvironmentProductiveUnit::where('productive_unit_id', $this->selectedUnitId)
            ->with('environment')
            ->get();

        $startDate = Carbon::parse($request->input('start_date'));
        $endDate = Carbon::parse($request->input('end_date'));

        $filteredLabors = Labor::whereBetween('execution_date', [$startDate, $endDate])->get();

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
            'labor' => $labor,
            'environmentData' => $environmentData,
            'filteredLabors' => $filteredLabors,
        ]);
    }
}
