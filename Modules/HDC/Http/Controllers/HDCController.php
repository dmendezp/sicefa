<?php

namespace Modules\HDC\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Activity;
use Modules\SICA\Entities\EnvironmentalAspectLabor;
use Modules\SICA\Entities\Labor;
use Modules\SICA\Entities\ProductiveUnit;


class HDCController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $productiveUnits = ProductiveUnit::all();

        // Obtener todas las actividades
        $activities = Activity::all();

        // Inicializar un arreglo para almacenar los totales por unidad productiva
        $totalAmountByProductiveUnit = [];

        // Iterar sobre cada unidad productiva
        foreach ($productiveUnits as $productiveUnit) {
            // Obtener datos ambientales para la unidad productiva actual
            $aspectosAmbientalesPorActividad = [];

            // Iterar sobre cada actividad
            foreach ($activities as $activity) {
                // Obtener datos ambientales para la unidad productiva y actividad actuales
                $aspectosAmbientales = EnvironmentalAspectLabor::with(['environmental_aspect', 'labor.activity'])
                    ->whereHas('labor', function ($query) use ($activity, $productiveUnit) {
                        $query->where('activity_id', $activity->id)
                            ->whereHas('activity', function ($query) use ($productiveUnit) {
                                $query->where('productive_unit_id', $productiveUnit->id);
                            });
                    })
                    ->get();

                $aspectosAmbientalesPorActividad[$activity->id] = $aspectosAmbientales;
            }

            // Calcular el total para la unidad productiva actual
            $totalAmount = collect($aspectosAmbientalesPorActividad)
                ->flatten()
                ->sum(function ($environmentalAspectLabor) {
                    $amount = $environmentalAspectLabor->amount;
                    $conversionFactor = $environmentalAspectLabor->environmental_aspect->conversion_factor;
                    return $amount * $conversionFactor;
                });

            // Almacenar el total en el arreglo
            $totalAmountByProductiveUnit[$productiveUnit->id] = $totalAmount;
        }
        // Agrupar los totales por sector con nombres
        $totalAmountBySector = $productiveUnits
            ->groupBy('sector.name') // Cambiado a 'name' para agrupar por el nombre del sector
            ->map(function ($productiveUnits) use ($totalAmountByProductiveUnit) {
                return $productiveUnits->sum(function ($productiveUnit) use ($totalAmountByProductiveUnit) {
                    return $totalAmountByProductiveUnit[$productiveUnit->id] ?? 0;
                });
            });

        // Convierte los datos al formato necesario para el gráfico
        $labels = $totalAmountBySector->keys()->toArray();
        $data = $totalAmountBySector->values()->toArray();

        return view('hdc::index', compact('labels', 'data'));
    }





    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('hdc::create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('hdc::show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('hdc::edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
