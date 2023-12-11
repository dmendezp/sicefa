<?php

namespace Modules\AGROCEFA\Http\Controllers\Parameters;

use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AGROCEFA\Entities\Crop;
use Modules\SICA\Entities\Environment;
use Modules\SICA\Entities\EnvironmentProductiveUnit;
use Modules\AGROCEFA\Entities\CropEnvironment;

class CropController extends Controller
{

    private function buildDynamicRoute()
    {
        // Construir la ruta dinámicamente
        return 'agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.parameters.index';
    }


    
    public function createCrop(Request $request){
        $selectedEnvironmentId = $request->input('environment_id'); // Obtén el ambiente seleccionado desde el formulario
        $crop = new Crop();
        $crop->variety_id = $request->input('variety_id');
        $crop->name = $request->input('crop_name');
        $crop->seed_time = $request->input('seed_time');
        $crop->sown_area = $request->input('sown_area');
        $crop->density = $request->input('density');        
        $crop->finish_date = $request->input('finish_date');
        $crop->save();
        $cropId = $crop->id;

        $cropenvironment = new CropEnvironment();
        $cropenvironment->crop_id = $cropId;
        $cropenvironment->environment_id = $selectedEnvironmentId;
        $cropenvironment->save();



        return redirect()->route($this->buildDynamicRoute())->with('success', 'Cultivo registrado');
    }



    public function editCrop(Request $request, $id)
    {
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
        return redirect()->route($this->buildDynamicRoute())->with('success', 'Cultivo Actualizado');
    }


    public function deleteCrop($id)
    {
        // Obtener la actividad por su ID
        $crop = Crop::findOrFail($id);
        $crop->delete();

        return redirect()->route($this->buildDynamicRoute())->with('error', 'Cultivo Eliminado');
    }
}
