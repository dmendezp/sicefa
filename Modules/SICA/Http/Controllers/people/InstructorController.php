<?php

namespace Modules\SICA\Http\Controllers\people;

use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Employee;
use Modules\SICA\Entities\Contractor;
use DB;

class InstructorController extends Controller
{

    public function index()
{
    // Nombres de los tipos de empleados que quieres incluir
    $employeeTypeNames = ['Contratista', 'Planta Temporal', 'Planta Provisional', 'Carrera Administrativa'];

    // Obtener tanto empleados como contratistas que sean de los tipos especificados
    $instructors = DB::table('employees')
                    ->join('employee_types', 'employees.employee_type_id', '=', 'employee_types.id')
                    ->join('people', 'employees.person_id', '=', 'people.id')
                    ->whereIn('employee_types.name', $employeeTypeNames)
                    ->select('people.first_name', 'people.first_last_name', 'people.document_number', 'people.misena_email', 'people.telephone1', 'employee_types.name as employee_type_name')
                    ->union(
                        DB::table('contractors')
                            ->join('employee_types', 'contractors.employee_type_id', '=', 'employee_types.id')
                            ->join('people', 'contractors.person_id', '=', 'people.id')
                            ->whereIn('employee_types.name', $employeeTypeNames)
                            ->select('people.first_name', 'people.first_last_name', 'people.document_number', 'people.misena_email', 'people.telephone1', 'employee_types.name as employee_type_name')
                    )
                    ->get();

    // Verificar si la colección de instructores está vacía
    if ($instructors->isEmpty()) {
        return 'No se encontraron registros de empleados o contratistas.';
    }

    // Pasar la variable a la vista
    $data = ['title' => trans('sica::menu.Instructors'), 'instructors' => $instructors];
    return view('sica::admin.people.instructors.index', $data);
}

}
