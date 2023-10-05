<?php

namespace Modules\SICA\Http\Controllers\people;

use Illuminate\Routing\Controller;

class EmployeeController extends Controller
{

    /* Vista principal de funcionarios */
    public function index(){
        $data = ['title'=>trans('sica::menu.Officers')];
        return view('sica::admin.people.employees.index', $data);
    }

}
