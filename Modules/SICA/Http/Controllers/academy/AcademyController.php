<?php

namespace Modules\SICA\Http\Controllers\academy;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AcademyController extends Controller
{
 
    public function quarters(){
        $data = ['title'=>trans('sica::menu.Quarters')];
        return view('sica::admin.security.quarters',$data);
    }

    public function curriculums(){
        $data = ['title'=>trans('sica::menu.Curriculums')];
        return view('sica::admin.security.curriculums',$data);
    }

    public function courses(){
        $data = ['title'=>trans('sica::menu.Courses')];
        return view('sica::admin.security.courses',$data);
    }


}
