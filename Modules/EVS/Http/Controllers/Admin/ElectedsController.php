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
        
        $electeds = Elected::with('candidate.person')->with('election')->orderBy('id','Desc')->get();
        $data = ['electeds'=>$electeds];
        return view('evs::admin.electeds.home', $data);
    }

    public function getElectedAdd(){
        Gate::authorize('haveaccess', 'electeds.add');
        $elections = Election::pluck('name', 'id');
        $data = ['elections'=>$elections];
        return view('evs::admin.electeds.add', $data);
    }


}
