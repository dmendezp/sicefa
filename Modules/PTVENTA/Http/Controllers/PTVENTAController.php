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

    public function configuration(){
        $view = ['titlePage'=>trans('ptventa::configuration.Configuration'), 'titleView'=>trans('ptventa::configuration.Configuration')];
        return view('ptventa::configuration.index', compact('view'));
    }

    public function admin(){
        $view = ['titlePage'=>trans('ptventa::controllers.PTVENTA_admin_title_page'), 'titleView'=>trans('ptventa::controllers.PTVENTA_admin_title_view')];
        return view('ptventa::admin-index.blade.php', compact('view'));
    }

    public function cashier(){
        $view = ['titlePage'=>trans('ptventa::controllers.PTVENTA_cashier_title_page'), 'titleView'=>trans('ptventa::controllers.PTVENTA_cashier_title_view')];
        return view('ptventa::cashier-index.blade.php', compact('view'));
    }

}
