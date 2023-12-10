<?php

namespace Modules\HDC\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\ProductiveUnit;
use Illuminate\Support\Facades\DB;

class GraphicsController extends Controller
{
    public function Graficas()
    {
        $aspectosAmbientales = ProductiveUnit::leftJoin('sectors', 'productive_units.sector_id', '=', 'sectors.id')
            ->leftJoin('activities', 'productive_units.id', '=', 'activities.productive_unit_id')
            ->leftJoin('labors', 'activities.id', '=', 'labors.activity_id')
            ->leftJoin('environmental_aspect_labors', function ($join) {
                $join->on('labors.id', '=', 'environmental_aspect_labors.labor_id')
                    ->whereYear('labors.execution_date', '=', DB::raw(date('Y')));
            })
            ->leftJoin('environmental_aspects', 'environmental_aspect_labors.environmental_aspect_id', '=', 'environmental_aspects.id')
            ->select(
                'sectors.name as sector_name',
                'productive_units.name as productive_unit_name',
                DB::raw('SUM(environmental_aspect_labors.amount * environmental_aspects.conversion_factor) as carbon_footprint')
            )
            ->groupBy('sectors.id', 'productive_units.id', 'sectors.name', 'productive_units.name') // Asegúrate de agrupar por sector y unidad productiva
            ->get();

        $carbonFootprints = ProductiveUnit::leftJoin('sectors', 'productive_units.sector_id', '=', 'sectors.id')
            ->leftJoin('activities', 'productive_units.id', '=', 'activities.productive_unit_id')
            ->leftJoin('labors', 'activities.id', '=', 'labors.activity_id')
            ->leftJoin('environmental_aspect_labors', function ($join) {
                $join->on('labors.id', '=', 'environmental_aspect_labors.labor_id')
                    ->whereYear('labors.execution_date', '=', DB::raw(date('Y')));
            })
            ->leftJoin('environmental_aspects', 'environmental_aspect_labors.environmental_aspect_id', '=', 'environmental_aspects.id')
            ->select(
                'productive_units.name as productive_unit_name',
                DB::raw('MONTH(labors.execution_date) as month'),
                DB::raw('SUM(environmental_aspect_labors.amount * environmental_aspects.conversion_factor) as carbon_footprint')
            )
            ->groupBy('productive_units.id', 'productive_units.name', DB::raw('MONTH(labors.execution_date)'))
            ->get();
            $chartData = [];

            foreach ($carbonFootprints as $footprint) {
                $productiveUnitName = $footprint->productive_unit_name;
                $month = $footprint->month;

                // Estructura de datos para Highcharts
                $chartData[$productiveUnitName]['name'] = $productiveUnitName;
                $chartData[$productiveUnitName]['data'][$month - 1] = $footprint->carbon_footprint;
            }

            // Llena los meses faltantes con valores nulos
            foreach ($chartData as &$data) {
                $data['data'] = array_replace(array_fill(0, 12, null), $data['data']);
            }

            // Convierte el array asociativo a un array simple
            $chartData = array_values($chartData);




        return view('hdc::Graphics', compact('aspectosAmbientales', 'chartData'));
    }
}
