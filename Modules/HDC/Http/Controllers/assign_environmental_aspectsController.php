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

class assign_environmental_aspectsController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function assign_environmental_aspects()
    {
        $productive_unit = ProductiveUnit::all();
        $activities = Activity::all();
        $environmentalAspect = EnvironmentalAspect::get();
        return view('hdc::Asignar.assign_environmental_aspects', compact('productive_unit', 'activities', 'environmentalAspect'));
    }

    public function aspectlist()
    {
        $productive_unit = ProductiveUnit::all();
        return view('hdc::Asignar.resultfromaspects', compact('productive_unit'));
    }


    public function mostrarResultados(Request $request)
    {
        $unidadProductivaId = $request->input('productive_unit_id');

        // Realiza una consulta para obtener los resultados según la unidad productiva seleccionada
        $resultados = Activity::with('environmental_aspects')->where('productive_unit_id', $unidadProductivaId)->get();

        return view('hdc::Asignar.tablaresult', compact('resultados'));
    }

    public function getEnvironmentalAspects($activityId)
    {
        $activity = Activity::find($activityId);

        // Obtén los aspectos ambientales asociados a la actividad
        $associatedEnvironmentalAspects = $activity->environmental_aspects()->pluck('environmental_aspects.id')->toArray();

        return response()->json($associatedEnvironmentalAspects);
    }

    public function update(Request $request)
    {
        $activity = Activity::find($request->activity_id);

        // Obtén los IDs de los aspectos ambientales seleccionados
        $selectedEnvironmentalAspects = $request->input('Environmental_Aspect', []);

        // Sincroniza los aspectos ambientales en la tabla pivote
        $activity->environmental_aspects()->sync($selectedEnvironmentalAspects);

        return redirect(route('hdc.admin.resultfromaspects'));
    }

    public function getactivities(Request $request)
    {
        try {
            $productUnitId = $request->input('unit');

            $activities = Activity::where('productive_unit_id', $productUnitId)->pluck('name', 'id');


            // Combinar la información del responsable y las bodegas en un solo arreglo
            $response = [
                'activities' => $activities->toArray(),
            ];

            return response()->json($response);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Error interno del servidor'], 500);
        }
    }

    public function eliminarAspectosAmbientales($id)
    {
        try {
            $activity = Activity::findOrFail($id);
            $activity->environmental_aspects()->detach(); // Elimina la relación con aspectos ambientales
            // Opcionalmente, puedes eliminar la actividad si es necesario: $activity->delete();

            return redirect()->back()->with('success', 'Aspectos ambientales eliminados correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', '--Error al eliminar aspectos ambientales. ' . $e->getMessage());
        }
    }


    public function edit_resultados($activity_id)
    {
        try {
            // Obtén la actividad que se va a editar
            $activity = Activity::findOrFail($activity_id);

            // Obtén la lista de todas las unidades productivas
            $productive_units = ProductiveUnit::all();

            // Obtén la lista de todos los aspectos ambientales disponibles
            $environmental_aspects = EnvironmentalAspect::all();

            // Obtén los aspectos ambientales asociados a la actividad
            $associated_environmental_aspects = $activity->environmental_aspects->pluck('id')->toArray();

            // Retorna la vista de edición con la información necesaria
            return view('hdc::Asignar.editform', compact('activity', 'productive_units', 'environmental_aspects', 'associated_environmental_aspects'));
        } catch (\Exception $e) {
            // Manejar cualquier error que pueda ocurrir
            return redirect()->back()->with('error', 'Error al editar resultados. ' . $e->getMessage());
        }
    }
    public function UpdateEnvironmentalAspects(Request $request)
    {

            // Obtén el ID de la actividad a actualizar
            $activityId = $request->input('activity_id');

            // Encuentra la actividad en la base de datos
            $activity = Activity::findOrFail($activityId);

            // Actualiza la información con los datos del formulario
            $activity->update([
                'productive_unit_id' => $request->input('productive_unit_id'),
                // ... otras columnas que necesitas actualizar ...
            ]);

            // Actualiza los aspectos ambientales asociados
            $selectedEnvironmentalAspects = $request->input('Environmental_Aspect', []);
            $activity->environmental_aspects()->sync($selectedEnvironmentalAspects);

            try {
                return redirect()
                    ->route('hdc.admin.resultfromaspects')
                    ->with('success', trans('hdc::assign_environmental_aspects.alertsuccess_assign_environmental_aspects_update'));
            } catch (\Throwable $th) {
                return redirect()
                    ->back()
                    ->with('error', 'Error al crear el registro. Por favor, inténtalo de nuevo.');
            }

    }






}
