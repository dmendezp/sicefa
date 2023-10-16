<?php

namespace Modules\SIGAC\Http\Controllers;

use Illuminate\Routing\Controller;

class ApprenticeController extends Controller
{
    /* Enviar Excusas */
    public function send_excuses()
    {
        $view = ['titlePage'=>trans('sigac::consult.Excuses'), 'titleView'=>trans('sigac::consult.Excuses')];
        return view('sigac::apprentice.send_excuses',compact('view'));
    }
}
