<?php

namespace Modules\HDC\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\SICA\Entities\ProductiveUnit;
use Modules\SICA\Entities\Activity;
use Modules\SICA\Entities\EnvironmentalAspect;

class AdminresourcesController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function adminresources() {
        $productive_unit = ProductiveUnit::get();
        $activities = Activity::get();
        $environmentalAspect = EnvironmentalAspect::get();
        return view('hdc::Adminresources', ['productive_unit' => $productive_unit, 'activities' => $activities, 'environmentalAspect' => $environmentalAspect]);
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
        // Guardar Administracion
        $rules = [
            'productive_unit_id' => 'required',
            'activity_id' => 'required',
            'environmental_aspect_id' => 'required',
        ];
        $aea = new environmental_aspect(); 
        $aea->productive_unit = $aea; // Nombre De La Unidad Productiva
        $aea->activity_id = $request->input('name'); // Nombre De La Actividad
        $aea->environmental_aspect_id = $request->input('name');
        $aea->save();
        return redirect()->route('hdc.adminresources')->with('success', 'Aspectos Asignados Exitosamente');
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
    public function destroy()
    {
       //
            
    }

}
