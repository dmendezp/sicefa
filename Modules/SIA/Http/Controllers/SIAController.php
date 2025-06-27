<?php

namespace Modules\SIA\Http\Controllers;

use Illuminate\Routing\Controller;

class SIAController extends Controller
{
    public function index()
    {
        $view = ['titlePage' => trans('sia::controllers.SIA_index_title_page'), 'titleView' => trans('sia::controllers.SIA_index_title_view')];
        return view('sia::index', compact('view'));
    }

    public function devs()
    {
        $view = ['titlePage' => trans('sia::controllers.SIA_devs_title_page'), 'titleView' => trans('sia::controllers.SIA_devs_title_view')];
        return view('sia::developers.index', compact('view'));
    }

    public function info()
    {
        $view = ['titlePage' => trans('sia::controllers.SIA_info_title_page'), 'titleView' => trans('sia::controllers.SIA_info_title_page')];
        return view('sia::information.index', compact('view'));
    }

    public function admin()
    {
        $view = ['titlePage' => trans('sia::controllers.SIA_admin_title_page'), 'titleView' => trans('sia::controllers.SIA_admin_title_view')];
        return view('sia::admin-index', compact('view'));
    }
}