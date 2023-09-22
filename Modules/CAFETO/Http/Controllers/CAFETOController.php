<?php

namespace Modules\CAFETO\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\SICA\Entities\App;

class CAFETOController extends Controller
{

    public function index()
    {
        $view = ['titlePage' => trans('cafeto::controllers.CAFETO_index_title_page'), 'titleView' => trans('cafeto::controllers.CAFETO_index_title_view')];
        // Lista de apps para el menu de acceso rapido
        $apps = App::get();
        return view('cafeto::index', compact('apps', 'view'));
    }

    public function devs()
    {
        $view = ['titlePage' => trans('cafeto::controllers.CAFETO_devs_title_page'), 'titleView' => trans('cafeto::controllers.CAFETO_devs_title_view')];
        // Lista de apps para el menu de acceso rapido
        $apps = App::get();
        return view('cafeto::developers.index', compact('apps', 'view'));
    }

    public function info()
    {
        $view = ['titlePage' => trans('cafeto::controllers.CAFETO_info_title_page'), 'titleView' => trans('cafeto::controllers.CAFETO_info_title_page')];
        // Lista de apps para el menu de acceso rapido
        $apps = App::get();
        return view('cafeto::information.index', compact('apps', 'view'));
    }

    public function configuration()
    {
        $view = ['titlePage' => trans('cafeto::controllers.CAFETO_configuration_title_page'), 'titleView' => trans('cafeto::controllers.CAFETO_configuration_title_view')];
        // Lista de apps para el menu de acceso rapido
        $apps = App::get();
        return view('cafeto::configuration.index', compact('apps', 'view'));
    }

    public function admin()
    {
        $view = ['titlePage' => trans('cafeto::controllers.CAFETO_admin_title_page'), 'titleView' => trans('cafeto::controllers.CAFETO_admin_title_view')];
        // Lista de apps para el menu de acceso rapido
        $apps = App::get();
        return view('cafeto::admin-index', compact('apps', 'view'));
    }

    public function cashier()
    {
        $view = ['titlePage' => trans('cafeto::controllers.CAFETO_cashier_title_page'), 'titleView' => trans('cafeto::controllers.CAFETO_cashier_title_view')];
        // Lista de apps para el menu de acceso rapido
        $apps = App::get();
        return view('cafeto::cashier-index', compact('apps', 'view'));
    }
}
