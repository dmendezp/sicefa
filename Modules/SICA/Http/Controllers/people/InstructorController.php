<?php

namespace Modules\SICA\Http\Controllers\people;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class InstructorController extends Controller
{

    public function instructors(){
        $data = ['title'=>trans('sica::menu.Instructors')];
        return view('sica::admin.people.instructors.home',$data);        
    } 

}
