<?php

namespace Modules\SICA\Http\Controllers\people;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Course;
use Modules\SICA\Entities\Apprentice;
use Modules\SICA\Imports\ApprenticeImport;

use Validator, Str, Excel;

class ApprenticeController extends Controller
{

    public function search_apprentices(){
        //$courses = Course::orderBy('code','Desc')->get();
        $courses = Course::orderBy('code','Desc')->get()->pluck('code_name','id');
        //$elections = Election::orderBy('id','Desc')->get();
        //Election::pluck('name', 'id');
        $data = ['title'=>trans('sica::menu.Search apprentice'),'courses'=>$courses];
        return view('sica::admin.people.apprentices.home',$data);
    }

	public function search(){
		$datas = json_decode($_POST['data']);
		if($datas->course_id):
			$course = Course::with('program')->findOrFail($datas->course_id);
			$apprentices = Apprentice::with('person')->where('course_id',$datas->course_id)->get();
			$data = ['course'=>$course,'apprentices'=>$apprentices];

            return view('sica::admin.people.apprentices.list',$data);
        else:
            return '<div class="row d-flex justify-content-center"><span class="h5 text-danger">No se encontró registros</span><div>';
        endif;
	}

}
