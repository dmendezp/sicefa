<?php

namespace Modules\AGROCEFA\Http\Controllers\Parameters;

use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AGROCEFA\Entities\Specie; 
use Modules\SICA\Entities\Activity;
use Modules\AGROCEFA\Entities\Crop;
use Modules\SICA\Entities\ActivityType;
use Modules\SICA\Entities\Environment;
use Modules\AGROCEFA\Entities\Variety;
use Modules\AGROCEFA\Http\Controllers\Parameters\ActivityController;
use Modules\AGROCEFA\Http\Controllers\Parameters\AplicationMethodController;


class ParameterAgroController extends Controller
{   
    public function parametersview()
    {       
        $activityController = new ActivityController();
        $aplicationController = new AplicationMethodController();
        $crops = Crop::all();
        $selectedUnitId = Session::get('selectedUnitId'); // Obtén el ID de la unidad seleccionada
        $activityTypes= ActivityType::all(); //Listar Tipos de Actividad
        $species= Specie::all();// listar especies
        $varieties= Variety::all();//
        $activities = $activityController->getActivitiesForSelectedUnit(); // Llama a la función y obtiene las actividades
        $laborsData = $aplicationController->getAplicationForLabor(); // Llama a la función y obtiene las actividades
        $environments = Environment::all(); // Agrega esta línea para obtener los ambientes


        return view('agrocefa::parameters.parameter', [
            'activities' => $activities, // Pasa las actividades a la vista
            'species' => $species,
            'crops' => $crops,
            'activityTypes' => $activityTypes,
            'selectedUnitId' => $selectedUnitId,
            'varieties' => $varieties,
            'environments' => $environments, // Pasa la lista de ambientes a la vista
            'laborsData' => $laborsData,
        ]);
    }


    public function store(Request $request)
    {
        // Validación de los datos enviados desde el formulario
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'lifecycle' => 'required|in:Transitorio,Permanente',
            // Agrega más reglas de validación según tus necesidades
        ]);

        // Crear una nueva instancia de Specie y asignar los valores validados
        $specie = new Specie();
        $specie->name = $validatedData['name'];
        $specie->lifecycle = $validatedData['lifecycle'];
        // Asigna más valores si hay más campos en el formulario

        // Intenta guardar el nuevo registro en la base de datos
        try {
            $specie->save();
            return redirect()->route('agrocefa.parameters')->with('success', 'Registro exitoso.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al crear la especie. Por favor, inténtalo de nuevo.');
        }
    }

    /* Funcion editar especie */

    public function update(Request $request, $id)
    {
        // Validar los datos del formulario si es necesario
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'lifecycle' => 'required|in:Transitorio,Permanente',
        ]);
    
        // Encontrar la especie a actualizar
        $specie = Specie::findOrFail($id);
    
        // Actualizar los datos de la especie
        $specie->name = $request->input('name');
        $specie->lifecycle = $request->input('lifecycle');
        $specie->save();
    
        // Redireccionar a la vista de lista de especies o a otra página según sea necesario
        return redirect()->route('agrocefa.parameters')/* ->with('success', 'Especie actualizada correctamente.') */;
    }

    /* Funcion eliminar especie*/

    public function destroy($id)
    {
        try {
            $species = Specie::findOrFail($id);
            $species->delete();

            return redirect()->route('agrocefa.parameters')->with('error', 'Registro eliminado.');
        } catch (\Exception $e) {
            return redirect()->route('agrocefa.parameters')->with('error', 'Error al eliminar la especie.');
        }
    }

    /*varieties*/
    public function crear(Request $request)
    {
        // Validación de los datos enviados desde el formulario
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'specie_id' => 'required',
            // Agrega más reglas de validación según tus necesidades
        ]);

        // Crear una nueva instancia de variedad y asignar los valores validados
        $varieties = new Variety();
        $varieties->name = $validatedData['name'];
        $varieties->specie_id = $validatedData['specie_id'];  
        // Asigna más valores si hay más campos en el formulario

        // Intenta guardar el nuevo registro en la base de datos
        try {
            $varieties->save();
            return redirect()->route('agrocefa.parameters');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al crear la variedad. Por favor, inténtalo de nuevo.');
        }
    }
     /* Funcion editar variedad */

    public function edit(Request $request, $id)
    {
        // Validar los datos del formulario si es necesario
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'specie_id' => 'required    ',
        ]);
    
        // Encontrar la especie a actualizar
        $varieties = Specie::findOrFail($id);
    
        // Actualizar los datos de la especie
        $varieties->name = $request->input('name');
        $varieties->lifecycle = $request->input('lifecycle');
        $varieties->save();
    
        // Redireccionar a la vista de lista de especies o a otra página según sea necesario
        return redirect()->route('agrocefa.parameters')/* ->with('success', 'Especie actualizada correctamente.') */;
    }
    /* Funcion eliminar variedad*/

    public function elim($id)
    {
        try {
            $varieties = Variety::findOrFail($id);
            $varieties->delete();

            return redirect()->route('agrocefa.parameters')->with('success', 'variedad eliminada exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('agrocefa.parameters')->with('error', 'Error al eliminar la variedad');
        }
    }

    
}