<?php

namespace Modules\HDC\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
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
        $productive_unit = ProductiveUnit::all();
        $activities = Activity::all();
        $environmentalAspect = EnvironmentalAspect::get();
        return view('hdc::Adminresources', compact('productive_unit' , 'activities', 'environmentalAspect'));
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
        return($request);
        $rules = [
            'productive_unit_id' => 'required|array',
            'activity_id' => 'required|array',
            'Environmental_Aspect' => 'required|array|min:1',
        ];
        $validator = Validator::make($request->all(), $rules, [
            'Environmental_Aspect.required' => 'Selecciona al menos un aspecto ambiental.',
        ]);

        if($validator->fails()){
            return back()->withErrors($validator)->withInput('message','Ocurrio Un Error Con El Formulario')->with('typealert','danger');
        }else {
            $activity = new Activity;
            $activity->name = e($request->select('productive_unit_id'));
            $activity->name = e($request->select('activity_id'));
            $activity->name = e($request->checkbox('Environmental_Aspect'));
            $activity->save(); // Registrar Administracion del recurso
            dd("Registro Exitoso");
            // $activity->Activity()->syncWithoutDetaching($activity);
            // $message = ['message'=>'Se Registro Exitosamente La Asignacion del recurso', 'typealert'=>'success'];
        }
        return redirect(route('hdc.adminresources'))->with($message);
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
