<?php

namespace Modules\SICA\Http\Controllers\people;

use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Employee;

class EmployeeController extends Controller
{

    /* Vista principal de funcionarios */
    public function index(){
        $employees = Employee::get();
        $data = ['title'=>trans('sica::menu.Officers'),'employees' => $employees];
        return view('sica::admin.people.employees.index', $data);
    }

    public function showEmployee ($employee) {
        $employee = Employee::find($employee);
        $employees = Employee::get();
        $data = ['title'=>trans('sica::menu.Contractors'),'employees' => $employees,'employee' => $employee];
        return view('sica::admin.people.employees.show',$data);
    }

}
