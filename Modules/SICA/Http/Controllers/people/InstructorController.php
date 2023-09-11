<?php

namespace Modules\SICA\Http\Controllers\people;

use Illuminate\Routing\Controller;

class InstructorController extends Controller
{

    /* Vista principal de instructores */
    public function index(){
        $data = ['title'=>trans('sica::menu.Instructors')];
        return view('sica::admin.people.instructors.index',$data);
    }

}
