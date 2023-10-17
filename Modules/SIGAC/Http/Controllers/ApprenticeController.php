<?php

namespace Modules\SIGAC\Http\Controllers;

use Illuminate\Routing\Controller;

class ApprenticeController extends Controller
{
    /* Enviar Excusas */
    public function send_excuses()
    {
        $view = ['titlePage'=>trans('sigac::controllers.SIGAC_send_excuses_title_page'), 'titleView'=>trans('sigac::controllers.SIGAC_send_excuses_title_view')];
        return view('sigac::apprentice.send_excuses',compact('view'));
    }
}
