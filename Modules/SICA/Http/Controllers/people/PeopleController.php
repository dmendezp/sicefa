<?php

namespace Modules\SICA\Http\Controllers\people;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Course;

class PeopleController extends Controller
{

    public function config(){
        
        $data = ['title'=>trans('sica::menu.Config')];
        return view('sica::admin.people.config.home',$data);        
    } 

    public function personal_data()
    {
        $data = ['title'=>trans('sica::menu.Personal data')];
        return view('sica::admin.people.personal_data.home',$data);
    }

    public function search_apprentices(){
        //$courses = Course::orderBy('code','Desc')->get();
        $courses = Course::orderBy('code','Desc')->get()->pluck('code_name','id');
        //$elections = Election::orderBy('id','Desc')->get();
        //Election::pluck('name', 'id');
        $data = ['title'=>trans('sica::menu.Search apprentice'),'courses'=>$courses];
        return view('sica::admin.people.apprentices.home',$data);
    }

    

    public function instructors(){
        $data = ['title'=>trans('sica::menu.Instructors')];
        return view('sica::admin.people.instructors.home',$data);        
    } 

    public function officers(){
        $data = ['title'=>trans('sica::menu.Officers')];
        return view('sica::admin.people.officers.home',$data);        
    }

    public function contractors(){
        $data = ['title'=>trans('sica::menu.Contractors')];
        return view('sica::admin.people.contractors.home',$data);        
    }    



}
