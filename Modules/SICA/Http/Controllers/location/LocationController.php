<?php

namespace Modules\SICA\Http\Controllers\location;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class LocationController extends Controller
{
    public function countries(){
        $data = ['title'=>trans('sica::menu.Countries')];
        return view('sica::admin.location.countries',$data);
    }
    
}
