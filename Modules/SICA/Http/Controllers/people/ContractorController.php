<?php

namespace Modules\SICA\Http\Controllers\people;

use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Contractor;

class ContractorController extends Controller
{

    /* Vista principal de contratistas */
    public function index(){
        $contractors = Contractor::get();
        $data = ['title'=>trans('sica::menu.Contractors'),'contractors' => $contractors];
        return view('sica::admin.people.contractors.index',$data);
    }

    public function showContractor ($contractor) {
        $contractor = Contractor::find($contractor);
        $contractors = Contractor::get();
        $data = ['title'=>trans('sica::menu.Contractors'),'contractors' => $contractors,'contractor' => $contractor];
        return view('sica::admin.people.contractors.show',$data);
    }

}
