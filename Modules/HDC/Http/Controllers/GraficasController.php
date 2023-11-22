<?php

namespace Modules\HDC\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Activity;
use Modules\SICA\Entities\Labor;
use Modules\SICA\Entities\ProductiveUnit;
use Illuminate\Support\Facades\DB;

class GraficasController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
   /*  public function index()
    {
        return view('hdc::index');
    } */
    public function Graficas(){
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

    return view('hdc::Graficas', compact('aspectosAmbientales'));

    }

    }
