<?php

namespace Modules\SICA\Http\Controllers\people;

use Illuminate\Routing\Controller;

class ContractorController extends Controller
{

    /* Vista principal de contratistas */
    public function index(){
        $data = ['title'=>trans('sica::menu.Contractors')];
        return view('sica::admin.people.contractors.index',$data);
    }

}
