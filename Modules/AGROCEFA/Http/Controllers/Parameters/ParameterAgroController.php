<?php

namespace Modules\AGROCEFA\Http\Controllers\Parameters;

use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\AGROCEFA\Entities\Specie;
use Modules\SICA\Entities\Activity;
use Modules\AGROCEFA\Entities\Crop;
use Modules\SICA\Entities\ActivityType;
use Modules\SICA\Entities\Environment;
use Modules\SICA\Entities\EmployeeType;
use Modules\AGROCEFA\Entities\Variety;
use Modules\AGROCEFA\Http\Controllers\Parameters\ActivityController;
use Modules\AGROCEFA\Http\Controllers\Parameters\AplicationMethodController;
use Modules\AGROCEFA\Http\Controllers\Parameters\SpecieController;


class ParameterAgroController extends Controller
{

    private function buildDynamicRoute()
    {
        // Construir la ruta dinámicamente
        return 'agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.parameters.index';
    }
    
    public function parametersview()
    {
        $activityController = new ActivityController();
        $aplicationController = new AplicationMethodController();
        $SpecieController = new SpecieController();
        $crops = Crop::all();
        $selectedUnitId = Session::get('selectedUnitId'); // Obtén el ID de la unidad seleccionada
        $activityTypes = ActivityType::all(); //Listar Tipos de Actividad
        $varieties = Variety::all(); //
        $species = $SpecieController->getSpeciesForSelectedUnit();
        $activities = $activityController->getActivitiesForSelectedUnit(); // Llama a la función y obtiene las actividades
        $laborsData = $aplicationController->getAplicationForLabor(); // Llama a la función y obtiene las actividades
        $environments = Environment::all(); // Agrega esta línea para obtener los ambientes
        $employeetypes = EmployeeType::all(); // Agrega esta línea para obtener los ambientes


        return view('agrocefa::parameters.parameter', [
            'activities' => $activities, // Pasa las actividades a la vista
            'species' => $species,
            'crops' => $crops,
            'activityTypes' => $activityTypes,
            'selectedUnitId' => $selectedUnitId,
            'varieties' => $varieties,
            'environments' => $environments, // Pasa la lista de ambientes a la vista
            'laborsData' => $laborsData,
            'employeetypes' => $employeetypes,
        ]);
    }

    /* Funcion crear especie */
    public function store(Request $request)
    {
         // Obtén el ID de la unidad seleccionada
        $selectedUnitId = Session::get('selectedUnitId');

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
        $specie->productive_unit_id = $selectedUnitId;
        // Asigna más valores si hay más campos en el formulario

        // Intenta guardar el nuevo registro en la base de datos
        try {
            $specie->save();
            return redirect()->route($this->buildDynamicRoute())->with('success', 'Especie Registrada');
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
        return redirect()->route($this->buildDynamicRoute())->with('success', 'Especie Actualizada');
    }

    /* Funcion eliminar especie*/
    public function destroy($id)
    {
        try {
            $species = Specie::findOrFail($id);
            $species->delete();

            return redirect()->route($this->buildDynamicRoute())->with('error', 'Especie Eliminada');
        } catch (\Exception $e) {
            return redirect()->route($this->buildDynamicRoute())->with('error', 'Error al eliminar la especie.');
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
            return redirect()->route($this->buildDynamicRoute())->with('success', 'Variedad Registrada');
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
        return redirect()->route($this->buildDynamicRoute())->with('success', 'Especie Actualizada');
    }
    /* Funcion eliminar variedad*/

    public function elim($id)
    {
        try {
            $varieties = Variety::findOrFail($id);
            $varieties->delete();

            return redirect()->route($this->buildDynamicRoute())->with('success', 'Variedad Eliminada');
        } catch (\Exception $e) {
            return redirect()->route($this->buildDynamicRoute())->with('error', 'Error al eliminar la variedad');
        }
    }
}
