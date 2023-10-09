<?php

namespace Modules\SIGAC\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\SICA\Entities\App;

class ApprenticeController extends Controller
{
    /* Enviar Excusas */
    public function send_excuses()
    {
        $view = ['titlePage'=>trans('sigac::consult.Excuses'), 'titleView'=>trans('sigac::consult.Excuses')];
        $apps = App::get();
        return view('sigac::apprentice.send_excuses',compact('view', 'apps'));
    }
}
