<?php

namespace Modules\GDMF\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class GDMFController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $view = [
            'titlePage' => 'Pagina Principal',
            'titleView' => trans('sigac::controllers.SIGAC_index_title_view'),
        ];
        return view('gdmf::index', $view);
    }

    public function proof()
    {
        $view = ['titlePage' => trans('sigac::controllers.SIGAC_index_title_page'), 'titleView' => trans('sigac::controllers.SIGAC_index_title_view')];
        return view('sigac::proof', $view);
    }

    public function info()
    {
        $view = ['titlePage' => trans('sigac::controllers.SIGAC_info_title_page'), 'titleView' => trans('sigac::controllers.SIGAC_info_title_view')];
        return view('sigac::information.index', $view);
    }

    public function devs()
    {
        $view = ['titlePage' => trans('sigac::controllers.SIGAC_devs_title_page'), 'titleView' => trans('sigac::controllers.SIGAC_devs_title_view')];
        return view('sigac::developers.index', $view);
    }

    /* Panel de control de coordinación académica */
    public function academic_coordination_dashboard()
    {
        $view = ['titlePage' => trans('sigac::controllers.SIGAC_academic_coordination_dashboard_title_page'), 'titleView' => trans('sigac::controllers.SIGAC_academic_coordination_dashboard_title_view')];
        return view('gdmf::academic_coordination_dashboard', $view);
    }

    /* Panel de control del instructor */
    public function instructor_dashboard()
    {
        $view = ['titlePage' => trans('sigac::controllers.SIGAC_instructor_dashboard_title_page'), 'titleView' => trans('sigac::controllers.SIGAC_instructor_dashboard_title_view')];
        return view('gdmf::instructor_dashboard', $view);
    }
}
