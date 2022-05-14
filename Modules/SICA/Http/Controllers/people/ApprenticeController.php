<?php

namespace Modules\SICA\Http\Controllers\people;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Course;
use Modules\SICA\Entities\Apprentice;

class ApprenticeController extends Controller
{

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
