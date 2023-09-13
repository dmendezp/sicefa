<?php

namespace Modules\HDC\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Activity;
use Modules\SICA\Entities\ProductiveUnit;


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
    public function formulariolabor()
    {
        return view('hdc::formulariolabor');
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

        $aspects = Activity::with('environmental_aspects')->where('id', $data->activity_id)->get();
        
        $as = $aspects->flatMap(function ($aspect){
            return $aspect->environmental_aspects->map(function ($relation){
                return [
                    'name' => $relation->name
                ];
            });
        });

        return view('hdc::tablaaspectosambientales', compact('as'));
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
