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
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'activity_id' => 'required|array',
            'Environmental_Aspect' => 'required', // Validar que actividades sea un arreglo
            'checklist_data' => 'required', // Validar que checklist_data sea un arreglo
        ]);
    
        $activity_id = $request->input('activity_id');
        $ea = $request->input('Environmental_Aspect');
        $checklistData = $request->input('Environmental_Aspect');
        
    
        // Verificar si existe un registro de EnvironmentalAspect con el activity_id y Environmental_Aspect dados
        $aea = EnvironmentalAspect::where('activity_id', $activity_id)
            ->where('Environmental_Aspect', $ea)
            ->first();
    
        if (!$aea) {
            // Si el registro no existe, crear uno nuevo
            $aea = EnvironmentalAspect::create([
                'activity_id' => $activity_id,
                'Environmental_Aspect' => $ea,
            ]);
        }
    
        // Usar syncWithoutDetaching para asociar actividades con EnvironmentalAspect
        $aea->activities()->syncWithoutDetaching($activities);
    
        // Crear un nuevo registro de ChecklistResponse y asociarlo con EnvironmentalAspect
        $checklistResponse = new ChecklistResponse();
        $checklistResponse->fill($checklistData); // Asumiendo que los datos del formulario se almacenan en ChecklistResponse
        $checklistResponse->save();
    
        // Asociar el ChecklistResponse con EnvironmentalAspect usando syncWithoutDetaching
        $aea->checklistResponses()->syncWithoutDetaching([$checklistResponse->name]);
    
        // Redirigir de nuevo a la página del formulario después de guardar con un mensaje de éxito
        return redirect()->route('hdc.adminresources.index')->with('success', 'Asignación y formulario guardados con éxito');
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
