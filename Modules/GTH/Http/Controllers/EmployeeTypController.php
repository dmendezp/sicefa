<?php
namespace Modules\GTH\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\EmployeeType;


class EmployeeTypController extends Controller
{
    //Funcion mostrar vista tipo de empleado
    public function viewemployeetypes()
    {
        $employeetype = EmployeeType::get();
        return view('gth::types_employee.employeetype',['employeetype'=> $employeetype]);
    }

    public function getcreateemployeetypes()
    {
        return view('gth::types_employee.create');
    }

    public function postcreateemployeetypes(Request $request)
    {
        $employeeType = new EmployeeType;
        $employeeType->name = $request->input('name');
        $employeeType->price = $request->input('price');
        $employeeType->save();

        return redirect()->route('gth.admin.employeetypes.index');
    }


    public function updateeemployeetypes(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255', // Agrega más reglas según tus necesidades
            'price' => 'required', // Agrega más reglas según tus necesidades
            // Agrega más campos y reglas según tus necesidades
        ]);

        $employeeType = EmployeeType::findOrFail($id);

        // Actualizar los campos necesarios
        $employeeType->name = $request->input('name');
        $employeeType->price = $request->input('price');
        // Actualiza otros campos si es necesario

        $employeeType->save();

        // Redirigir a donde quieras después de la actualización
        return redirect()->route('gth.admin.employeetypes.index')->with('success', 'Tipo de Empleado actualizado exitosamente.');
    }

    public function showEmployeeType($id)
    {
        $employeeType = EmployeeType::find($id);
        return view('types_employee.employeetype', ['employeeType' => $employeeType]);
    }


    public function deleteEmployeeType($id)
    {
        try {
            $employeeType = EmployeeType::findOrFail($id);
            $employeeType->delete();

            return redirect()->route('gth.admin.employeetypes.index')->with('success', 'Tipo de empleado eliminado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('gth.admin.employeetypes.index')->with('error', 'No se pudo eliminar el tipo de contratista.');
        }
    }


}
