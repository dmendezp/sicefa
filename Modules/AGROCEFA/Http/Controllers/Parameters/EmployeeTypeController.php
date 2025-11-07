<?php

namespace Modules\AGROCEFA\Http\Controllers\Parameters;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\EmployeeType;


class EmployeeTypeController extends Controller
{
    private function buildDynamicRoute()
    {
        // Construir la ruta dinámicamente
        return 'agrocefa.' . getRoleRouteName(Route::currentRouteName()) . '.parameters.index';
    }

    
    public function createEmployeeType(Request $request)
    {

    // Validar los datos del formulario aquí si es necesario
    $employeetype = new EmployeeType();
    $employeetype->name = $request->input('name'); 
    $employeetype->price = $request->input('price');
    $employeetype->year = $request->input('year');

    $employeetype->save();

    return redirect()->route($this->buildDynamicRoute())->with('success', 'Tipo de Empleado Registrado.');
    }

    // Funcion Editar Actividad
    public function editEmployeeType(Request $request, $id)
    {
        // Validar los datos del formulario si es necesario
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'year' => 'required|integer',
        ]);
    
        // Encontrar la actividad a actualizar
        $employeetype = EmployeeType::findOrFail($id);
    
        // Actualizar los datos de la actividad
        $employeetype->name = $request->input('name');
        $employeetype->price = $request->input('price');
        $employeetype->year = $request->input('year');
        $employeetype->save();

        return redirect()->route($this->buildDynamicRoute())->with('success', 'Tipo de Empleado Actualizado');
    }
    // Funcion Eliminar Actividad
    public function deleteEmployeeType($id)
    {
    // Obtener la actividad por su ID
    $employeetype = EmployeeType::findOrFail($id);

    // Realizar la eliminación
    $employeetype->delete();

    return redirect()->route($this->buildDynamicRoute())->with('error', 'Tipo de Empleado Eliminado');
    }
}
