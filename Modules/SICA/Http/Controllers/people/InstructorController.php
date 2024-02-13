<?php

namespace Modules\SICA\Http\Controllers\people;

use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Employee;
use Modules\SICA\Entities\Contractor;

class InstructorController extends Controller
{

    /* Vista principal de instructores */
    public function index()
{
    // Obtener empleados que sean "Contratista" o "Funcionario"
    $employees = Employee::whereHas('employee_type', function ($query) {
        $query->whereIn('name', ['Contratista', 'Funcionario']);
    })->get();

    // Obtener contratistas que sean "Contratista" o "Funcionario"
    $contractors = Contractor::whereHas('employee_type', function ($query) {
        $query->whereIn('name', ['Contratista', 'Funcionario']);
    })->get();

    // Fusionar las colecciones de empleados y contratistas en una sola variable
    $instructors = $employees->merge($contractors);


    // Pasar la variable a la vista
    $data = ['title' => trans('sica::menu.Instructors'), 'instructors' => $instructors];
    return view('sica::admin.people.instructors.index', $data);
}

}
