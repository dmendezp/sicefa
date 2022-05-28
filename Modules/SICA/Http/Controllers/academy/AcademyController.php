<?php

namespace Modules\SICA\Http\Controllers\academy;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Course;
use Modules\SICA\Entities\Program;
use Modules\SICA\Entities\Network;
use Modules\SICA\Entities\Line;

class AcademyController extends Controller
{
 
    public function quarters(){
        $data = ['title'=>trans('sica::menu.Quarters')];
        return view('sica::admin.academy.quarters.home',$data);
    }

    public function curriculums(){
        $programs = Program::with('network')->orderBy('sofia_code','desc')->get();
        $data = ['title'=>trans('sica::menu.Curriculums'),'programs'=>$programs];
        return view('sica::admin.academy.curriculums.home',$data);
    }

    public function courses(){
        $courses = Course::with('program')->orderBy('code','desc')->get();
        $data = ['title'=>trans('sica::menu.Courses'),'courses'=>$courses];
        return view('sica::admin.academy.courses.home',$data);
    }

    public function networks(){
        $networks = Network::with('line')->orderBy('id','asc')->get();
        $data = ['title'=>trans('sica::menu.Networks'),'networks'=>$networks];
        return view('sica::admin.academy.networks.home',$data);
    }

    public function lines(){
        $lines = Line::orderBy('id','asc')->get();
        $data = ['title'=>trans('sica::menu.Lines'),'lines'=>$lines];
        return view('sica::admin.academy.lines.home',$data);
    }

}
