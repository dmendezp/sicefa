<?php

namespace Modules\HDC\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Activity;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\EnvironmentalAspectLabor;
use Modules\SICA\Entities\Labor;


class FormularioController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    /*  public function index()
    {
        return view('hdc::index');
    } */
    public function formulario()
    {
        $productive_unit = ProductiveUnit::orderBy('name', 'ASC')->get();
        return view('hdc::formulario', compact('productive_unit'));
    }

    public function getActivities()
    {
        $datap = json_decode(($_POST['data']));
        // Obtener las actividades relacionadas con la unidad productiva
        $activities = ProductiveUnit::findOrFail($datap->productive_unit_id)->activities;
        return view('hdc::activity', compact('activities'));
    }


    public function getAspects()
    {

        $data = json_decode($_POST['data']);
        $aspects = Activity::with('environmental_aspects.measurement_unit')->where('id', $data->activity_id)->get();
        $activity_id = $data->activity_id;
        return view('hdc::tablaaspectosambientales', compact('aspects', 'activity_id'));
    }

    public function guardarValores(Request $request)
    {
        // Valida los datos del formulario
        $request->validate([
            'aspecto.*.amount' => 'required|numeric',
            'activity_id' => 'required|exists:activities,id',
        ]);



        $labor = Labor::create([
            'activity_id' => $request->input('activity_id'),
            'planning_date' => now(),
            'execution_date' => now(),
            'description' => 'Descripción de la labor',
            'status' => 'Realizado',
            'observations' => 'Observaciones de la labor',
            'destination' => 'Formacion',
        ]);




        foreach ($request->input('aspecto') as $aspectoData) {

            EnvironmentalAspectLabor::create([
                'environmental_aspect_id' => $aspectoData['id'],
                'labor_id' => $labor->id,
                'amount' => $aspectoData['amount'],
                'price' => 0,
            ]);
        }

        // Redirige al usuario o proporciona una respuesta de éxito
        return redirect()->route('cefa.hdc.formulario')->with('success', 'Valores guardados correctamente');
    }

    public function table()
{
    $datos = EnvironmentalAspectLabor::with('environmental_aspect', 'labor')->get();
    $productive_units = ProductiveUnit::orderBy('name', 'ASC')->get();
    $activities = Activity::with('productive_unit')->get();

    $formattedData = [];

    foreach ($datos as $dato) {
        $unit = $dato->labor->activity->productive_unit;
        $activi = $dato->labor->activity;

        $formattedData[] = [
            'id' => $dato->id,
            'unit_name' => $unit->name,
            'activity_name' => $activi->name,
            'aspect_name' => $dato->environmental_aspect->name,
            'amount' => $dato->amount,
        ];
    }

    return view('hdc::resultform', compact('formattedData'));
}










    /**
     * Show the form for creating a new resource
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
