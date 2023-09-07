<?php

namespace Modules\AGROCEFA\Http\Controllers;


use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AGROCEFA\Entities\Crop; 


class CropController extends Controller
{

    public function index()
    {
        $crop= Crop::all();
        return view('agrocefa::crop.index', compact('crop'));
    }
    


    public function createCrop(Request $request)
    {
    // Obtén el ID de la unidad productiva seleccionada de la sesión
    $selectedEnvironmentId = Session::get('selectedEnvironmentId');
    $selectedVarietyId = Session::get('selectedVarietyId');

    // Validar los datos del formulario aquí si es necesario
    $crop = new Crop();
    $crop->variety_id = $request->input('variety_id'); // Asigna el valor de variety_id desde el formulario
    $crop->name = $request->input('crop_name'); // Nombre del cultivo
    $crop->seed_time = $request->input('seed_time');

    // Parsea la densidad ingresada para separar el valor numérico y la unidad de medida
    $density = $request->input('density_value') . ' ' . $request->input('density_unit');
    list($densityValue, $densityUnit) = sscanf($density, "%f %s");
    $crop->density_value = $densityValue; // Valor numérico
    $crop->density_unit = $densityUnit; // Unidad de medida

    // Área Sembrada
    $crop->sown_area = $request->input('sown_area'); // Asegúrate de proporcionar un valor para sown_area, puedes obtenerlo del formulario

    $crop->finish_date = $request->input('finish_date');
    $crop->save();

    // Adjunta los IDs de unidad productiva y variedad a través de la relación muchos a muchos
    $crop->environments()->attach($selectedEnvironmentId);

    return redirect()->route('agrocefa.parameters')->with('success', 'Cultivo registrado exitosamente.');
    }






    public function editCrop(Request $request, $id)
    {
        // Validar los datos del formulario si es necesario
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'sown_area' => 'required|numeric',
            'seed_time' => 'required|date',
            'density' => 'required|numeric',
            'finish_date' => 'required|date',
        ]);
    
        // Encontrar la actividad a actualizar
        $crop = Crop::findOrFail($id);
    
        // Actualizar los datos de la actividad
        $crop->name = $request->input('name');
        $crop->sown_area = $request->input('sown_area');
        $crop->seed_time = $request->input('seed_time');
        $crop->density = $request->input('density');
        $crop->variety_id = $request->input('variety_id');
        $crop->finish_date = $request->input('finish_date');
        $crop->save();

        return redirect()->route('agrocefa.parameters');
    }

    
    public function deleteCrop($id)
    {
    // Obtener la actividad por su ID
    $crop = Crop::findOrFail($id);

    // Realizar la eliminación
    $crop->delete();

    return redirect()->route('agrocefa.parameters')->with('error', 'La actividad ha sido eliminada exitosamente.');
    }

    

}
