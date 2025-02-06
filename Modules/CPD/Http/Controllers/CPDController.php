<?php

namespace Modules\CPD\Http\Controllers;

use Illuminate\Routing\Controller;
use Modules\CPD\Entities\Data;

class CPDController extends Controller
{

    public function home()
    {
        $view = ['titlePage' => trans('cpd::controllers.CPD_home_title_page'), 'titleView' => trans('cpd::controllers.CPD_home_title_view')];
        return view('cpd::home', compact('view'));
    }

    public function metadata()
    {
        $view = ['titlePage' => trans('cpd::controllers.CPD_Metadata_title_page'), 'titleView' => trans('cpd::controllers.CPD_Metadata_title_view')];
        $datas = Data::all();
        return view('cpd::metadata.index', compact('view','datas'));
    }

}
