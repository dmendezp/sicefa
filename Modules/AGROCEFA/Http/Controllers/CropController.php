<?php

namespace Modules\AGROCEFA\Http\Controllers;


use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AGROCEFA\Entities\Crop; // Asegúrate de importar el modelo Crop y otros namespaces necesarios


class CropController extends Controller
{
    public function index()
    {
        $crop= Crop::all();
        return view('agrocefa::crop.index', compact('crop'));
    }
    
    /* public function create()
    {
        return view('agrocefa::crop.create');
    } */
    public function createCrop(Request $request)
    {
    // Obtén el ID de la unidad productiva seleccionada de la sesión
    $selectedEnvironmentId = Session::get('selectedEnvironmentId');
    $selectedVarietyId = Session::get('selectedVarietyId');

    // Validar los datos del formulario aquí si es necesario
    $crop = new Crop();
    $crop->environment_id = $selectedEnvironmentId; // Usar el ID de la unidad de la sesión
    $crop->variety_id =  $selectedVarietyId;
    $crop->name = $request->input('name'); // Nombre del cultivo
    $crop->sown_area = $request->input('sown_area');
    $crop->seed_time = $request->input('seed_time');
    $crop->density = $request->input('density');
    $crop->finish_date = $request->input('finish_date');
    

    $crop->save();

    return redirect()->route('agrocefa.parameters')->with('success', 'Cultivo registrado exitosamente.');
    }


    
    public function delete($id)
    {
        $crop = Crop::findOrFail($id);
        return view('crop.delete', compact('crop'));
    }

    public function edit($id)
    {
        $crop = Crop::findOrFail($id);
        return view('crop.edit', compact('crop'));
    }

}
