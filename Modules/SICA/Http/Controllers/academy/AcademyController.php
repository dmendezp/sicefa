<?php

namespace Modules\SICA\Http\Controllers\academy;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Course;
use Modules\SICA\Entities\Program;

class AcademyController extends Controller
{
 
    public function quarters(){
        $data = ['title'=>trans('sica::menu.Quarters')];
        return view('sica::admin.academy.quarters.home',$data);
    }

    public function curriculums(){
        $programs = Program::orderBy('sofia_code','desc')->get();
        $data = ['title'=>trans('sica::menu.Curriculums'),'programs'=>$programs];
        return view('sica::admin.academy.curriculums.home',$data);
    }

    public function courses(){
        $courses = Course::with('program')->orderBy('code','desc')->get();
        $data = ['title'=>trans('sica::menu.Courses'),'courses'=>$courses];
        return view('sica::admin.academy.courses.home',$data);
    }


}
