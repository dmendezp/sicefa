<?php

namespace Modules\CAFETO\Http\Controllers;

use Illuminate\Routing\Controller;

class CAFETOController extends Controller
{

    public function index()
    {
        $page_title = 'Inicio';
        $view_title = ' ';
        return view('cafeto::index', compact('page_title', 'view_title'));
    }

}
