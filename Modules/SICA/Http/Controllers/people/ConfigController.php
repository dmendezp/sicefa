<?php

namespace Modules\SICA\Http\Controllers\people;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\Event;

class ConfigController extends Controller
{

    public function config(){
        $events = Event::all();
        $data = ['title'=>trans('sica::menu.Config'), 'events'=>$events];
        return view('sica::admin.people.config.home',$data);
    }

}
