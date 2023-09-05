<?php

namespace Modules\BIENESTAR\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\BIENESTAR\Entities\Convocations;


class ConvocationsController extends Controller
{
    public function convocatoria()
    {
        // Mostrar el formulario para crear una nueva convocatoria
        return view('bienestar::convocatoria');
    }
    
    
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        // Obtenemos Listado Convocatoria
       $convocations=Convocations::all();
       return view('bienestar::Convocations',['Convocations'=>$convocations]);   
    }

    

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
           // Define las reglas de validación
    $rules = [
        'title' => 'required', // Asegura que el campo 'title' esté presente y no sea nulo.
        'description' => 'required',
        'start_date' => 'required',
        'end_date' => 'required',
        'transport_quotas' => 'required',
        'food_quotas' => 'required',
    ];
         // Define los mensajes de error personalizados (opcional)
    $messages = [
        'title.required' => 'El campo Título es obligatorio.',
        'description.required' => 'El campo Descripción es obligatorio.',
        'start_date.required' => 'El campo Fecha de Inicio es obligatorio.',
        'end_date.required' => 'El campo Fecha de Finalización es obligatorio.',
        'transport_quotas.required' => 'El campo Cupos de Transporte es obligatorio.',
        'food_quotas.required' => 'El campo Cupos de Alimentación es obligatorio.',
    ];

    // Realiza la validación
    $validatedData = $request->validate($rules, $messages);

        $convocations = new Convocations;
        $convocations->title = $request->input('title');
        $convocations->description=  $request->input('description');
        $convocations->start_date= $request->input('start_date');
        $convocations->end_date= $request->input('end_date');
        $convocations->transport_quotas= $request->input('transport_quotas');
        $convocations->food_quotas= $request->input('food_quotas');
        
        if($convocations->save()){
            return redirect()->route('bienestar.Convocations')->with('message', 'Convocatoria registrada Correctamente')->with('typealert', 'success');
        }
        return redirect()->route('bienestar.Convocations')->with('message', 'Se Ha Producido Un Error')->with('typealert', 'danger');
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('bienestar::show');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        $convocations = Convocations::findOrFail($id);
        $convocations->title = $request->input('title');
        $convocations->description = $request->input('description');
        $convocations->start_date = $request->input('start_date');
        $convocations->end_date = $request->input('end_date');
        $convocations->transport_quotas = $request->input('transport_quotas');
        $convocations->food_quotas = $request->input('food_quotas');
        if($convocations->save()){
            return redirect()->route('bienestar.Convocations')->with('message', 'Registro Actualizado Correctamente')->with('typealert', 'success');
        }
        return redirect()->route('bienestar.Convocations')->with('message', 'Se Ha Producido Un Error')->with('typealert', 'danger');
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
