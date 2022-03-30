<?php

namespace Modules\SICA\Http\Controllers\people;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PeopleController extends Controller
{

    public function personal_data()
    {
        $data = ['title'=>trans('sica::menu.Personal data')];
        return view('sica::admin.people.personal_data',$data);
    }

    public function search_apprentices(){
        $data = ['title'=>trans('sica::menu.Search apprentice')];
        return view('sica::admin.people.search_apprentices',$data);
    }

    public function instructors(){
        $data = ['title'=>trans('sica::menu.Instructors')];
        return view('sica::admin.people.instructors',$data);        
    } 

    public function officers(){
        $data = ['title'=>trans('sica::menu.Officers')];
        return view('sica::admin.people.officers',$data);        
    }

    public function contractors(){
        $data = ['title'=>trans('sica::menu.Contractors')];
        return view('sica::admin.people.contractors',$data);        
    }    

    public function users()
    {
        $data = ['title'=>trans('sica::menu.Users')];
        return view('sica::admin.people.users',$data);
    }

}
