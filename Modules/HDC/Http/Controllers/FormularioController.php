<?php

namespace Modules\HDC\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
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
    public function formulario(){
        $productive_unit = ProductiveUnit::orderBy('name', 'ASC')->get();
        return view('hdc::formulario', compact('productive_unit'));

    }
    public function formulariolabor(){
        return view('hdc::formulariolabor');

    }

    public function getActivities(Request $request)
    {
    $unitId = $request->input('product_unit'); // Obtener el ID de la unidad productiva seleccionada

    // Obtener las actividades relacionadas con la unidad productiva
    $activities = ProductiveUnit::findOrFail($unitId)->activities;

    return response()->json(['activities' => $activities]);
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
