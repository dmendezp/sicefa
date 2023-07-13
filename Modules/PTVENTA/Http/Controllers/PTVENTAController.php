<?php

namespace Modules\PTVENTA\Http\Controllers;

use Illuminate\Routing\Controller;

class PTVENTAController extends Controller
{

    public function index(){
        $view = ['titlePage'=>trans('ptventa::mainPage.Main page'), 'titleView'=>trans('ptventa::mainPage.Main page')];
        return view('ptventa::index', compact('view'));
    }

    public function devs(){
        $view = ['titlePage'=>trans('ptventa::devs.Developers'), 'titleView'=>trans('ptventa::devs.Developers and credits')];
        return view('ptventa::developers.index', compact('view'));
    }

    public function info(){
        $view = ['titlePage'=>trans('ptventa::about.About us'), 'titleView'=>trans('ptventa::about.About us')];
        return view('ptventa::information.index', compact('view'));
    }

    public function generarFactura(){
        $view = ['titlePage'=>trans('ptventa::about.Factura'), 'titleView'=>trans('ptventa::about.Factura')];
        return view('ptventa::purchaseInvoice', compact('view'));
    }
}
