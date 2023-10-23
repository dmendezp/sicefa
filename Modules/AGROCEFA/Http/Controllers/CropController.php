<?php

namespace Modules\AGROCEFA\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AGROCEFA\Entities\Crop; 
use Modules\SICA\Entities\Environment; 

class CropController extends Controller
{
    public function index(){
        $crop= Crop::all();
        return view('agrocefa::crop', compact('crops'));
    }
    
    public function createCrop(Request $request){
        
        $crop = new Crop();
        $crop->variety_id = $request->input('variety_id');
        $crop->name = $request->input('crop_name');
        $crop->seed_time = $request->input('seed_time');
        $crop->sown_area = $request->input('sown_area');
        $crop->density = $request->input('density'); 
        $crop->finish_date = $request->input('finish_date');
        $crop->save();

    $selectedEnvironmentId = $request->input('environment_id'); // Obtén el ambiente seleccionado desde el formulario
    $crop->environments()->attach($selectedEnvironmentId);

    return redirect()->route('agrocefa.parameters.index')->with('success', 'Cultivo registrado exitosamente.');
    }



    public function editCrop(Request $request, $id){
        // Validar los datos del formulario aquí si es necesario
    


    // Encontrar la cultivo a editar
    $crop = Crop::findOrFail($id);

    // Actualizar los campos del cultivo con los nuevos valores
    $crop->variety_id = $request->input('variety_id');
    $crop->name = $request->input('crop_name');
    $crop->seed_time = $request->input('seed_time');
    $crop->sown_area = $request->input('sown_area');
    $crop->density = $request->input('density');
    $crop->finish_date = $request->input('finish_date');

    // Actualizar el ambiente
    $crop->environments()->sync([$request->input('environment_id')]);

    // Guardar los cambios en el cultivo
    $crop->save();

    // Redirigir al usuario a la vista de edición con un mensaje de éxito
    return redirect()->route('agrocefa.parameters.index')->with('success', 'Cultivo ha sido editado exitosamente.');
    }

    
    public function deleteCrop($id)
    {
    // Obtener la actividad por su ID
    $crop = Crop::findOrFail($id);
    $crop->delete();

    return redirect()->route('agrocefa.parameters.index')->with('error', 'El Cultivo ha sido eliminada exitosamente.');
    }

    

}
