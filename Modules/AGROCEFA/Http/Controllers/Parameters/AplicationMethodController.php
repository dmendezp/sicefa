<?php

namespace Modules\AGROCEFA\Http\Controllers\Parameters;

use Illuminate\Support\Facades\Session;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Activity;
use Modules\AGROCEFA\Entities\AgriculturalLabor;

class AplicationMethodController extends Controller

{
    private $selectedUnitId ;
    

    //Funcion listar los metodos de aplicacion
    public function getAplicationForLabor()
    {
        // Obtén el ID de la unidad productiva seleccionada de la sesión
        $this->selectedUnitId = Session::get('selectedUnitId');
        
        // Verifica si hay un ID de unidad seleccionada en la sesión
        if ($this->selectedUnitId) {
            $laborsData = Activity::with('labors.agricultural_labors')
                ->where('productive_unit_id', $this->selectedUnitId)
                ->get()
                ->map(function ($activity) {
                    return [
                        'activity_id' => $activity->id,
                        'name' => $activity->name, // Reemplaza 'nombre' con el nombre real del campo de actividad
                        'labors' => $activity->labors->map(function ($labor) {
                            return [
                                'labor_id' => $labor->id,
                                'description' => $labor->description, // Reemplaza 'nombre' con el nombre real del campo de labor
                                'agricultural_labors' => $labor->agricultural_labors->map(function ($agricultural) {
                                    return [
                                        'agricultural_id' => $agricultural->id,
                                        'agricultural_method' => $agricultural->application_method,
                                        'objective' => $agricultural->objective, // Reemplaza 'nombre' con el nombre real del campo de método de aplicación
                                        // Agrega otros campos relacionados a los métodos de aplicación según sea necesario
                                    ];
                                }),
                            ];
                        }),
                    ];
                });

            return  $laborsData;
        }
    }

    public function createAgriculturalMethod(Request $request)
    {
        // Validar los datos del formulario (puedes personalizar esto según tus necesidades)
        $request->validate([
            'labor_id' => 'required|integer', // Asegúrate de tener un campo labor_id en tu formulario
            'application_method' => 'required|string',
            'objective' => 'required|string',
            // Agrega más reglas de validación según tus campos
        ]);

        // Crea un nuevo objeto AgriculturalMethod y asigna los valores del formulario
        $agriculturalMethod = new AgriculturalLabor([
            'labor_id' => $request->input('labor_id'), // Asigna el labor_id desde el formulario
            'application_method' => $request->input('application_method'),
            'objective' => $request->input('objective'),
            // Asigna otros campos según sea necesario
        ]);

        // Guarda el nuevo método de aplicación en la base de datos
        $agriculturalMethod->save();

        // Redirige a la página de parámetros con un mensaje de éxito
        return redirect()->route('agrocefa.parameters.index')->with('success', 'Nuevo método de aplicación registrado correctamente.');
    }

    public function editAgriculturalMethod(Request $request, $id)
    {
        // Validar los datos del formulario (puedes personalizar esto según tus necesidades)
        $request->validate([
            'editar-application_method' => 'required|string',
            'editar-objective' => 'required|string',
            // Agrega más reglas de validación según tus campos de edición
        ]);

        // Busca el método de aplicación por ID en la base de datos
        $agriculturalMethod = AgriculturalLabor::find($id);

        if (!$agriculturalMethod) {
            // Maneja el caso en el que no se encuentra el método de aplicación
            return redirect()->route('agrocefa.parameters.index')->with('error', 'El método de aplicación no se encontró.');
        }

        // Actualiza los valores del método de aplicación con los datos del formulario
        $agriculturalMethod->application_method = $request->input('editar-application_method');
        $agriculturalMethod->objective = $request->input('editar-objective');
        // Actualiza otros campos según sea necesario

        // Guarda los cambios en la base de datos
        $agriculturalMethod->save();

        // Redirige a la página de parámetros con un mensaje de éxito
        return redirect()->route('agrocefa.parameters.index')->with('success', 'Método de aplicación actualizado correctamente.');
    }

    public function deleteAplication($id)
    {
        try {
            // Encuentra el Método de Aplicación que deseas eliminar
            $metodoAplicacion = AgriculturalLabor::findOrFail($id);

            // Realiza la eliminación
            $metodoAplicacion->delete();

            // Si la eliminación fue exitosa, redirige de vuelta con un mensaje de éxito
            return redirect()->route('agrocefa.parameters.index')->with('success', 'Método de Aplicación eliminado exitosamente');
        } catch (\Exception $e) {
            // Si ocurre algún error, redirige de vuelta con un mensaje de error
            return redirect()->route('agrocefa.parameters.index')->with('error', 'Error al eliminar el Método de Aplicación');
        }
    }


}
