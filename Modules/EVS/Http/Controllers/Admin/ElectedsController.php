<?php

namespace Modules\EVS\Http\Controllers\Admin;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use Validator, Str;

use Modules\EVS\Entities\Election;
use Modules\EVS\Entities\Elected;
use Illuminate\Support\Facades\Gate;

class ElectedsController extends Controller
{
    public function getElected(){
        //Gate::authorize('haveaccess', 'elected.list');


        // $e = Election::all();
        // dd($e->toArray());
        
        $electeds = Election::with('candidates.person')
        ->orderBy('id','Desc')->get();
        $data = ['electeds'=>$electeds];
    //    dd($electeds->toArray());
        return view('evs::admin.electeds.home', data: $data);
    }

    public function getElectedAdd(){
        Gate::authorize('haveaccess', 'evs.admin.electeds.add');
        $elections = Election::pluck('name', 'id');
        $data = ['elections'=>$elections];

        return view('evs::admin.electeds.add',  data: $data);
    }


}
