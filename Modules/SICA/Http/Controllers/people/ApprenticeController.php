<?php

namespace Modules\SICA\Http\Controllers\people;

use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Course;
use Modules\SICA\Entities\Apprentice;

class ApprenticeController extends Controller
{

    /* Vista principal para consultar aprendices por titulación */
    public function index(){
        $courses = Course::orderBy('code','Desc')->get()->pluck('code_name','id');
        $data = ['title'=>trans('sica::menu.Search apprentice'),'courses'=>$courses];
        return view('sica::admin.people.apprentices.index',$data);
    }

    /* Consultar aprendices por titulación */
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
